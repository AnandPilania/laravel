<?php

$title = option('site.name');
$description = option('site.metadescription');
$image = asset('/img/newlogo.png');
$imageheight = 200;
$imagewidth = 200;
$canonical = Request::url();


$segments = Request::segments();
if (!empty($segments)) {
    $pagename = ucwords(str_replace("-"," ",end($segments)));
    $family = strtolower(reset($segments));
    //get segment after /ko/
    if (strlen($family) <= 2) $family = strtolower(next($segments));

if (empty($family)) {
    // ignore Landing page with language (eg. "/ko".. etc)
} else if (strcasecmp($family,"university")==0){
    if (isset($universities->universityName)) {

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $universities->universityName)));
        $canonical = URL::to('/university/')."/".$universities->id."/".$slug."/".end($segments);

    if (count($segments)==4 || strcmp($pagename,"Addinfo")==0 || strcmp($pagename,"University")==0) {

    $title = ($universities->universityName)." Guide | ".option('site.slogan');

    } else {

    $title = $pagename." | ".($universities->universityName);

    }

    if (isset($universities->image)) $image = asset('/images/universities')."/".($universities->image);
    $description = ($universities->universityName)." ".option('university-detail.metadescription');
    } else {
        $title = $pagename." | ".$title;
    }

} else if (strcasecmp($family,"travelogue")==0){
    if (isset($data_blog->title)) {
        $title = $data_blog->title;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data_blog->title)));
        $canonical = URL::to('travelogue')."/".$data_blog->id."/".$slug;
    } else {
        $title = $pagename." | ".$title;
    }
    if(isset($data_blog->image)) {
        $image = URL::to('/')."/upload/".rawurlencode($data_blog->image);
        $imageheight = 315;
        $imagewidth = 600;
    }
    if(isset($data_blog->description)) {
        $source =strip_tags(html_entity_decode($data_blog->description));
        $description = substr($source, 0, 240)."...";
    }

} else if (strcasecmp($family,"password")==0){
    $title = "Forgot Password | ".option('site.slogan');
} else if (strcmp($pagename,"Register")==0) {
    $title = "Sign up for ".option('site.slogan');
} else if (strcmp($pagename,"Login")==0) {
    $title = "Log in to ".option('site.slogan');
} else if (strcmp($pagename,"University")==0) {
    $title = "University Guides | ".option('site.slogan');
    $description = option('university.metadescription');
} else {
    $title = $pagename." | ".$title;
}

}

?>

<title><?php echo $title; ?></title>
{!! option('tracking') !!}
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta property="fb:app_id" content="158824664483310"/>
<meta property="og:site_name" content="{!! option('site.slogan') !!}" />
<meta property="og:url" content="{{ $canonical }}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $description; ?>"/>
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:image:width" content="<?php echo $imagewidth ?>" />
<meta property="og:image:height" content="<?php echo $imageheight ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<meta name="_token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('/img/demo_icon.gif') }}" type="image/gif">
<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css">
<link rel="canonical" href="{{ $canonical }}"/>
{!! HTML::style('/libraries/bootstrap/css/bootstrap.min.css', array('media' => 'all')) !!}
{!! HTML::style('/libraries/tablesorter/css/theme.bootstrap.min.css', array('media' => 'all')) !!}
{!! HTML::style('/css/full-slider.css', array('media' => 'all')) !!}
{!! HTML::style('/css/awesome-bootstrap-checkbox.css', array('media' => 'all')) !!}
{!! HTML::style('/css/style.css?v=2.7', array('media' => 'all')) !!}
{!! HTML::style('/css/alertify.css', array('media' => 'all')) !!}
{!! HTML::style('/css/developer.css?v=2.7', array('media' => 'all')) !!}
{!! HTML::style('/css/responsive.css?v=1.4', array('media' => 'all')) !!}
{!! HTML::style('/css/bootstrap-datepicker.css', array('media' => 'all')) !!}
{!! HTML::style('/libraries/comboBox/css/bootstrap-combobox.css', array('media' => 'all')) !!}

