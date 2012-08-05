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
                                           
                                           <p><br><b>Установка</b><br></p>
                                      </form>
                                 </div>
                           </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Left Col/Links ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                           
                     </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Center Col ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="center_col">
                           <h1>Установка "Личного кабинета"</h1>
                           <div class="c_tab" style="width: 600px">
<br>

<FORM NAME ="install" METHOD ="POST" ACTION = "install.php">
<table>
<tr><td><p class="in">Введите адрес БД:  </p></td><td><input name="dbpath" type="text"  id="dbpath" style="width: 100px" /></td><td><p class="in">(обычно - localhost) </p></td></tr>
<tr><td><p class="in">Введите имя пользователя БД:  </p></td><td><input name="dbuser" type="text" id="dbuser" style="width: 100px" /></td><td><p class="in"> </p></td></tr>
<tr><td><p class="in">Введите пароль пользователя БД:  </p></td><td><input name="dbpassw" type="password"  id="dbpassw" style="width: 100px" /></td><td><p class="in"> </p></td></tr>
<tr><td><p class="in">Введите имя БД:  </p></td><td><input name="dbname" type="text" id=\"dbname"  style="width: 100px" /></td><td><p class="in"> </p></td></tr>
<tr><td><p class="in">Введите имя таблицы пользователей:  </p></td><td><input name="dbtabl" type="text" id="dbtabl"  style="width: 100px" /></td><td><p class="in"> </p></td></tr>
<tr><td><p class="in">Введите имя таблицы оплат:  </p></td><td><input name="dbtablopl" type="text" id="dbtablopl"  style="width: 100px" /></td><td><p class="in"> </p></td></tr>
<tr><td><p class="in">Введите пароль администратора:  </p></td><td><input name="dbpassadm" type="text" id="dbpassadm"  style="width: 100px" /></td><td><p class="in"> (максимум - 10 символов) </p></td></tr>
<tr><td><p class="in">Автоматическая регистрация пользователей:</p></td><td><input name="dbreg" type="checkbox" id="dbreg"/></td><td><p class="in"> </p></td></tr>
</table>
<input align=right type="submit" class="btn" title="OK" value="Сохранить настройки" /><br><br>

</FORM>
<?PHP



if (isset($_POST['dbpath'])&&isset($_POST['dbuser'])&&isset($_POST['dbpassw'])&&isset($_POST['dbname'])&&isset($_POST['dbtabl'])&&isset($_POST['dbpassadm'])&&isset($_POST['dbtablopl']))
{
		$db_username = $_POST['dbuser'];
		$db_password = $_POST['dbpassw'];
		$db_database = $_POST['dbname'];
		$db_host = $_POST['dbpath']; 
		$db_tabl = $_POST['dbtabl'];
        $db_tabl_opl = $_POST['dbtablopl'];
        $db_pass_adm = $_POST['dbpassadm'];
		mysql_connect($db_host, $db_username, $db_password);
		@mysql_select_db($db_database) or die("Не получается соединиться с БД");
		echo "<p style='color:green'>Cоединение с БД успешно!</p>";
        @mysql_query("DROP TABLE $db_tabl");
		$sql_check="CREATE TABLE $db_tabl (fls      varchar(10) NOT NULL,    
                     hash            varchar(10),    
                     passw           varchar(10),    
                     fio             varchar(50),    
                     addres          varchar(100),    
                     email           varchar(20),    
                     nachisl         varchar(15),    
                     nachisl_data    varchar(10),    
                     poslopl         varchar(15),    
                     poslopl_data    varchar(15),    
                     peny            varchar(15),    
                     dolg            varchar(15),    
                     kvart           varchar(6),    
                     vid_sobstv      varchar(20),    
                     com_sq          varchar(10),    
                     otp_sq          varchar(10),    
                     liv_sq          varchar(10),    
                     kol_pr          varchar(2),    
                     dolg_nach       varchar(15),
                     itog_b          varchar(15),    
                     itog_a          varchar(15),    
                     vid_plat        varchar(255),    
                     volumes         varchar(255),    
                     tarifs_b        varchar(255),    
                     nachisles100_b  varchar(255),    
                     lgots_b         varchar(255),    
                     nachisles_b     varchar(255),    
                     tarifs_a        varchar(255),    
                     nachisles100_a  varchar(255),    
                     lgots_a         varchar(255),    
                     nachisles_a     varchar(255),    
                     inachisles100_b varchar(255),    
                     ilgots_b        varchar(255),    
                     inachisles_b    varchar(255),    
                     inachisles100_a varchar(255),    
                     ilgots_a        varchar(255),    
                     inachisles_a    varchar(255),    
                     pol_plat        varchar(200),
					 PRIMARY KEY (`fls`))";
		if(mysql_query($sql_check))
		{
            echo "<p style='color:green'>Таблица пользователей создана!</p>";
            //создать вторую
            @mysql_query("DROP TABLE $db_tabl_opl");
            $sql_check="CREATE TABLE $db_tabl_opl (fls      varchar(10) NOT NULL,    
                        dateopl         varchar(10),    
                        sumopl          varchar(15))";
            if(mysql_query($sql_check))
            {
                echo "<p style='color:green'>Таблица платежей создана!</p>";
                $myFile = "db_settings.php";
                $fh = fopen($myFile, 'w') or die("Невозможно открыть файл для записи информации о БД!");
                $FileData="<?PHP\n";
                $FileData=$FileData."\$db_username = ".$db_username.";\n";
                $FileData=$FileData."\$db_password = ".$db_password.";\n";
                $FileData=$FileData."\$db_database = ".$db_database.";\n";
                $FileData=$FileData."\$db_host = ".$db_host.";\n";
                $FileData=$FileData."\$db_tabl = ".$db_tabl.";\n";
                $FileData=$FileData."\$db_tabl_opl = ".$db_tabl_opl.";\n";
                $FileData=$FileData."mysql_connect(\$db_host, \$db_username, \$db_password);\n";
                $FileData=$FileData."@mysql_select_db(\$db_database) or die(\"Unable to select database\");?>";
                fwrite($fh, $FileData);
                fclose($fh);
                echo "<p style='color:green'>Информация о БД сохранена в файл!</p>";
                if (isset($_POST['dbpath']))
                {
                     $sql_check="INSERT INTO $db_tabl 
                                (fls, passw, fio)
                                VALUES(\"0000000000\", \"$db_pass_adm\", \"Autoregister\")";               
                }
                else
                {
                    $sql_check="INSERT INTO $db_tabl 
                                (fls, passw)
                                VALUES(\"0000000000\", \"$db_pass_adm\")";
                }
                if(mysql_query($sql_check))
                {
                    echo "<p style='color:green'>Пароль администратора сохранен!</p>";
                }
                else
                {
                    echo "<p style='color:red'>Пароль администратора не сохранен!</p>";
                }
            }            
			else
            {
                echo "<p style='color:red'>Не удалось создать таблицу оплат!</p>";
                echo "<p style='color:red'> ".mysql_error()."</p>";
            }
		}
		else
		{
            echo "<p style='color:red'>Не удалось создать таблицу пользователей!</p>";
        }
}
?>


