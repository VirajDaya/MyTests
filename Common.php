<?php
$cstrong = true;
// for ($i = -1; $i <= 16; $i++) {
// 	$bytes = openssl_random_pseudo_bytes($i, $cstrong);
// 	$hex   = bin2hex($bytes);

// 	echo "Lengths: Bytes: $i and Hex: " . strlen($hex) . "<BR/>" . PHP_EOL;
// 	var_dump($hex);
// 	var_dump($cstrong);
// 	echo "<BR/>" . PHP_EOL;
// }

// echo "Verification Code " . (generateVerificationCode()). "<br />" . PHP_EOL;
// echo "Verification Code " . (generateVerificationCodeSSL()). "<br />" . PHP_EOL;
// echo "Verification Code " . (generateVerificationCodeSSL2()). "<br />" . PHP_EOL;
// $loops = 100;
// $start = microtime(true);
// for ($i = 1 ; $i <= $loops ; $i ++ ) {
// 	$token = getToken(32, $i);
// // 	echo "Verification Code $i : \t" . ($token). " - " . strlen($token) . "<br />" . PHP_EOL;
// }
// $end = microtime(true);
// echo " Time for $loops " . ($end - $start) . " Secs" . "<br />" . PHP_EOL;

require_once '../propertyguru.com.sg/framework/core/SecurityManager.php';
// echo "Verification Code " . (SecurityManager::generateCodeSecure()). "<br />" . PHP_EOL;

$loops = 100;
$start = microtime(true);
for ($i = 1 ; $i <= $loops ; $i ++ ) {
	$token = SecurityManager::generateCodeSecure();
// 	echo "Verification Code $i : \t" . ($token). " - " . strlen($token) . "<br />" . PHP_EOL;
}
$end = microtime(true);
echo " Time for $loops - openSSL " . ($end - $start) . " Secs" . "<br />" . PHP_EOL;

require_once '../propertyguru.com.sg/modules/foundation/user/services/locale/SG/UserService.php';
// echo "Verification Code " . (UserService::generateVerificationCode()). "<br />" . PHP_EOL;


$start = microtime(true);
for ($i = 1 ; $i <= $loops ; $i ++ ) {
	$token = UserService::generateVerificationCode();
		echo "Verification Code $i : \t" . ($token). " - " . strlen($token) . "<br />" . PHP_EOL;
}
$end = microtime(true);
echo " Time for $loops " . ($end - $start) . " Secs" . "<br />" . PHP_EOL;

//-----------

function generateVerificationCode($length=32) {
	/* list all possible characters, similar looking characters and vowels have been removed */
	$possible = '23456789abcdfghjkmnpqrstvwxyzABCDEFGHJKMNPQRSTVWXYZ';
	$code = '';
	$i = 0;
	while ($i < $length) {
		$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
		$i++;
	}
	return $code;
}


function generateVerificationCodeSSL($length=32) {
	/* list all possible characters, similar looking characters and vowels have been removed */
	$possible = '23456789abcdfghjkmnpqrstvwxyzABCDEFGHJKMNPQRSTVWXYZ';
	$code = '';
	$i = 0;
	while ($i < $length) {
		$bytes = openssl_random_pseudo_bytes(100,$cstrong);
		$hex   = (bin2hex($bytes));
// 		echo $hex . "<br />" . PHP_EOL;
		$code .= substr($hex, strpos($hex, $possible) , 1);
		$i++;
	}
	return $code;
}
function generateVerificationCodeSSL2($length=32) {
	/* list all possible characters, similar looking characters and vowels have been removed */
	$possible = '23456789abcdfghjkmnpqrstvwxyzABCDEFGHJKMNPQRSTVWXYZ';
	$code = '';
	$i = 0;
	while ($i < $length) {
		$bytes = openssl_random_pseudo_bytes(100,$cstrong);
		$hex   = str_ireplace(".","",substr(hexdec(bin2hex($bytes)),0,3));
// 		echo var_export($hex,true) . "<br />" . PHP_EOL;
		$code .= substr($possible, $hex, 1);
		$i++;
	}
	return $code;
}

function crypto_rand_secure($min, $max, $prev) {
	$range = $max - $min;
// 	echo $max . " - " . $min . " - " . $range ;
	if ($range < 0) return $min; // not so random...
	$log = log($range, 2);
	$bytes = (int) ($log / 8) + 1; // length in bytes
	$bits = (int) $log + 1; // length in bits
	$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
// 	echo " - " . $log . " - " . $bytes . " - " . $bits . " - " . $filter . " <br> " . PHP_EOL;  
// 	$rnd = $range; 
	$return = $min;
	do {
		$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes,$cstrong)));
		$rnd = $rnd & $filter; // discard irrelevant bits
		$return = $min + $rnd;
	} while ($rnd >= $range && $cstrong);
