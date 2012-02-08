<?php 
if(!file_exists('./../install.txt')) die('Create install.txt to reinstall!');
include('../app/include/core.class.php');
header('Content-Type: text/html; charset=utf-8');?>
<html>
<head>
<title>Venera CMS Installation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="js/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="js/jquery.ui.resizable.js"></script>
<script type="text/javascript">
$.postJSON = function(url, data, callback) {
	$.post(url, data, callback, "json");
};
var step=1;
function show_msgbox(text){
	$('#msgboxtext').html(text);
	$('#msgbox').dialog();
}
function step2_checkdata(){
	var dbuser=encodeURIComponent(document.getElementById('dbuser').value);
	var dbpassword=encodeURIComponent(document.getElementById('dbpassword').value);
	var dbhost=encodeURIComponent(document.getElementById('dbhost').value);
	var dbname=encodeURIComponent(document.getElementById('dbname').value);
	var dbprefix=encodeURIComponent(document.getElementById('dbprefix').value);
	document.getElementById('navigation').style.display='none';
	document.getElementById('step2').style.display='none';
	document.getElementById('setup').style.display='block';
	$('#setup').html('Пожалуйста подождите, идёт проверка подключения к базе данных MySQL...');
	$.postJSON('check.php','dbuser='+dbuser+'&dbpassword='+dbpassword+'&dbhost='+dbhost+'&dbname='+dbname+'&dbprefix='+dbprefix, function(data) {
		document.getElementById('setup').style.display='none';
		if(parseInt(data.error)==1)
		{
			show_msgbox(data.message);
			document.getElementById('step2').style.display='block';
			step=2;
		}else{
			document.getElementById('step2').style.display='none';
			document.getElementById('step3').style.display='block';
			step=3;
		}
		document.getElementById('navigation').style.display='block';
	});
}
function step5_install(){
	var login=encodeURIComponent(document.getElementById('userlogin').value);
	var name=encodeURIComponent(document.getElementById('username').value);
	var sername=encodeURIComponent(document.getElementById('usersername').value);
	var password=encodeURIComponent(document.getElementById('userpassword').value);
	var email=encodeURIComponent(document.getElementById('useremail').value);
	var dbuser=encodeURIComponent(document.getElementById('dbuser').value);
	var dbpassword=encodeURIComponent(document.getElementById('dbpassword').value);
	var dbhost=encodeURIComponent(document.getElementById('dbhost').value);
	var dbname=encodeURIComponent(document.getElementById('dbname').value);
	var dbprefix=encodeURIComponent(document.getElementById('dbprefix').value);
	var baseurl=encodeURIComponent(document.getElementById('baseurl').value);
	document.getElementById('navigation').style.display='none';
	document.getElementById('step3').style.display='none';
	document.getElementById('setup').style.display='block';
	$('#setup').html('Пожалуйста подождите, идёт настройка конфигурационных файлов система и базы данных...');
	$.postJSON('install.php','userlogin='+login+'&username='+name+'&usersername='+sername+'&userpassword='+password+'&useremail='+email+'&dbuser='+dbuser+'&dbpassword='+dbpassword+'&dbhost='+dbhost+'&dbname='+dbname+'&dbprefix='+dbprefix+'&baseurl='+baseurl, function(data) {
		document.getElementById('setup').style.display='none';
		if(parseInt(data.error)==1)
		{
			show_msgbox(data.message);
			document.getElementById('step4').style.display='block';
			document.getElementById('navigation').style.display='block';
			step=4;
		}else{
			document.getElementById('step5').style.display='block';
			document.getElementById('step4').style.display='none';
			document.getElementById('navigation').style.display='none';
			step=5;
		}
		
	});
}
function step4_checkdata(){
	var login=encodeURIComponent(document.getElementById('userlogin').value);
	var name=encodeURIComponent(document.getElementById('username').value);
	var sername=encodeURIComponent(document.getElementById('usersername').value);
	var password=encodeURIComponent(document.getElementById('userpassword').value);
	var email=encodeURIComponent(document.getElementById('useremail').value);
	var baseurl=encodeURIComponent(document.getElementById('baseurl').value);
	document.getElementById('navigation').style.display='none';
	document.getElementById('step4').style.display='none';
	document.getElementById('setup').style.display='block';
	$('#setup').html('Пожалуйста подождите, идёт проверка данных аккаунта администратора...');
	$.getJSON('check.php','userlogin='+login+'&username='+name+'&usersername='+sername+'&userpassword='+password+'&useremail='+email+'&baseurl='+baseurl, function(data) {
		document.getElementById('setup').style.display='none';
		if(parseInt(data.error)==1)
		{
			show_msgbox(data.message);
			document.getElementById('step4').style.display='block';
			step=4;
		}else{
			document.getElementById('step4').style.display='none';
			step5_install();
		}
		document.getElementById('navigation').style.display='block';
	});
}
function step_next(){
	if(step>=5) return 0;
	if(step==2){
		step2_checkdata();
		return 0;
	}
	if(step==4){
		step4_checkdata();
		return 0;
	}
	document.getElementById('step'+step).style.display='none';
	step++;
	document.getElementById('step'+step).style.display='block';
	
}
function step_back(){
	if(step<2) return 0;
	document.getElementById('step'+step).style.display='none';
	step--;
	document.getElementById('step'+step).style.display='block';
	
}
</script>
<link rel="stylesheet" href="themes/base/jquery.ui.all.css"> 
<style type="text/css">
body{
margin:20px 0px 0px 0px;
background:#000000;
font-family: Arial;
background-image:url('img/bg.jpg');
}
#window{
width:635px;
height:465px;
margin:auto;
border-style:solid;
border-width:2px;
border-color:#AAAAAA;
background:#FFFFFF;
}
input{
border-style:solid;
color:#000000;
border-width:1px;
border-color:#AAAAAA;
background:#EEEEEE;
margin:3px;
height:20px;
}
#steps{
overflow: auto;
height:435px;
width:434px;
border-width:0px 0px 1px 0px;
border-style:solid;
border-color:#AAAAAA;
}
#left{
width:200px;
height:465px;
float:left;
border-width:0px 1px 0px 0px;
border-style:solid;
border-color:#AAAAAA;
background-image:url('img/left.jpg');
}
#navigation{
height:35px;
float:right;
}
#step1{
padding:10px;
display:block;
}
#step2{
padding:10px;
display:none;
}
#step3{
padding:10px;
display:none;
}
#step4{
padding:10px;
display:none;
}
#step5{
padding:10px;
display:none;
}
#setup{
padding:10px;
display:none;
}