<!-- JavaScript -->
{!! HTML::script('/js/angular.min.js') !!}
{!! HTML::script('/js/jquery-2.1.4.min.js') !!}
{!! HTML::script('/libraries/tablesorter/js/jquery.tablesorter.js') !!}
{!! HTML::script('/libraries/tablesorter/js/jquery.tablesorter.widgets.js') !!}
{!! HTML::script('/libraries/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('/libraries/comboBox/js/bootstrap-combobox.js') !!}
{!! HTML::script('/js/bootstrap-notify.js') !!}
{!! HTML::script('/js/ajaxupload.3.5.js') !!}
{!! HTML::script('/js/alertify.js') !!}
{!! HTML::script('js/bootstrap-datepicker.js') !!}
{!! HTML::script('/js/moment.js') !!}
{!! HTML::script('/js/lodash.min.js') !!}
{!! HTML::script('/js/developer.js?v=2.6') !!}
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.3.1/jssocials.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.3.1/jssocials.css" />
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3883aXU6lJp5RWd0Yx1bMcZhFkXgaWsI";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
 $zopim(function() {
    $zopim.livechat.set({
      language: 'en'
    });
  });
</script>


<script type="text/javascript" src="{{ asset("/js/intercom.js") }}"></script>


<style>
.messgae-box-popup {
bottom: 0;
position: fixed;
}
.popup-box {
margin-right: 30px;
z-index: 9999;
}
.pro-left img.profileImg {
width:100%;
height:100%;
border-radius:50%;
}
.pro-left img {
border-radius:0;
}
.centerLoader{
width: auto !important;
height: auto !important;
position: absolute;
top: 40%;
left: 44%;
}
.latu {
background: #fff;
/*border: 1px solid #f9c390;*/
bottom: 0px;
z-index: 100;
/* padding-bottom: 10px;*/
padding-top: 0;
position: fixed;
right: 0;
width: 230px;
box-shadow: 0 1px 5px #3e3e3e;
}
.diff-main-online .latu {
background: none;
/*border: 1px solid #f9c390;*/
bottom: auto;
z-index: 100;
/* padding-bottom: 10px;*/
padding-top: auto;
position: relative;
right: auto;
width: auto;
box-shadow: none;
}
#two h2 {
background: #ff7c00;
font-size: 15px;
margin: 0;
padding: 10px;
text-align: left;
}
.latu h2 {
background: #ff7c00;
font-size: 15px;
margin: 0;
padding: 10px;
text-align: left;
}
.diff-main-online .sidebar-name {
border-bottom: 1px solid #e1e1e1;
border-left: none;
border-right: none;
display: table;
}
.sidebar-name {
float: left;
font-size: 12px;
position: relative;
padding: 10px;
width: 100%;
}
.sidebar-name span {
padding-left: 5px;
}
.sidebar-name a {
color: inherit;
height: 100%;
text-decoration: none;
width: 100%;
font-weight: bold;
}
.name-cl {
float:left;
line-height: 15px;
width: 111px;
color: black;
margin-left: 10px;
margin-top: 5px !important;
}
.sidebar-name:hover {
background-color: #e1e2e5;
}
.sidebar-name img {
height: 40px;
vertical-align: middle;
width: 40px;
margin-right: 10px;
border-radius: 50%;
display: inline-block;
float: left;
}
.sidebar-name.btn {
white-space: normal;
}
.popup-box {
background-color: rgb(237, 239, 244);
border: 1px solid rgba(29, 49, 91, 0.3);
bottom: 0;
display: none;
position: fixed;
right: 220px;
width: 290px;
}
.popup-box .popup-head {
background-color: #6d84b4;
clear: both;
color: white;
font-size: 14px;
font-weight: bold;
padding: 5px;
}
.popup-box .popup-head .popup-head-left {
float: left;
}
.popup-box .popup-head .popup-head-right {
float: right;
opacity: 0.5;
}
.popup-box .popup-head .popup-head-right a {
color: inherit;
text-decoration: none;
}
.popup-box .popup-messages {
height: 75%;
overflow-y: scroll;
}
#carbonads {
background: #f8f8f8 none repeat scroll 0 0;
max-width: 300px;
}
.carbon-text {
display: block;
width: 130px;
}
.carbon-poweredby {
float: right;
}
.carbon-text {
padding: 8px 0;
}
#carbonads {
border: 1px solid #ccc;
padding: 15px;
}
.carbon-text {
color: #333333;
font-size: 12px;
text-decoration: none;
}
.carbon-poweredby {
font-size: 75%;
text-decoration: none;
}
#carbonads {
left: 5px;
position: fixed;
top: 5px;
}
.chat-friends.intro {
position: fixed;
right: 148px;
top: auto;
bottom: 420px;
}
.chat-friends {
background: #fdead8 none repeat scroll 0 0;
border-left: 1px solid #f9c390;
border-right: 1px solid #f9c390;
border-top: 1px solid #f9c390;
border-top-left-radius: 10px;
border-top-right-radius: 10px;
color: #000;
font-size: 14px;
letter-spacing: 0;
padding: 5px 20px;
position: absolute;
right: -50px;
top: 50%;
transform: rotate(-90deg);
z-index: 100;
}
.sidebar-name img.msg-ic {
border-radius: 0;
float: none;
height: auto;
width: auto;
}
.online-chat {margin-top: 8px;}
.online {
background: #009e1d;
border-radius: 50%;
float: right;
height: 8px;

margin-top: 15px;
width: 8px;
}
.chat-sidebar-main.diff-main-online .online {
float: left;
margin-right: 17px;
margin-top: 9px;
}
.online.offline {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: 1px solid #ef8316;
}
.msg-chat i {
font-size: 17px;
}
.inner-Pageheader .btn-group.open .dropdown-toggle {
box-shadow:none;
}
@media only screen and (max-width: 540px) {
.modl-footer input[type="text"] {
margin-left: 0;
padding: 22px;
width: 80%;
}
.name-cl {width: 111px !important;}
.chat-popup {
display: none !important;
}
}
.exchange-notify {
max-height: 80px;
width: 400px;
display: none;
position: fixed;
overflow: hidden;
top: 5px;
margin: 0 auto;
left: 0px;
right:0px;
height: 100%;
z-index: 9999;
}
.chatbox-main{
color: #000;
float: left;
position: absolute;
}
#shareall {
    margin: 20px;
    position: absolute;
    bottom: 0;
    width: 100%;

}
.par_hght p {
    display: inline-block;
    margin-bottom: 20px;
}

.sidebar-nav {
    padding: 9px 0;
}

.dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    visibility: hidden;
    margin-top: -1px;
}

.dropdown-menu li:hover .sub-menu {
    visibility: visible;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {
    margin-top: 0;
}

.navbar .sub-menu:before {
    border-bottom: 7px solid transparent;
    border-left: none;
    border-right: 7px solid rgba(0, 0, 0, 0.2);
    border-top: 7px solid transparent;
    left: -7px;
    top: 10px;
}
.navbar .sub-menu:after {
    border-top: 6px solid transparent;
    border-left: none;
    border-right: 6px solid #fff;
    border-bottom: 6px solid transparent;
    left: 10px;
    top: 11px;
    left: -6px;
}
</style>