// 	echo " - " . $log . " - " . $bytes . " - " . $bits . " - " . $filter . " - " . $prev . " - " . $return . " <br> " . PHP_EOL;
// 	echo " - " . var_export($cstrong, true) . " <br> " . PHP_EOL;
	return $return;
}

function getToken($length=32,$round=0){
	$token = "";
	$codeAlphabet = "23456789abcdfghjkmnpqrstvwxyzABCDEFGHJKMNPQRSTVWXYZ";
	$codeAlphabet = "23456789bcdfghjkmnpqrtsvwxyzBCDFGHJKMNPQRTSVWXYZ";
// 	$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
// 	$codeAlphabet.= "0123456789";
	$index = $prevIndex = -1;
	$skips = 0;
// 	for($i=0; $i<$length; $i++) {
	while (strlen($token) < $length) {
		$index = crypto_rand_secure(0,strlen($codeAlphabet),$index);
		if ($index != $prevIndex) {
			$token .= $codeAlphabet[$index];
			$prevIndex = $index;
		}
		else { 
// 			echo "Skipping $round : $token <br /> " . PHP_EOL;
			$skips++;
		}
	}
// 	var_dump($codeAlphabet);
// 	if ($skips > 3 ) echo "Skipps for $round : $skips <br /> " . PHP_EOL;
	return $token;
}

/* $remote_xml = "https://stackoverflow.com/opensearch.xml";

$dom = new DOMDocument();

if ($dom->load($remote_xml) !== FALSE)
	echo "loaded remote xml!\n";
else
	echo "failed to load remote xml!\n";

libxml_disable_entity_loader(false);
if ($dom->load($remote_xml) !== FALSE)
	echo "loaded remote xml after libxml_disable_entity_loader(true)!\n";
else
	echo "failed to remote xml after libxml_disable_entity_loader(true)!\n";


$xml = <<<XML
<?xml version="1.0"?>
<!DOCTYPE root [
<!ENTITY c PUBLIC "bar" "/etc/passwd">
]>
<root>
    <test>Test</test>
    <sub>&c;</sub>
</root>
XML;

libxml_disable_entity_loader(true);
$dom = new DOMDocument();
$dom->loadXML($xml);

// Prints Test.
print $dom->textContent;



$xml = <<<XML
<?xml version="1.0"?>
<!DOCTYPE root [
<!ENTITY c PUBLIC "bar" "/etc/passwd">
]>
<root>
    <test>Test</test>
    <sub>&c;</sub>
</root>
XML;

$dom = new DOMDocument();
$dom->loadXML($xml, LIBXML_NOENT | LIBXML_DTDLOAD);

// Prints Test.
print $dom->textContent;
 */

// $date = strtotime('-1M', strtotime('20-08-2014') - (30 * 24 * 60 * 60));
// echo date("D M j G:i:s T Y",$date) . "<br>";

// $date = getdate(strtotime('20-08-2014'));
// echo print_r($date,true)  . "<br>";
// $dateobj = new DateTime('20-11-2014');
// echo print_r($dateobj ,true)  . "<br>";
// $dateobj->add(DateInterval::createFromDateString('1 months'));
// echo print_r($dateobj ,true)  . "<br>";



// $last_day_april_2010 = date('m-t-Y', $dateobj->getTimestamp());
// echo $last_day_april_2010 . "<br>";

// $endObj =  new DateTime('2014-09-30');
// echo print_r($endObj,true)  . "<br>";
// echo print_r(DateInterval::createFromDateString('1 months'),true)  . "<br>";

// // $endObj->sub(DateInterval::createFromDateString('1 months'));
// $endObj->modify( 'first day of last month' );
// echo print_r($endObj,true)  . "<br>";
// $stTmpStamp = $endObj->getTimestamp();
// $first_day_start_month = date('Y-m-01', $stTmpStamp );
// $startDate = strtotime($first_day_start_month);

// $endObj->add(DateInterval::createFromDateString('3 months'));
// $endTmpStamp = $endObj->getTimestamp();
// echo print_r($endTmpStamp,true) . " - <br>";
// $last_day_end_month   = date('Y-m-t', $endObj->getTimestamp() );
// $endDate = strtotime($last_day_end_month);
// // echo print_r($endDateObj ,true)  . "<br>";


// // echo print_r($startDateObj ,true)  . "<br>";

// echo $first_day_start_month . "<br>";
// echo $last_day_end_month . "<br>";
// echo $startDate . "<br>";
// echo print_r($endDate,true) . " - <br>";







