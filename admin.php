<?PHP
session_start();
  if (isset($_SESSION['adm_pass']))
  {
      if (test_pass($_SESSION['adm_pass']))
      {
          Roof();
          autorize();
      }
      else
      {
          Roof();
          unautorize();
      }
  }
  else
  {
      if (isset($_POST['next_pass'])&&test_pass($_POST['adm_pass']))
      {
          $_SESSION['adm_pass']=$_POST['adm_pass'];
          Roof();
          autorize();                                 
      }
      else
      {      
          Roof();
          unautorize();
      }
  }
  
function test_pass($pass_test)
{
      include 'db_settings.php'; 
      $query="SELECT passw FROM $db_tabl WHERE fls = \"0000000000\" and passw='".$pass_test."'";
      $query_result = mysql_query($query);
      print_r(mysql_num_rows($query_result));
      return mysql_num_rows($query_result)>0;
}

function Roof()
{
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"";
echo "    \"http://www.w3.org/TR/html4/loose.dtd\">";
    
echo "<html>";
echo " <head>";
echo "   <title></title>";

echo "    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";
echo "    <meta name=\"keywords\" content=\"\">";
echo "    <meta name=\"description\" content=\"\" >";
echo "    <meta name=\"robots\" content=\"index, follow\">";
echo "    <link rel=\"Shortcut Icon\" type=\"image/x-icon\" href=\"\">";
echo "    <link rel=\"stylesheet\" type=\"text/css\" media=\"screen, projection\" href=\"css/main.css\">";
echo "</head>";
echo "  <body>";
echo "         <div class=\"global_all\">";
echo "               <div class=\"global\">";
echo "                     <div class=\"head\">";
echo "                          <a title=\"ИНТЕРНЕТ КАБИНЕТ\" class=\"logo\" href=\"/\">ИНТЕРНЕТ КАБИНЕТ</a>";
echo "                     </div>";
echo "                     <div class=\"left_col\">";
echo "                           <div class=\"autz_win\">";
echo "                                 <div class=\"autz_win_t\">";
echo "                                      <form action=\"/\" method=\"post\">";
echo "                                           <h6><img src=\"images/h1.gif\" alt=\"Авторизация\" /></h6>";
echo "                                           <p><br><b>Пожалуйста, зарегистрируйтесь</b><br></p>";
echo "                                      </form>";
echo "                                 </div>";
echo "                           </div>";
echo "              </div>";
}

