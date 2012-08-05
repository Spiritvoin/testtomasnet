<?PHP
function Autoregister()
{
    include 'db_settings.php'; 
    $query='SELECT fio FROM '.$db_tabl.' WHERE fls = "0000000000" and fio="Autoregister"';
    $query_result = mysql_query($query);
    return mysql_num_rows($query_result)>0;
    //if (my)
    //print_r(myslq_fetch_array($query_result));
    //return (mysql_result($query_result,"fio")=="Autoregister");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
	
<html>
 <head>
    <title>Личный кабинет</title>

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
                          <a title="ИНТЕРНЕТ КАБИНЕТ" class="logo" href="#">ИНТЕРНЕТ КАБИНЕТ</a>
                     </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Autorzation Window ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="autz_win">
                           <div class="autz_win_t">
						  
                                 <form action="inner.php" method="post">
                                      <h6><img src="images/h1.gif" alt="Авторизация" /></h6>
                                      <p class="in">Логин <input name="wlogin" type="text"  /></p>
                                      <p class="in1">Пароль <input name="wpassw" TYPE="PASSWORD"  /></p>    
                                      <input type="submit" class="btn" title="OK" value=" " />
 <?PHP
if (Autoregister())
{
    echo "<a class=\"reg\" href=\"register.php\">Регистрация</a>";
}
else
{
    echo "<a class=\"reg\" href=\"#\" onClick=\"window.alert('Регистрация невозможна!');return false;\">Регистрация</a>";
}      
?>
                                      <a href="forgot.php">Забыли пароль?</a>
                                </form>
                           </div>
                     </div>
               </div>
         </div>
   </body>
</html>