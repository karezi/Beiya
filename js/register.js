$(document).ready(function(){
	var username=$("#username");
	var password=$("#password");
	var password2=$("#password2");
	var email=$("#email");
	var username_info=$("#username_info");
	var password_info=$("#password_info");
	var password2_info=$("#password2_info");
	var email_info=$("#email_info");

	username.focus(function(){
		var info=username_info;
		username.css({"border":'1px solid #BABABA'});
		info.css({"visibility": 'visible'});
		info.css({"border":'1px solid #BABABA'});
		info.html("请输入您的真实姓名");
	});
	username.blur(function(){
		var info=username_info;
		if(username.val()==""){
			info.html("<i></i>用户名不能为空");
			username.css({"border":'1px solid rgb(255, 128, 128)'});
		}
		else if(username.val().length<2||username.val().length>16){
			info.html("姓名长度不符合");
			username.css({"border":'1px solid rgb(255, 128, 128)'});
		}else{
			info.html("");
			info.css({"border":'0px'});
		}
	});
	
	password.focus(function(){
		var info=password_info;
		password.css({"border":'1px solid #BABABA'});
		info.css({"visibility": 'visible'});
		info.css({"border":'1px solid #BABABA'});
		info.html("6—16个字符，不含特殊符号");
	});
	password.blur(function(){
		var info=password_info;
		var reg=/[^A-Za-z0-9_\s]/g 
		if(password.val()==""){
			info.html("密码不能为空");
			password.css({"border":'1px solid rgb(255, 128, 128)'});
		}else if((password.val().length<6||password.val().length>16)){
			info.html("密码长度不符");
			password.css({"border":'1px solid rgb(255, 128, 128)'});
		}else if(reg.test(password.val())){
			info.html("密码中不能含有特殊符号");
			password.css({"border":'1px solid rgb(255, 128, 128)'});
		}else{
			info.html("");
			info.css({"border":'0px'});
		}
	});
	
	password2.focus(function(){
		var info=password2_info;
		password2.css({"border":'1px solid #BABABA'});
		info.css({"visibility": 'visible'});
		info.css({"border":'1px solid #BABABA'});
		info.html("请重复密码");
	});
	password2.blur(function(){
		var info=password2_info;
		if(password2.val()==""){
			info.html("不能为空");
			password2.css({"border":'1px solid rgb(255, 128, 128)'});
		}else if(password.val()!=password2.val()){
			info.html("密码长度不符");
			password2.css({"border":'1px solid rgb(255, 128, 128)'});
		}else{
			info.html("");
			info.css({"border":'0px'});
		}
	});
	
	email.focus(function(){
		var info=email_info;
		email.css({"border":'1px solid #BABABA'});
		info.css({"visibility": 'visible'});
		info.css({"border":'1px solid #BABABA'});
		info.html("请填写邮箱地址");
	});
	email.blur(function(){
		var info=email_info;
		var reg= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(email.val()==""){
			info.html("不能为空");
			email.css({"border":'1px solid rgb(255, 128, 128)'});
		}else if(!reg.test(email.val())){
			info.html("邮箱地址格式不符");
			email.css({"border":'1px solid rgb(255, 128, 128)'});
		}else{
			info.html("");
			info.css({"border":'0px'});
		}
	});
	$(":submit[id=register_confirm]").click(function(check){
		if(checkUserName()){
			if(checkPass()){
				if(checkRePass()){
					 if(checkEmail()){
					}else{
						email.focus();
						preventDefault();
						check.preventDefault();
					}
				}else{
					password2.focus();
					check.preventDefault();
				}
			}else{
				password.focus();
				check.preventDefault();
			}
		}
		else{
			username.focus();
			check.preventDefault();
		}
	});
	
	
})


 <!--检验用户名-->
function checkUserName()
{
	var username=$("#username");
	if(username.val()==""){
		return false;
	}
	else if(username.val().length<2||username.val().length>16){
		return false;
	}else{
		return true;
	}
}

<!--密码验证-->
function checkPass()
{
	var password=$("#password");
	var reg=/[^A-Za-z0-9_\s]/g 
	if(password.val()==""){
		return false;
	}else if((password.val().length<6||password.val().length>16)){
		return false;
	}else if(reg.test(password.val())){
		return false;
	}else{
		return true;
	};
}
<!--邮箱验证-->	
function checkEmail(){
	var email=$("#email");
		var reg= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(email.val()==""){
			return false;
		}else if(!reg.test(email.val())){
			return false;
		}else{
			return true;
		}

	}
	
<!--验证确认密码-->	
function checkRePass(){
	var password=$("#password");
	var password2=$("#password2");
	if(password2.val()==""){
		return false;
	}else if(password.val()!=password2.val()){
		return false;
	}else{
		return true;
	}	
}