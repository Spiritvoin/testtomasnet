<?php

$html=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/lps/html/goodkvitanciya.html');
//preg_match_all('/@\w+/',$html,$arr);

//foreach ($arr as $name=>$value)
//{
//	$html=str_replace($value,'1234',$html);
//}


include 'db_settings.php';
//date_default_timezone_set('Europe/Moscow');

$query = "SELECT * FROM ".$db_tabl." WHERE ".$db_tabl.".fls='".$_GET['fls']."'";
$query_result = mysql_query($query);
$data_plat = mysql_result($query_result, 0, "nachisl_data");
$data_plat = mktime(0,0,0,substr($data_plat,3,2),substr($data_plat,0,2),substr($data_plat,6,4));

$first_day = strtotime(date("m", $data_plat)."/1/".date("Y", $data_plat));
$fifteen_day = strtotime(date("m", $data_plat)."/15/".date("Y", $data_plat));
$fifteen_day = strtotime("-1 month",$fifteen_day);

switch(date("m", $data_plat))
{
   case 1:    $mon2="Январь";    break;
   case 2:    $mon2="Февраль";    break;
   case 3:    $mon2="Март";    break;
   case 4:    $mon2="Апрель";    break;
   case 5:    $mon2="Май";    break;
   case 6:    $mon2="Июнь";    break;
   case 7:    $mon2="Июль";    break;
   case 8:    $mon2="Август";    break;
   case 9:    $mon2="Сентябрь";    break;
   case 10:   $mon2="Октябрь";    break;
   case 11:   $mon2="Ноябрь";    break;
   case 12:   $mon2="Декабрь";    break;
}

$mon2 = $mon2." ".date("Y", $data_plat);

$Arr=array(
           '@FIOPlatelschik'    => mysql_result($query_result, 0, "fio"),
           '@AdressPlatelschik' => mysql_result($query_result, 0, "addres"),
           '@FLSPlatelchik'     => mysql_result($query_result, 0, "fls"),
           '@Kva'               => mysql_result($query_result, 0, "kvart"),
           '@Mon'               => date("m", $data_plat),
           '@Year'              => date("Y", $data_plat),
           '@ItogoBefore15Pay'  => mysql_result($query_result, 0, "itog_b"),
           '@ItogoAfter15Pay'   => mysql_result($query_result, 0, "itog_a"),
           '@PrevMonth'         => Date("d.m.Y",$first_day),
           '@PrevDolg'          => mysql_result($query_result, 0, "dolg_nach"),
           '@TypeSobstvennosti' => mysql_result($query_result, 0, "vid_sobstv"),
           '@DateCvit'          => date("d.m.Y"),
           '@SqO'               => mysql_result($query_result, 0, "com_sq"),
           '@Sq_Ot'             => mysql_result($query_result, 0, "otp_sq"),
           '@SqJ'               => mysql_result($query_result, 0, "liv_sq"),
           '@Living'            => mysql_result($query_result, 0, "kol_pr"),
           '@PenyCost'          => mysql_result($query_result, 0, "peny"),
           '@Period'            => $mon2,
           '@TypePay'           => mysql_result($query_result, 0, "vid_plat"),
           '@Volume'            => mysql_result($query_result, 0, "volumes"),
           '@TarifB15'          => mysql_result($query_result, 0, "tarifs_b"),
           '@Nac100B15'         => mysql_result($query_result, 0, "nachisles100_b"),
           '@LgB15'             => mysql_result($query_result, 0, "lgots_b"),
           '@NacB15'            => mysql_result($query_result, 0, "nachisles_b"),
           '@TarifA15'          => mysql_result($query_result, 0, "tarifs_a"),
           '@Nac100A15'         => mysql_result($query_result, 0, "nachisles100_a"),
           '@LgA15'             => mysql_result($query_result, 0, "lgots_a"),
           '@NachA15'           => mysql_result($query_result, 0, "nachisles_a"),
           '@INac100B15'        => mysql_result($query_result, 0, "inachisles100_b"),
           '@ILgB15'            => mysql_result($query_result, 0, "ilgots_b"),
           '@INacB15'           => mysql_result($query_result, 0, "inachisles_b"),
           '@INac100A15'        => mysql_result($query_result, 0, "inachisles100_a"),
           '@ILgA15'            => mysql_result($query_result, 0, "ilgots_a"),
           '@INacA15'           => mysql_result($query_result, 0, "inachisles_a"),
           '@15PrevMonth'       => date("d.m.Y", $fifteen_day),
		   '@PolychatelPlateja' => mysql_result($query_result, 0, "pol_plat")
           );
//print_r($Arr);
foreach ($Arr as $name=>$value)
{
	$html=str_replace($name,$value,$html);
}

print $html;

echo "<FORM NAME =\"ret\" METHOD =\"POST\" ACTION = \"inner.php\">";
echo "<input type=button value=\"Печать\" onClick=\"window.print();\"> ";
echo "<input align=right type=\"submit\" class=\"btn\" title=\"OK\" value=\"Назад\" />";
echo "</FORM>";

?>