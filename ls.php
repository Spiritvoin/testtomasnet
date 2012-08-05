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
                          <a title="ИНТЕРНЕТ КАБИНЕТ" class="logo" href="index.html">ИНТЕРНЕТ КАБИНЕТ</a>
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
                           <h1>Соглашение о предоставлении услуг</h1>
                           <div class="c_tab" style="width: 720px">



<?PHP

function outreg()
{
	echo "<FORM NAME =\"regpage\" METHOD =\"POST\" ACTION = \"ls.php\">";
	echo "<table>";
	
	echo "<tr><td><p class=\"in1\">ФЛС: </p></td>";
	echo "<td><input name=\"fls\" type=\"text\"  id=\"fls\" />";
	echo "<small> *Номер ФЛС</small></td>  </tr>";
	
	echo "<tr><td><p class=\"in1\">ФИО: </p></td>";
	echo "<td><input name=\"fio\" type=\"text\"  id=\"fio\" />";
	echo "<small> *ФИО полностью</small></td> </tr>";
	
	echo "<tr><td><p class=\"in1\">Адрес: </p></td>";
	echo "<td><input name=\"addr\" type=\"text\"  id=\"addr\" />";
	echo "<small> *Адрес полностью</small></td> </tr>";
	
//	echo "<tr><td><p class=\"in1\">Последовательность символов с квитанции: </p></td>";
//	echo "<td><input name=\"hash\" type=\"text\" id=\"hash\" maxlength=10 style=\"width: 100px\" />";
//	echo "<small> *10 символов с квитанции</small></td></tr>  ";

	echo "<tr><td><p class=\"in1\">Пароль: </p></td>";
	echo "<td><input name=\"passw\" type=\"text\" id=\"passw\" maxlength=10 style=\"width: 100px\" maxlength=10 />";
	echo "<small> *10 символов макс, только латинские буквы и цифры</small></td> </tr>";
	echo "<tr><td><p class=\"in1\">Пароль еще раз: </p></td>";
	echo "<td><input name=\"passw2\" type=\"text\" id=\"passw2\" maxlength=10 style=\"width: 100px\" maxlength=10 />";
	echo "<small> *Повторите пароль</td> </tr>";
	echo "<tr><td><p class=\"in1\">Электронная почта: </p></td>";
	echo "<td><input name=\"email\" type=\"text\"  id=\"email\" />";
	echo "<small> *Ваш адрес электронной почты</small></td> </tr>";
	
	echo "</td>";
	echo "</tr></table><br>";
    echo "<textarea name=\"body\" COLS=87 ROWS=25 readonly WRAP=\"virtual\">";
    $f = fopen($fname=realpath("./ls/ls.txt"), "rt") or die("Ошибка открытия файла!");
    while (!feof($f)) {
        echo (fgets($f));
    }
    fclose($f);
    echo "</textarea><br>";
    echo "<input type=checkbox name = \"chkacc\" value = \"accept\"/>";
    echo " Я согласен с условиями соглашения <br>";
	echo "<input align=center type=\"submit\" class=\"btn\" title=\"Продолжить регистрацию\" value=\"Продолжить\" />";
	echo "</FORM>";
};

function isemail($email) {
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
};

function isalphanum($txtval) {
	if(ctype_alnum($txtval)){
	return 1;
	}else
	{return 0;}
};

function isalpha($txtval) {
	if(ctype_alpha($txtval)){
	return 1;
	}else
	{return 0;}
};

if (isset($_POST['fls']))
{
	echo "<br><br>";

	$userfls = $_POST['fls'];
//	$userhash = $_POST['hash'];
	$userfio = $_POST['fio'];
	$useraddr = $_POST['addr'];
	$userpassw = $_POST['passw'];
	$userpassw2 = $_POST['passw2'];
	$useremail = $_POST['email'];
//	if(!($useraddr&&$userfio&&$userfls&&$userhash&&$userpassw&&$userpassw2&&$useremail)||(!($userpassw==$userpassw2)))
    if(!($useraddr&&$userfio&&$userfls&&$userpassw&&$userpassw2&&$useremail)||(!($userpassw==$userpassw2)))
		{echo "<p style='color:red'>Введены некорректные данные, пожалуйста проверьте и введите заново.</p>";}
	else{
		if(isemail($useremail)&&is_numeric($userfls)&&isalphanum($userhash)&&isalphanum($userpassw))
		{

		include 'db_settings.php';
		
		//проверка на "был ли такой hash ранее"
//		$query = "SELECT hash FROM ".$db_tabl." WHERE ".$db_tabl.".hash='$userhash'";
//		$query_result = mysql_query($query);
//		if($query_result)
//			$num_rows = mysql_numrows($query_result);
//		if($num_rows)
//			{echo "<p style='color:red'>Пользователь с таким hash уже существует, пожалуйста выберите другой hash.</p>";}
//		else
//		{
			//проверка на "был ли такой FLS ранее"
			$query = "SELECT fls FROM ".$db_tabl." WHERE ".$db_tabl.".fls='$userfls'";
			$query_result = mysql_query($query);
			$num_rows = mysql_numrows($query_result);
			if($num_rows)
				{echo "<p style='color:red'>Пользователь с таким номером ФЛС уже существует.</p>";}
			else
			{
				if($userpassw!=$userpassw2)
					{echo "<p style='color:red'>Введенные пароли не одинаковы!</p>";}
				else
				{
					//INSERTING NEW USER
					//print "INSERT INTO users (login,fls,hash,passw,fio,email) VALUES ($username,$userfls,$userhash,$userpassw,$userfio,$useremail)";
//					$query = "INSERT INTO ".$db_tabl." (fls,fio,hash,addres,passw,email,nachisl,poslopl) VALUES ('$userfls','$userfio','$userhash','$useraddr','$userpassw','$useremail','0','0')";
                    $query = "INSERT INTO ".$db_tabl." (fls,fio,addres,passw,email,nachisl,poslopl) VALUES ('$userfls','$userfio','$useraddr','$userpassw','$useremail','0','0')";
					$query_result = mysql_query($query);
					if($query_result)
					{
						
						echo "<p style='color:green'>Поздравляем, вы успешно зарегистрировались!</p><br><br>";
						echo "<a href=\"/\">Войти</a>";
						mail($useremail, "Registration", $username."\n".$userpassw);
					}
					else{echo "<p style='color:red'>Неизвестная ошибка!</p>";}
				}
			}
//		}
		}
	}
}
else
{
    if (isset($_POST["chkacc"]))
    {
    }
    else
    {
	  outreg();
    }
}
?>





</div>
                     </div>
               </div>
         </div>
   </body>
</html>