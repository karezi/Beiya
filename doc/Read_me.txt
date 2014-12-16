需要更改信息的地方：
	db_func.php:登录数据库的用户名和密码

	main.php或config.php中的siteroot

	timer01.py,timer02.py：connect函数;timer01.py中的parse函数中读取xml文件的路径
	

	
关于设置和一些文件的说明：
	apache或者nginx的DocumentRoot目录设为beiya；
	timer01.py用来更新首页推荐内容，要一直打开；（Requirements:python 解释器，mysqldb模块）
	timer02.py用来定时检测和更新评分数据