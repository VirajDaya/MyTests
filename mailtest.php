<?php
//mail("test@local.mytests.com", "test email", "test email","From: from@local.mytests.com");
// echo phpinfo();

echo strtotime('-1 day') . "<br />" . PHP_EOL;
echo date('Y-m-d', strtotime('60 day')) . PHP_EOL;

$listEndDate = '2014-08-24 23:59:59';
$endDate = date('Y-m-d', strtotime($listEndDate));
$endDate2 = date('Y-m-d', strtotime('60 day'));


if ($endDate  < $endDate2 )
{
	echo "End Date " . $endDate  ;
}
else 
{
	echo $endDate2;
}

