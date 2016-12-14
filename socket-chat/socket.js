var io = require('socket.io')();
var mysql = require('./helpers/mysql');
var bcrypt = require('bcrypt');
var moment = require('moment');
var fs = require('fs');

var salt = bcrypt.genSaltSync(10);
 

var users = [];


	




io.on('connection', function (socket) {
	
	console.log('in');
	
	//user login check

	socket.on('user-login',function (data){

		var currUser = true;
		var socketArr = true;

		data.socketId = [socket.id];
		data.status = 'Y';

		users.forEach(function (value,index){
			if(value.id==data.id){
				var user_socketid = value.socketId;

				user_socketid.forEach(function(socvalue){
					if(socvalue==socket.id){
						socketArr = false;
					}
				});
				
				if(socketArr){
					value.socketId.push(socket.id);
				}

				currUser = false;
			}
		});


		if(currUser==true){
			users.push(data);
		}

		updateStatus(data,function (err,res){
			if(err){
				console.log(err);
			}
		});
		io.emit('get-userDetails');
	});




	// get friend list 
	
	socket.on('get-friends-list',function(data){
		userfriendList(data,function(err,list){
			if(!err){
				
				unreadMessage(data,function(err_r,count,conversations){
					if(!err_r){
						
						users.forEach(function(value,index){
							if(value.id==data.id){
								value.socketId.forEach(function(socValue,socindex){
									
									io.to(socValue).emit('friend-list',{friends_list:list,unreadMessage:count,convUser:conversations});
								});
							}
						});

					}else{

					}
				});	

			}else{
				console.log(err);
			}
		});
	});
    


	// read message
	socket.on('read-messages',function(data){
		var items = {};
		items.senderId  = (data.sender.id!=undefined?data.sender.id:null);
		items.receiveId = (data.receive.id!=undefined?data.receive.id:null);
		items.requestId = (data.receive.requestId!=undefined?data.receive.requestId:null);
		readmesage(items);

		users.forEach(function(value,index){
			if(value.id==data.sender.id){
				value.socketId.forEach(function(socValue,socindex){
					io.to(socValue).emit('get-userDetails');
				});
			}
		});
	});


	// old message
	
	socket.on('old-messages',function(data){
		var items = {};
		items.count = (data.count!=undefined?data.count:0);
		items.senderId  = (data.sender.id!=undefined?data.sender.id:null);
		items.receiveId = (data.receive.id!=undefined?data.receive.id:null);
		items.requestId = (data.receive.requestId!=undefined?data.receive.requestId:null);
		readmesage(items);
		getMessage(items,function(err,res){
			if(!err){
				var scroll = (res.length<=0?false:true);
				users.forEach(function(value,index){
					if(value.id==data.sender.id){
						value.socketId.forEach(function(socValue,socindex){
							io.to(socValue).emit('get-userDetails');
							io.to(socValue).emit('get-Old-message',JSON.stringify({requestId:items.requestId,senderId:items.senderId,reciverId:items.receiveId,message:res,scroll:scroll}));
						});
					}
				});
			}else{
				console.log(err);
			}
		});
	});






	// send message

	socket.on('send-message',function(data){
		var date = new Date();
		//date.setMinutes(date.getMinutes() - 1);
		data.date = date;
	
		sendMessage(data,function(err,res){
			if(!err){
				data.mesgId = res.insertId;
				users.forEach(function(value,index){
					// sender emit data
					if(value.id==data.sender.id){
						value.socketId.forEach(function(socValue,socindex){
							io.to(socValue).emit('conversation',data);
							io.to(socValue).emit('get-userDetails');
						});
					}
					// receive emit
					if(value.id==data.receive.id){
						value.socketId.forEach(function(socValue,socindex){
							socket.broadcast.to(socValue).emit('conversation',data);
							io.to(socValue).emit('get-userDetails');
						});
					}
				});
			}else{
				console.log(err);
			}
		});
	});




	// socket disconnect

	socket.on('disconnect',function(){
	 	users.forEach(function(value,index){
	 		value.socketId.forEach(function(socValue,socindex){
	 			if(socValue== socket.id){
	 				value.socketId.splice(socindex,1);
	 			}
	 		});
	 		
	 	});
	});





	// set interval offline user

	setInterval(function(){

		console.log(' users ',users);
		
		fs.writeFile("users.json",JSON.stringify(users,null, 2), function(err) {
		    if(err) {
		        return console.log(err);
		    }
		}); 

  		users.forEach(function(value,index){
  			if(value.socketId.length<=0){
  				io.emit('get-userDetails');
  				value.status= 'N';
  				updateStatus(value,function (err,res){
  					users.splice(index,1);
  				});
  			}
  		});
	}, 10000);	

});





