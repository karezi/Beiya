$(document).ready(function(){
	if(checkUserName()&&checkPass()&&checkEmail()&&checkRePwd())
	{
		return true;
	}else{
			return false; 
		}
})


 <!--妫\x80楠\x8C\xE7\x94ㄦ\x88峰\x90\x8D-->
function checkUserName()
{
	var name=document.register.username;
	var info=document.getElementById("userInfo");
	if(name.value=="")
	{
		info.innerHTML="<font color='red'>璇疯\xBE\x93\xE5\x85ョ\x94ㄦ\x88峰\x90\x8D锛\x81</font>";
		name.select();
		name.focus();
		return false;
		}
	else if(name.value.length<4||name.value.length>16){
		info.innerHTML="<font color='red'>\xE7\x94ㄦ\x88峰\x90\x8D\xE7\x9A\x84\xE9\x95垮害4-16涓\xAA瀛\x97绗\xA6锛\x81</font>";
		name.focus();
		name.select();
		return false;
		}
	for(var i=0;i<name.value.length;i++){
		var testName=name.value.toLowerCase().charAt(i);
		if(!((testName<='9'&&testName>='0')||(testName<='z'&&testName>='a')
		||testName=="_")){
			info.innerHTML="<font color='red'>\xE7\x94ㄦ\x88峰\x90\x8D\xE5\x8C\x85\xE5\x90\xAB\xE9\x9D\x9E娉\x95瀛\x97绗\xA6锛\x8C\xE5\x8F\xAAa-z,0-9\xE5\x92\x8C\xE8\x83藉\x8C\x85\xE6\x8B\xAC涓\x8B\xE5\x88\x92绾匡\xBC\x81</font>";
			name.focus();
			name.select();
			return false;	
			}
		}
		info.innerHTML="\xE5\x8F\xAA\xE8\x83借\xBE\x93\xE5\x85ュ\xAD\x97姣\x8D\xE6\x88\x96\xE6\x95板\xAD\x97锛\x8C4-16涓\xAA瀛\x97绗\xA6!";
	return true;
}

<!--瀵\x86\xE7\xA0\x81楠\x8C璇\x81-->
function checkPass()
{
	var pass=document.register.password;
	
	var pwdInfo=document.getElementById("pwdInfo");
	
	if(pass.value=="")
	{
		pwdInfo.innerHTML="<font color='red'>璇疯\xBE\x93\xE5\x85ュ\xAF\x86\xE7\xA0\x81锛\x81</font>";
		pass.focus();
		pass.select();
		return false
		}else if(pass.value.length<6||pass.value.length>12){
			pwdInfo.innerHTML="<font color='red'>瀵\x86\xE7\xA0\x81\xE7\x9A\x84\xE9\x95垮害涓\xBA6-12锛\x81</font>";
			pass.focus();
			pass.select();
			return false;
		}
	pwdInfo.innerHTML="瀵\x86\xE7\xA0\x81\xE7\x9A\x84\xE9\x95垮害涓\xBA6-12锛\x81";
	return true;
	
	}
<!--\xE9\x82\xAE绠遍\xAA\x8C璇\x81-->	
function checkEmail(){
	var email=document.register.email;
	var info=document.getElementById("email_info");
	if(email.value==""){
		info.innerHTML="<font color='red'>\xE7\x94靛\xAD\x90\xE9\x82\xAE浠跺\x9C板\x9D\x80涓\x8D\xE8\x83戒负绌猴\xBC\x81</font>";
		email.select();
		email.focus();
		return false;
		}
	else if(email.value.indexOf(".",0)==-1||email.value.indexOf("@",0)==-1){
		info.innerHTML="<font color='red'>\xE7\x94靛\xAD\x90\xE9\x82\xAE浠剁\x9A\x84\xE6\xA0煎\xBC\x8F涓\x8D姝ｇ‘锛\x81蹇\x85椤诲\x8C\x85\xE5\x90\xAB绗\xA6\xE5\x8F\xB7'@'\xE5\x92\x8C绗\xA6\xE5\x8F\xB7'.' 锛\x81</font>";
		email.select();
		email.focus();
		return false
		}else if(email.value.charAt(0)=="@"||email.value.charAt(0)=="."){
		alert("@绗\xA6\xE5\x8F峰\x92\x8C.绗\xA6\xE5\x8F蜂\xB8\x8D\xE8\x83藉\x87虹\x8E板\x9Cㄧ\xAC\xAC涓\x80浣\x8D锛\x81");
		info.innerHTML="<font color='red'>@绗\xA6\xE5\x8F峰\x92\x8C.绗\xA6\xE5\x8F蜂\xB8\x8D\xE8\x83藉\x87虹\x8E板\x9Cㄧ\xAC\xAC涓\x80浣\x8D锛\x81</font>";
		email.select();
		email.focus();
		return false
			}
	
	info.innerHTML="璇疯\xBE\x93\xE5\x85ユ\x9C\x89\xE6\x95\x88\xE7\x9A\x84\xE7\x94靛\xAD\x90\xE9\x82\xAE绠憋\xBC\x81";
			
	return true
	}
	
<!--楠\x8C璇\x81纭\xAE璁ゅ\xAF\x86\xE7\xA0\x81-->	
function checkRePass(){
	var pass=document.register.password;
	var rePass=document.register.password2;
	var rePwdInfo=document.getElementById("password2_info");
	
	if(rePass.value==""){
			rePwdInfo.innerHTML="<font color='red'>纭\xAE璁ゅ\xAF\x86\xE7\xA0\x81涓\x8D\xE8\x83戒负绌猴\xBC\x81</font>";
			rePass.focus();
			rePass.select();
			return false;
		}
		else if(rePass.value!=pass.value){
			rePwdInfo.innerHTML="<font color='red'>瀵\x86\xE7\xA0\x81涓\x8E纭\xAE璁ゅ\xAF\x86\xE7\xA0\x81涓\x8D\xE7\x9B稿\x90\x8C锛\x81</font>";
			return false;
		}
		rePwdInfo.innerHTML="";
		return true;
	}