<?PHP
session_start();
if($_POST['wlogin']&&$_POST['wpassw'])
{
	$_SESSION['fls']=$_POST['wlogin']; 
	$_SESSION['passw']=$_POST['wpassw'];
	
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
                          <a title="ИНТЕРНЕТ КАБИНЕТ" class="logo" href="inner.php">ИНТЕРНЕТ КАБИНЕТ</a>
						  
<?PHP


function endout()
{
	echo "</div>";
	echo "<div class=\"left_col\">";
	echo "<div class=\"autz_win\">";
	echo "<div class=\"autz_win_t\">";
	echo "<form action=\"/\" method=\"post\">";
	echo "<h6><img src=\"images/h1.gif\" alt=\"Авторизация\" /></h6>";
	echo "<p>";
	echo "Пожалуйста, ";
	echo "<b>войдите или <br>зарегистрируйтесь</b><br><br>";
	echo "</p>";           
	echo "</form>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "<div class=\"center_col\">";
	echo "<h1>Авторизация</h1>";
	echo "<div class=\"c_tab\">";
	echo "<br><br><p style='color:red'>Логин или пароль неправильны!</p>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</body>";
	echo "</html>";
	session_destroy();
};

if (isset($_SESSION['fls']))
{

$username = $_SESSION['fls'];
$userpassw = $_SESSION['passw'];

	if(!($username&&$userpassw))
	{
		endout();
	}
	else
	{

		include 'db_settings.php';


		$query = "SELECT * FROM ".$db_tabl." WHERE ".$db_tabl.".fls='$username'";
		$query_result = mysql_query($query);
		if($query_result)
			$num_rows = mysql_numrows($query_result);
		if(!$num_rows)
		{
			endout();
		}
		else
		{
			$mlogin = mysql_result($query_result, 0, "fls");
			$mpassw = mysql_result($query_result, 0, "passw");
			if(($mlogin==$username)&&($mpassw==$userpassw))
			{
				$mfio = mysql_result($query_result, 0, "fio");
				$mfls = mysql_result($query_result, 0, "fls");
				$mnachisl = mysql_result($query_result, 0, "nachisl");
				$mnachisl_d = mysql_result($query_result, 0, "nachisl_data");
				$mposlopl = mysql_result($query_result, 0, "poslopl");
				$mposlopl_d = mysql_result($query_result, 0, "poslopl_data");
				$maddr = mysql_result($query_result, 0, "addres");
				$mdolg = mysql_result($query_result, 0, "dolg");
				//$minf1 = mysql_result($query_result, 0, "inf1");
				//$minf2 = mysql_result($query_result, 0, "inf2");
				//$minf3 = mysql_result($query_result, 0, "inf3");
				//$minf4 = mysql_result($query_result, 0, "inf4");
				
				$mon=substr($mnachisl_d,3);$mon=substr($mon,0,-5);
				switch($mon)
				{
				case 1:	$mon2="январь";	break;
				case 2:	$mon2="февраль";	break;
				case 3:	$mon2="март";	break;
				case 4:	$mon2="апрель";	break;
				case 5:	$mon2="май";	break;
				case 6:	$mon2="июнь";	break;
				case 7:	$mon2="июль";	break;
				case 8:	$mon2="август";	break;
				case 9:	$mon2="сентябрь";	break;
				case 10:$mon2="октябрь";	break;
				case 11:$mon2="ноябрь";	break;
				case 12:$mon2="декабрь";	break;
				}
				$mon2="   ".$mon2." ".substr($mnachisl_d,6);
				$mon=$mon." месяц ".substr($mnachisl_d,6);
				//$hms=$_GET['hms'];
				echo "<ul>";
				/*switch($hms)
				{
					case 2:
						echo "<li><a href=\"inner.php?hms=1\"><b>Ваш лицевой счет</b></a></li>";
						echo "<li class=\"hm_ac\"><a href=\"inner.php?hms=2\"><b>Услуги и тарифы</b></a></li>";
						echo "<li><a href=\"inner.php?hms=3\"><b>Ввод показаний счетчиков</b></a></li>";
					break;
					case 3:
						echo "<li><a href=\"inner.php?hms=1\"><b>Ваш лицевой счет</b></a></li>";
						echo "<li><a href=\"inner.php?hms=2\"><b>Услуги и тарифы</b></a></li>";
						echo "<li class=\"hm_ac\"><a href=\"inner.php?hms=3\"><b>Ввод показаний счетчиков</b></a></li>";
					break;
					default:
						echo "<li class=\"hm_ac\"><a href=\"inner.php?hms=1\"><b>Ваш лицевой счет</b></a></li>";
						echo "<li><a href=\"inner.php?hms=2\"><b>Услуги и тарифы</b></a></li>";
						echo "<li><a href=\"inner.php?hms=3\"><b>Ввод показаний счетчиков</b></a></li>";
					break;
				}*/
				echo "</ul>";
				echo "</div>";
				echo "<div class=\"left_col\">";
				echo "<div class=\"autz_win\">";
				echo "<div class=\"autz_win_t\">";
				echo "<form action=\"/lk/\" method=\"post\">";
				echo "<h6><img src=\"images/h1.gif\" alt=\"Авторизация\" /></h6>";
				echo "<p>";
				//echo "Добро пожаловать, ";
				echo "<b>".$mfio."</b><br>";
				echo "<b>".$maddr."</b><br>";
				echo "<b>ФЛС:".$mfls."</b><br><br>";
                echo "<b><a href=\"register.php?fls=".$mfls."&chkacc=1\">Настройка</a>";
				echo "</p>";
				echo "<input type=\"submit\" class=\"btn\" title=\"OK\" value=\" \" />";
				echo "</form>";
				echo "</div>";
				echo "</div>";
				echo "<ul class=\"l_link\">";
				echo "<li><a href=\"kvit3.php?&fls=".$mfls."\">Распечатать счет за текущий месяц;</a></li>";
				//echo "<li><a href=\"kvit2.php?fio=".$mfio."&addr=".$maddr."&fls=".$mfls."&sum=".$mnachisl."&dolg=".$mdolg."&fls=".$mfls."&inf1=".$minf1."&inf2=".$minf2."&inf3=".$minf3."&inf4=".$minf4."&mon=".$mon."&mon2=".$mon2."&dd=".$mposlopl_d."\">Распечатать детализированный счет за текущий месяц;</a></li>";
				//echo "<li><a href=\"kvit.php?fio=".$mfio."&addr=".$maddr."&fls=".$mfls."&sum=".$mnachisl."\">Распечатать счет аванса;</a></li>";
				//echo "<li><a href=\"#\" onClick=\"avval=window.prompt('Введите сумму аванса в формате РРРР.КК','');if(avval) {window.location = 'kvit.php?fio=".$mfio."&addr=".$maddr."&fls=".$mfls."&sum='+avval;}\">Распечатать счет аванса;</a></li>";
				//if($mdolg=='0.00')
				//	echo "<li><a href=\"#\" onClick=\"window.alert('Сумма задолженности нулевая.');return false;\">Распечатать счет на сумму задолженности.</a></li>";
				//else 
				//	echo "<li><a href=\"kvit.php?fio=".$mfio."&addr=".$maddr."&fls=".$mfls."&sum=".$mdolg."\">Распечатать счет на сумму задолженности.</a></li>";
				echo "</ul>";
				echo "</div>";
				echo "<div class=\"center_col\">";
				switch($hms)
				{
					case 2:
						echo "<h1>Услуги и тарифы</h1>";
						echo "<div class=\"c_tab\">";
						echo "<table>";
						echo "<tr>";
						echo "<td>";
						echo "<p>Услуга</p>";
						echo "</td>";
						echo "<td class=\"ct_td\">";
						echo "<p align=left>Тариф</p>";
						echo "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Техническое обслуживание</td>";
						echo "<td class=\"ct_td\">17.9 руб./мес.</td>";
						echo "</tr>";
						echo "</table>";
					break;
					case 3:
						echo "<h1>Ввод показаний счетчиков</h1>";
						echo "<div class=\"c_tab\">";
						echo "<table>";
						echo "<tr>";
						echo "<td>";
						echo "<p>Тут будет ввод показаний счетчиков</p>";
						echo "</td>";
						echo "</table>";
					break;
					default:
						echo "<h1>Ваш лицевой счёт (информация на ".$mnachisl_d.")</h1>";
						echo "<div class=\"c_tab\">";
						echo "<table>";
						echo "<tr>";
						echo "<td>";
						echo "<p>Начисления за текущий месяц</p>";
						echo "<p>Последняя оплата (от ".$mposlopl_d.")</p>";
						echo "</td>";
						echo "<td class=\"ct_td\">";
						echo "<p>".$mnachisl." руб.</p>";
						echo "<p>".$mposlopl." руб.</p>";
						echo "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Долг</td>";
						echo "<td class=\"ct_td\">".$mdolg." руб.</td>";
						echo "</tr>";
						echo "</table>";
                        
                        //Добавление списка оплат
                        echo "<p> </p>";
                        echo "<h1>Ваш список оплат</h1>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>";
                        echo "Дата";
                        echo "</td>";
                        echo "<td>";
                        echo "Сумма";
                        echo "</td>";
                        echo "</tr>";
                        $result_sql = mysql_query("SELECT * FROM ".$db_tabl_opl." WHERE fls='$username'");
                        for ($i = 1; $i<=mysql_num_rows($result_sql); $i++)
                        {
                             echo "<tr>";
                             
                             echo "<td>";
                             echo mysql_result($result_sql,$i-1,"dateopl");
                             echo "</td>";
                             
                             echo "<td>";
                             echo mysql_result($result_sql,$i-1,"sumopl")." руб.";
                             echo "</td>";
                             
                             echo "</tr>";
                        }
                        echo "</table>";
					break;
				}
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "</body>";
				echo "</html>";
			}
			else
			{
				endout();
			}
		}
	}
}
else
{
	endout();
}
?>
 
                          