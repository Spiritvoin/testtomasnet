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
                          <a title="�������� �������" class="logo" href="/">�������� �������</a>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Head/Menu ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                         
                     </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Left Col ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="left_col">
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Left Col/In Autorization ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                           <div class="autz_win">
                                 <div class="autz_win_t">
                                      <form action="/" method="post">
                                           <h6><img src="images/h1.gif" alt="�����������" /></h6>
                                           <p><br><b>����������, �����������������</b><br></p>
                                      </form>
                                 </div>
                           </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Left Col/Links ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                           
                     </div>
     <!--~~~~~~~~~~~~~~~~~~~~~~~~~ Center Col ~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="center_col">
                           <h1>�����������</h1>
                           <div class="c_tab" style="width: 720px">



<?PHP
include 'db_settings.php';

function outreg($table='')
{

    $sql='select * from '.$table.' where fls=\''.$_REQUEST['fls'].'\'';
    $request=mysql_query($sql);
    $Fields=array('fls'=>'','fio'=>'','addres'=>'','email'=>'');
    if (is_resource($request)&&mysql_num_rows($request)>0)
    {
       $Fields=mysql_fetch_array($request);
    }

	echo "<FORM NAME =\"regpage\" METHOD =\"POST\" ACTION = \"register.php\">";
	echo "<table>";
	
	echo "<tr><td><p class=\"in1\">���: </p></td>";
	echo "<td><input name=\"fls\" type=\"text\"  id=\"fls\" maxlength=\"10\" value=\"".$_REQUEST['fls']."\"";
    echo $Fields['fls']?'readonly="readonly"':'';
    echo " />";
	echo "<small> *����� ���</small></td>  </tr>";
	
	echo "<tr><td><p class=\"in1\">���: </p></td>";
	echo "<td><input name=\"fio\" type=\"text\"  id=\"fio\" value=\"".$Fields['fio']."\" />";
	echo "<small> *��� ���������</small></td> </tr>";
	
	echo "<tr><td><p class=\"in1\">�����: </p></td>";
	echo "<td><input name=\"addr\" type=\"text\"  id=\"addr\" value=\"".$Fields['addres']."\" />";
	echo "<small> *����� ���������</small></td> </tr>";

	echo "<tr><td><p class=\"in1\">������: </p></td>";
	echo "<td><input name=\"passw\" type=\"text\" id=\"passw\" style=\"width: 100px\" maxlength=10 />";
	echo "<small> *10 �������� ����, ������ ��������� ����� � �����</small></td> </tr>";
	echo "<tr><td><p class=\"in1\">������ ��� ���: </p></td>";
	echo "<td><input name=\"passw2\" type=\"text\" id=\"passw2\" style=\"width: 100px\" maxlength=10 />";
	echo "<small> *��������� ������</td> </tr>";
	echo "<tr><td><p class=\"in1\">����������� �����: </p></td>";
	echo "<td><input name=\"email\" type=\"text\"  id=\"email\" value=\"".$Fields['email']."\" />";
	echo "<small> *��� ����� ����������� �����</small></td> </tr>";
	
	echo "</td>";
	echo "</tr></table><br>";
    $BtnValue=$Fields['fls']?'��������� ���������':'������������������';
	echo "<input align=\"right\" type=\"submit\" name=\"btn_commit\" class=\"btn\" title=\"OK\" value=\"$BtnValue\" />";
	echo "</FORM>";
};

function license()
{
    echo "<FORM NAME =\"regpage\" METHOD =\"POST\" ACTION = \"register.php\">";
    echo "<textarea name=\"body\" COLS=87 ROWS=25 readonly WRAP=\"virtual\">";
    $f = fopen($fname=realpath("./ls/ls.txt"), "rt") or die("������ �������� �����!");
    while (!feof($f)) {
        echo (fgets($f));
    }
    fclose($f);
    echo "</textarea><br>";
    echo "<input type=checkbox name = \"chkacc\" value = \"accept\"/>";
    echo " � �������� � ��������� ���������� <br>";
    echo "<input align=center type=\"submit\" class=\"btn\" name = \"cont\" title=\"���������� �����������\" value=\"����������\" />";
    echo "</FORM>";
    echo "<br>"; 
    if (isset($_POST['cont']))
    {
        echo "<p style='color:red'>��� ����������� ����������� ���������� ������� ����������.</p>";
    }
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

    $userfls = $_REQUEST['fls'];
    $userfio = $_REQUEST['fio'];
    $useraddr = $_REQUEST['addr'];
    $userpassw = $_REQUEST['passw'];
    $userpassw2 = $_REQUEST['passw2'];
    $useremail = $_REQUEST['email'];

if (isset($_REQUEST['btn_commit']))
{
	echo "<br><br>";
    if(!($useraddr&&$userfio&&$userfls))
		{echo "<p style='color:red'>������� ������������ ������, ���������� ��������� � ������� ������.</p>";}
	else{
		if(is_numeric($userfls))
		{
			$query = "SELECT fls FROM ".$db_tabl." WHERE fls='$userfls'";
			$query_result = mysql_query($query);
			$num_rows = mysql_numrows($query_result);
			if($num_rows&&$_REQUEST['btn_commit']==='������������������')
				{echo "<p style='color:red'>������������ � ����� ������� ��� ��� ����������.</p>";}
			else
			{
				if($userpassw!=$userpassw2)
					{echo "<p style='color:red'>��������� ������ �� ���������!</p>";}
				else
                if (!$userpassw&&!$userpassw2&&$_REQUEST['btn_commit']==='������������������')
                {
                    echo "<p style='color:red'>���� ������ ����������� ��� ����������!</p>";
                }
                else
				{
                    if ($_REQUEST['btn_commit']==='������������������')
                    {
                        $query = "INSERT INTO ".$db_tabl." (fls,fio,addres,passw,email,nachisl,poslopl) VALUES ('$userfls','$userfio','$useraddr','$userpassw','$useremail','0','0')";
					    $query_result = mysql_query($query);
					    if($query_result)
					    {
						    
						    echo "<p style='color:green'>�����������, �� ������� ������������������!</p><br><br>";
						    echo "<a href=\"/\">�����</a>";
						    mail($useremail, "Registration", $username."\n".$userpassw);
					    }
					    else{echo "<p style='color:red'>����������� ������!</p>";}
                    }
                    else
                    if($_REQUEST['btn_commit']==='��������� ���������')
                    {
                        $query='UPDATE '.$db_tabl.' SET ';
                        $query.='fio=\''.$_REQUEST['fio'].'\'';
                        $query.=',addres=\''.$_REQUEST['addr'].'\'';
                        if ($useremail)
                        {
                            $query.=',email=\''.$_REQUEST['email'].'\'';
                        }
                        if (strlen($_REQUEST['passw'])>0)
                        $query.=',passw=\''.$_REQUEST['passw'].'\'';
                        $query.=' where fls=\''.$_REQUEST['fls'].'\'';
                        
                        $query_result = mysql_query($query);
                        if($query_result)
                        {
                            
                            echo "<p style='color:green'>���� ��������� ������� ���������!</p><br><br>";
                            echo "<a href=\"/\">�����</a>";
                        }
                        else{echo "<p style='color:red'>����������� ������!</p>";}
                    }
				}
			}
		}
	}
}
else
{
    if (isset($_REQUEST['chkacc']))
    {
        outreg($db_tabl);
    }
    else
    {
        license();
    }
}
?>





</div>
                     </div>
               </div>
         </div>
   </body>
</html>