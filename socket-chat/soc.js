var cluster = require('cluster');
var express = require('express');
var http = require('http');
var redis = require('redis');
var redisAdapter = require('socket.io-redis');
var bcrypt = require('bcrypt');
var sticky = require('sticky-session');
var mysql = require('./helpers/mysql');

var port = process.env.PORT || 3000;
// var workers = process.env.WORKERS || require('os').cpus().length;
var workers = 3;
var app = express();


///////////////////////////////////
//      HTTP SERVER
///////////////////////////////////

// Configure sticky sessions to ensure requests go to the same child in the cluster.
// See : https://github.com/indutny/sticky-session

// NOTE: Sticky sessions are based on a hash of the IP address. 
// This means multiple web browsers or tabs on the same machine will always hit the same slave.

sticky(workers, function() {

  // This code will be executed only in slave workers
  var server = http.createServer(app);

  var io = require('socket.io')(server);

  // configure socket.io to use redis adapter
  addRedisAdapter(io);

  // configure socket.io to respond to certain events
  addIOEventHandlers(io);

  return server;

}).listen(port, function() {

  // this code is executed in both slaves and master
  console.log('server started on port '+port+'. process id = '+process.pid);

});


///////////////////////////////////
//      EXPRESS
///////////////////////////////////

app.get('/', function(req, res) {
  console.log('express request handled by process '+process.pid);
  res.sendfile('index.html');
});


///////////////////////////////////
//      REDIS ADAPTER
///////////////////////////////////

function addRedisAdapter(io) {
  var redisUrl = process.env.REDISTOGO_URL || 'redis://127.0.0.1:6379';
  var redisOptions = require('parse-redis-url')(redis).parse(redisUrl);
  var pub = redis.createClient(redisOptions.port, redisOptions.host, {
    detect_buffers: true,
    auth_pass: redisOptions.password
  });
  var sub = redis.createClient(redisOptions.port, redisOptions.host, {
    detect_buffers: true,
    auth_pass: redisOptions.password
  });

  io.adapter(redisAdapter({
    pubClient: pub,
    subClient: sub
  }));
  console.log('Redis adapter started with url: ' + redisUrl);
};


///////////////////////////////////
//      SOCKET EVENT HANDLING
///////////////////////////////////

var salt = bcrypt.genSaltSync(10);
 

var users = [];



function addIOEventHandlers(io) {

  io.on('connection', function(socket) {


    socket.on('login-user',function (data){

      logincheck(data,function(err,rows){
        if(!err){
          var currUser = true;
          var user = {};
    
          user.socketId = socket.id;
          user.id = rows.id;
          user.fname = rows.fname;
          user.lname = rows.lname;
          user.email = rows.email;
          user.socketId = socket.id;

          users.forEach(function(currValue,index){
            if(currValue.id==user.id){
              currUser = false;
            }
          });

          if(currUser==true){
            users.push(user);
            //redis_client.set('users', JSON.stringify(users));
            updateStatus({id:rows.id,status:'Y'},function(err,data){
              if(err){
                console.log(err);
              }
            }); 
          }



          console.log('currUser ',currUser ,' users', users);

        }
      });
    });



    console.log('Connection made. socket.id='+socket.id+' . pid = '+process.pid);

    socket.on('chat_in', function(msg) {
      console.log('emitting message: '+msg+' . socket.id='+socket.id+' . pid = '+process.pid);
      io.emit('chat_out', 'Process '+process.pid+': '+msg);
    });
    socket.on('disconnect', function(){
      console.log('socket disconnected. socket.id='+socket.id+' . pid = '+process.pid);
    });

    socket.emit('chat_out', 'Connected to socket server. Socket = '+socket.id+'.  Process = '+process.pid);
  });

  io.on('disconnect', function(socket) {
    console.log('Lost a socket. socket.id='+socket.id+' . pid = '+process.pid);
  });

};





function logincheck(data,callback){
  var email = data.email;
  var pwd = data.pwd;
  if(email != undefined && pwd != undefined){
    var query ="select * from users where email=?";
    mysql.query(query,[email],function(err, rows) {
      var password =rows[0].password;
      if(bcrypt.compareSync(pwd,password.replace('$2y$', '$2a$'))){
        callback(null,rows[0]);
      }else{
        callback('error',null);
      } 
    });
  } 
}




// update user status online/offline
function updateStatus(data,callback){
  var userId = data.id;
  var status = data.status;
  if(userId != undefined && status != undefined){
    var query="update users SET online=? where id=?";
    mysql.query(query,[status,userId],function(err,rows){
      if(!err){
        callback(null,rows);
      }else{
        callback(err,null);
      }
    });
  }else{
    callback('error',null);
  }
}