#msgbox{
display:none;
}
#msgboxtext{
font-size:12px;
padding:5px;
}
</style>
</head>
<body>
<div id="msgbox" title="Сообщение!">
<div id="msgboxtext">
</div>
</div>
<div id="window">
<div id="left">
</div>
<div id="steps">
<div id="setup">
</div>

<div id="step1">
<h2>Лицензионное соглашение</h2><hr/>

<?php echo file_get_contents('./../eula.html');?>
</div>
<div id="step2">
<h2>Настройки подключения к базе данных</h2>
<hr/>
Хост:<br/>
<input type="text" id="dbhost" value="localhost"/><br/>
Логин:<br/>
<input type="text" id="dbuser" value=""/><br/>
Пароль:<br/>
<input type="password" id="dbpassword" value=""/><br/>
База данных:<br/>
<input type="text" id="dbname" value=""/><br/>
Префикс таблиц:<br/>
<input type="text" id="dbprefix" value=""/><br/>
</div>

<div id="step3">
<h2>Данные администратора</h2>
<hr/>
Ник:<br/>
<input type="text" id="userlogin" value="root"/><br/>
Имя:<br/>
<input type="text" id="username" value=""/><br/>
Фамилия:<br/>
<input type="text" id="usersername" value=""/><br/>
Эл.почта:<br/>
<input type="text" id="useremail" value=""/><br/>
Пароль:<br/>
<input type="password" id="userpassword" value=""/><br/>

</div>
<div id="step4">
<h2>Настройки сайта</h2><hr>
Доменное имя сайта:<br/>
http://<input type="text" id="baseurl" value="<?php echo $_SERVER['HTTP_HOST'];?>"/><br/>
</div>
<div id="step5">
<h2>Установка завершена!</h2>
<hr/>
<center>
Установка системы управления сайтом Venera CMS v.<?=core::$version;?> <?=core::$version_type;?> успешно завершена!<br/>
<img src="img/logo.jpg"/>
<br/>
Дополнительная информация о системе на <a href="http://wajox.myglonet.com" target="_blank">сайте http:///wajox.myglonet.com</a>
или по e-mail: wajox@mail.ru
</center>

</div>
</div>
<div id="navigation">
<input type="button" value="back" onclick="javascript:step_back();"/>
<input type="button" value="next" onclick="javascript:step_next();"/>
</div>
</div>
</body>
</html>