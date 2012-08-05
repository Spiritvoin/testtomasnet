<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
	
<html>
 <head>
    <title></title>

    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <meta name="keywords" content="">
    <meta name="description" content="" >
    <meta name="robots" content="index, follow">

    <!-- Favicon -->
    <link rel="Shortcut Icon" type="image/x-icon" href="">

    <!-- Links -->
    <link rel="stylesheet" type="text/css" media="screen, projection" href="css/main.css">
</head>
    <body>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Global ~~~~~~~~~~~~~~~~~~~~~~~~~-->
         <div class="global_all">
               <div class="global">
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Head ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="head">
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Head/Logo ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                          <a title="ИНТЕРНЕТ КАБИНЕТ" class="logo" href="/">ИНТЕРНЕТ КАБИНЕТ</a>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Head/Menu ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                         
                     </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Left Col ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="left_col">
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Left Col/In Autorization ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                           <div class="autz_win">
                                 <div class="autz_win_t">
                                      <form action="/" method="post">
                                           <h6><img src="images/h1.gif" alt="Авторизация" /></h6>
                                           <p><br><b>Пожалуйста, зарегистрируйтесь</b><br></p>
                                      </form>
                                 </div>
                           </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Left Col/Links ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                           
                     </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Center Col ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="center_col">
                           <h1>Восстановление пароля</h1>
                           <div class="c_tab" style="width: 600px">
<br>
<FORM NAME ="forgot" METHOD ="POST" ACTION = "forgot.php">
<p class="in">Введите email, указанный при регистрации: </p><br><input name="femail" type="text" id="femail" style="width: 100px" />
<input align=right type="submit" class="btn" title="OK" value="OK" /><br><br>
</FORM>

<?PHP
if (isset($_POST['femail']))
{

$useremail = $_POST['femail'];
if(!$useremail)
{echo "<p style='color:red'>Пользователь с таким email не существует!</p>";}
else{

include 'db_settings.php';

$query = "SELECT * FROM ".$db_tabl." WHERE ".$db_tabl.".email='$useremail'";
$query_result = mysql_query($query);
if($query_result)
$num_rows = mysql_numrows($query_result);
if(!$num_rows)
{echo "<p style='color:red'>Пользователь с таким email не существует!</p>";}
else
{
$username = mysql_result($query_result, 0, "username");
$userpassw = mysql_result($query_result, 0, "userpassw");
mail($useremail, "Password", $username."\n".$userpassw);
echo "<p style='color:green'>Пароль отправлен на email!</p>";
}
}
}
?>