function unautorize()
{
    echo "                     <div class=\"center_col\">";
    echo "                           <h1>Авторизация доступа</h1>";
    echo "                         <div class=\"c_tab\" style=\"width: 600px\">";
    echo "<br>";
    echo "<FORM NAME =\"download\" METHOD =\"POST\" ACTION = \"admin.php\">";
    echo "<p class=\"in\">Введите пароль администратора: </p><br>";
    echo "<input name=\"adm_pass\" type=\"password\" id=\"adm_pass\" style=\"width: 100px\" />";
    echo "<input align=right type=\"submit\" class=\"btn\" name=\"next_pass\" title=\"OK\" value=\"Продолжить\" /><br><br>";
    echo "</FORM>";
}
function autorize()
{    
    echo "                     <div class=\"center_col\">";
    echo "                           <h1>Выгрузка и загрузка информации о плательщиках</h1>";
    echo "                         <div class=\"c_tab\" style=\"width: 600px\">";
    echo "<br>";
    echo "<FORM NAME =\"download\" METHOD =\"POST\" ACTION = \"admin.php\">";
    echo "<h3>Выгрузка информации о плательщикe</h3><br>";
    echo "<p class=\"in\">Введите ФЛС плательщика: </p><br><input name=\"fls1\" type=\"text\" id=\"fls1\" style=\"width: 100px\" />";
    echo "<input align=right type=\"submit\" class=\"btn\" title=\"OK\" value=\"Сохранить как XML\" /><br><br>";
    echo "</FORM>";
    echo "<hr>";
    echo "<h3>Загрузка информации о плательщикe</h3>";
    echo "<table border=0><tr><td>";
    echo "<form enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3000000\" />";
    echo "Путь к XML-файлу: <input name=\"userfile\" type=\"file\" /><br><br>";
    echo "<input type=\"submit\" value=\"Загрузить в виде XML\" />";
    echo "</form></td><td>";

    echo "<form enctype=\"multipart/form-data\" action=\"admin.php?sql=1\" method=\"post\">";

    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"3000000\" />";
    echo "Путь к SQL-файлу: <input name=\"userfile\" type=\"file\" /><br><br>";
    echo "<input type=\"submit\" value=\"Загрузить в виде SQL\" />";
    echo "</form></td></tr></table>";


    if (isset($_POST['fls1']))
    {
        $userfls = $_POST['fls1'];
        if(!$userfls)
            {echo "<p style='color:red'>Пользователь с таким ФЛС не существует!</p>";}
        else
        {
            include 'db_settings.php';

            $query = "SELECT * FROM ".$db_tabl." WHERE ".$db_tabl.".fls='$userfls'";
            $query_result = mysql_query($query);
            if($query_result)
                $num_rows = mysql_numrows($query_result);
            if(!$num_rows)
                {echo "<p style='color:red'>Пользователь с таким ФЛС не существует!</p>";}
            else
            {
                $myFile = "temp.xml";
                $fh = fopen($myFile, 'w') or die("can't open file");
                $mfio = mysql_result($query_result, 0, "fio");
                $mfls = mysql_result($query_result, 0, "fls");
                $mhash = mysql_result($query_result, 0, "hash");
                $memail = mysql_result($query_result, 0, "email");
                $mnachisl = mysql_result($query_result, 0, "nachisl");
                $mnachisl_d = mysql_result($query_result, 0, "nachisl_data");
                $mposlopl = mysql_result($query_result, 0, "poslopl");
                $mposlopl_d = mysql_result($query_result, 0, "poslopl_data");
                $maddr = mysql_result($query_result, 0, "addres");
                $mdolg = mysql_result($query_result, 0, "dolg");
                $minf1 = mysql_result($query_result, 0, "inf1");
                $minf2 = mysql_result($query_result, 0, "inf2");
                $minf3 = mysql_result($query_result, 0, "inf3");
                $minf4 = mysql_result($query_result, 0, "inf4");

                $FileData = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                $FileData=$FileData."<platelschik fls=\"".$mfls."\" hash=\"".$mhash."\" >\n";
                $FileData=$FileData."<fio>".$mfio."</fio>\n";
                $FileData=$FileData."<addres>".$maddr."</addres>\n";
                $FileData=$FileData."<email>".$memail."</email>\n";
                $FileData=$FileData."<nachisl>".$mnachisl."</nachisl><nachisl_data>".$mnachisl_d."</nachisl_data>\n";
                $FileData=$FileData."<posledn_oplata>".$mposlopl."</posledn_oplata><posledn_oplata_data>".$mposlopl_d."</posledn_oplata_data>\n";
                $FileData=$FileData."<dolg>".$mdolg."</dolg>\n";

                $FileData=$FileData."<inf1>".$minf1."</inf1>\n";
                $FileData=$FileData."<inf2>".$minf2."</inf2>\n";
                $FileData=$FileData."<inf3>".$minf3."</inf3>\n";
                $FileData=$FileData."<inf4>".$minf4."</inf4>\n";
                $FileData=$FileData."</platelschik>";

                fwrite($fh, $FileData);
                fclose($fh);
                echo "<a href='temp.xml' style='color:red'>Ссылка для скачивания</a>";
            }
        }
    }

    if (is_uploaded_file($_FILES['userfile']['tmp_name']))
    {
	    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name'])) 
	    {
		    include 'db_settings.php';
	        echo "<p style='color:green'>Файл успешно загружен</p>";
		    $myFile = $_FILES['userfile']['name'];
		    $fh = fopen($myFile, 'r') or die("can't open file");
		    $data = fread($fh, filesize($myFile));
		    fclose($fh);
		    if (!isset($_GET['sql']))
		    {
			    $substring= "fls"; 
			    if (strpos($data, $substring))
			    {
				    $start=strpos($data, $substring);
					    $nfls=substr($data,$start+5,10);
				    
				    $substring= "hash"; 
				    if($start=strpos($data, $substring))
					    $nhash=substr($data,$start+6,10);
							    
				    $substring1= "<fio>"; 
				    $substring2= "</fio>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $nfio=substr($data,$start+5,$stop-$start-5);
								    
				    $substring1= "<addres>"; 
				    $substring2= "</addres>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $naddr=substr($data,$start+8,$stop-$start-8);
					    
				    $substring1= "<email>"; 
				    $substring2= "</email>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $nemail=substr($data,$start+7,$stop-$start-7);
				    
				    $substring1= "<nachisl>"; 
				    $substring2= "</nachisl>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $nnach=substr($data,$start+9,$stop-$start-9);
					    
				    $substring1= "<nachisl_data>"; 
				    $substring2= "</nachisl_data>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $nnach_d=substr($data,$start+14,$stop-$start-14);
					    
				    $substring1= "<posledn_oplata>"; 
				    $substring2= "</posledn_oplata>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $nposlopl=substr($data,$start+16,$stop-$start-16);
					    
				    $substring1= "<posledn_oplata_data>"; 
				    $substring2= "</posledn_oplata_data>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $nposlopl_d=substr($data,$start+21,$stop-$start-21);
					    
				    $substring1= "<dolg>"; 
				    $substring2= "</dolg>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ndolg=substr($data,$start+6,$stop-$start-6);
					    
				    $substring1= "<inf1>"; 
				    $substring2= "</inf1>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf1=substr($data,$start+6,$stop-$start-6);
					    
				    $substring1= "<inf2>"; 
				    $substring2= "</inf2>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf2=substr($data,$start+6,$stop-$start-6);
					    
				    $substring1= "<inf3>"; 
				    $substring2= "</inf3>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf3=substr($data,$start+6,$stop-$start-6);
					    
				    $substring1= "<inf4>"; 
				    $substring2= "</inf4>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf4=substr($data,$start+6,$stop-$start-6);
					    
				    $substring1= "<inf5>"; 
				    $substring2= "</inf5>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf5=substr($data,$start+6,$stop-$start-6);
					    
					    $substring1= "<inf6>"; 
				    $substring2= "</inf6>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf6=substr($data,$start+6,$stop-$start-6);
					    
					    $substring1= "<inf7>"; 
				    $substring2= "</inf7>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf7=substr($data,$start+6,$stop-$start-6);
					    
					    $substring1= "<inf8>"; 
				    $substring2= "</inf8>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf8=substr($data,$start+6,$stop-$start-6);
					    
					    $substring1= "<inf9>"; 
				    $substring2= "</inf9>"; 
				    if(($start=strpos($data, $substring1))&&($stop=strpos($data, $substring2)))
					    $ninf9=substr($data,$start+6,$stop-$start-6);
				    
				    if($nfls&&$nfio&&$nhash&&$naddr&&$nemail&&$nnach&&$nnach_d&&$nposlopl&&$nposlopl_d&&$ndolg)
				    {
						    $sql_check="SELECT fls FROM ".$db_tabl." WHERE ".$db_tabl.".fls='$nfls'";
						    $query_result = mysql_query($query);
						    $num_rows = mysql_numrows($query_result);
						    if($num_rows)
							    $sql_q="UPDATE ".$db_tabl." SET nachisl='$nnach',nachisl_data='$nnach_d',poslopl='$nposlopl',poslopl_data='$nposlopl_d',dolg='$ndolg',inf1='$ninf1',inf2='$ninf2',inf3='$ninf3',inf4='$ninf4',inf5='$ninf5',inf6='$ninf6',inf7='$ninf7',inf8='$ninf8',inf9='$ninf9' WHERE fls='$nfls'";
						    else
							    $sql_q="INSERT INTO ".$db_tabl." (fls,fio,hash,addres,email,nachisl,nachisl_data,poslopl,poslopl_data,dolg,inf1,inf2,inf3,inf4,inf5,inf6,inf7,inf8,inf9) VALUES ('$nfls','$nfio','$nhash','$naddr','$nemail','$nnach','$nnach_d','$nposlopl','$nposlopl_d','$ndolg','$ninf1','$ninf2','$ninf3','$ninf4','$ninf5','$ninf6','$ninf7','$ninf8','$ninf9')";
						    
						    if(mysql_query($sql_q))
							    echo "<p style='color:green'>Данные добавлены в БД</p>";
						    else
							    echo "<p style='color:green'>Данные не добавлены в БД</p>";
				    }
				    else
				    {
					    echo "<p style='color:red'>Данные некорректны</p>";
				    }
			    }
		    }
		    elseif($_GET['sql']==1)
		    {
			    //$sql_q=$data;
                $data = str_replace("\r\n","",$data);
                $arr_data = split(";", $data);
                for ($i = 0; i<=Count($arr_data); $i++)
                {
                    $sql_q = $arr_data[$i];
                    $result = mysql_query($sql_q);
                    print_r($result);
                    $err_sql = mysql_error();
                    print_r($err_sql);                    
                };

			    if($result)
				    echo "<p style='color:green'>Данные добавлены в БД</p>";
			    else
				    echo "<p style='color:red'>Данные не добавлены в БД</p>";
		    }
	    }
    }
}
?>