<?PHP
$db_username = of_project;
$db_password = of_project;
$db_database = of_project;
$db_host = localhost;
$db_tabl = of_project_user;
$db_tabl_opl = of_project_payment;
mysql_connect($db_host, $db_username, $db_password);
@mysql_select_db($db_database) or die("Unable to select database");?>