// check user email and password
function logincheck(data,callback){
	var email = data.email;
	var pwd = data.pwd;
	if(email != undefined && pwd != undefined){
		var query ="select * from users where email=?";
		mysql.query(String(query),[email],function(err, rows) {
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
		mysql.query(String(query),[status,userId],function(err,rows){
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



// user friend list
function userfriendList(data,callback){
	var userId = data.id
	if(userId != undefined){
		var query = "SELECT * , (SELECT COUNT( * ) as msgcount FROM messages WHERE reciverId ="+userId+" AND senderId=friend.id  AND STATUS =1) as msgcount FROM ( SELECT * FROM ( ( SELECT `u` . *,`ur`.`id` as requestId ,`uET`.`type` as requestType  FROM `users` AS `u` INNER JOIN `user_requests` AS `ur` ON `ur`.`to_id` = `u`.`id` LEFT JOIN `exchangestudents` AS `uET` ON `uET`.`user_id` = `u`.`id` WHERE `ur`.`user_id` ="+userId+" ) UNION ( SELECT `u` . *,`ur`.`id` as requestId , `uET`.`type` as requestType   FROM `users` AS `u` INNER JOIN `user_requests` AS `ur` ON `ur`.`user_id` = `u`.`id` LEFT JOIN `exchangestudents` AS `uET` ON `uET`.`user_id` = `u`.`id` WHERE `ur`.`to_id` ="+userId+" ) ) AS allfriend  ORDER BY allfriend.requestId ASC  ) AS friend  GROUP BY id  ORDER BY field( friend.online, 'Y', 'N', '' ) ASC , `friend`.`fname` ASC"; 
		//var query = "select * , (select COUNT(*) from messages where senderId=ur.to_id  and reciverId=ur.user_id and status=1 ) as messageCount  from users as u join user_requests as ur  on  ur.to_id = u.id where ur.user_id=?";
		mysql.query(String(query),function(err,rows){
			if(!err){
				
				rows.forEach(function(row,rowIndex){
					delete row.password;
					delete row.remember_token;
					users.forEach(function(user,userIndex){
						if(user.id==row.id){
							row.socketId = user.socketId;
						}
					});
				});

				callback(null,JSON.stringify(rows));
			}else{
				callback(err,null);
			}
		});
	}
}

// total unread message
function unreadMessage(data,callback){
	var userId = data.id
	if(userId != undefined){
		//var query = "SELECT COUNT( * ) as msgcount FROM messages WHERE reciverId ="+userId+" AND STATUS =1";

		var query = "SELECT COUNT(M.senderId) as conversations, T.msgcount FROM messages M INNER JOIN(SELECT senderId, max(id) as maxId, count(*) as msgcount FROM messages WHERE reciverId = "+userId+" and status = 1 GROUP BY senderId)T ON M.id = T.maxId";
		mysql.query(String(query),function(err,rows){

			if(!err){
				callback(null,rows[0].msgcount,rows[0].conversations);
			}else{
				callback(err,null);
			}
		});
	}
}



// message save
function sendMessage(data,callback){

	if(data.sender != undefined && data.receive != undefined){
		var msg = {
			message : data.message,
			senderId : data.sender.id,
			reciverId : data.receive.id,
			requestId: data.receive.requestId,
			date : data.date,
			status:1
		};
		var query = "insert into messages set ?";
		mysql.query(String(query),msg,function(err,result){
			if(!err){
				callback(null,result);
			}else{
				callback(err,null)
			}
		});
	}

}



// get message 
function getMessage(data,callback){
	if(data.receiveId!=null && data.senderId!=null) {
		var query = `SELECT *  from ((SELECT m.id as mesgId, m.requestId , m.senderId  , m.reciverId , m.message, m.date , u.id as userId , u.fname , u.lname , u.email , u.username, u.avatar  FROM messages as m JOIN users as u on u.id = m.senderId  WHERE senderId=${data.senderId} and reciverId=${data.receiveId}) UNION  (SELECT m.id as mesgId ,m.requestId , m.senderId  , m.reciverId , m.message, m.date , u.id as userId , u.fname , u.lname , u.email , u.username, u.avatar  FROM messages as m JOIN users as u on u.id = m.senderId  WHERE senderId=${data.receiveId} and reciverId=${data.senderId} )) as a  order by mesgId desc limit  ${data.count},10 `;

		mysql.query(String(query),function(err,result){
			if(!err){
				callback(null,result);
			}else{
				callback(err,null);
			}
		});
	}else{
		callback('error reciverId and senderId is null',null);
	}
}


// read message
function readmesage(data){
	var query= `update messages set status='0' where senderId=${data.receiveId} and reciverId=${data.senderId} and status='1' `;
	mysql.query(String(query),function(err,result){
		if(err){
			console.log(err);
		}
	});
}


module.exports = io;