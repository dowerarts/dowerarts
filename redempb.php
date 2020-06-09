<?php
error_reporting(0);
echo "Username : ";
$username = trim(fgets(STDIN));
echo "Password : ";
$password = trim(fgets(STDIN));
echo "List Voucher : ";
$xyz = trim(fgets(STDIN));
echo "\n";
foreach (explode("\n", str_replace("\r", "", file_get_contents($xyz))) as $key => $akun) {
    $pecah = explode("|", trim($akun));
    $voucher = trim($pecah[0]);
$headers = array();
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';

$gas = curl('https://pointblank.id/login/process', 'loginFail=0&userid='.$username.'&password='.$password.'', $headers);
$name = get_between($gas[1], '<p class="myinfo"><a href="/mypage/info"><span>', '</span></a>');
if (strpos($gas[1], '<p class="myinfo"><a href="/mypage/info"><span>')) {
	echo "[1] .++ID Ditemukan : $name++.\n";
} else {
	echo "[1] .++ID Tidak Ditemukan : $username++.\n";
}

$cookie = curl('https://www.pointblank.id/', null, null);
$session = ($gas[2]['SESSION']);


$headers3 = array();
$headers3[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers3[] = 'Cookie: SESSION='.$session.'; _ga=GA1.2.37722150.1591639232; _gid=GA1.2.1301295143.1591639232';

$profile = curl('https://www.pointblank.id/mypage/profile', null, $headers3);
$mvp = get_between($profile[1], '<li><h4>JUMLAHNAY MVP</h4>', '</li>');
$exp = get_between($profile[1], '<li><h4>EXP</h4>', '</li>');
$pangkat = get_between($profile[1], '<p><img src="/images/icon_ranking/rank_', '.png');

$headers5 = array();
$headers5[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers5[] = 'Cookie: SESSION='.$session.'; _ga=GA1.2.37722150.1591639232; _gid=GA1.2.1301295143.1591639232';

$token2 = curl('https://www.pointblank.id/topup/auth', null, $headers5);
$access = get_between($token2[1], "document.location='https://topup.pointblank.id?access_token=", "';");

$token3 = curl('https://topup.pointblank.id/?access_token='.$access.'', null, null);
$billing = ($token3[2]['BillingInfo']);

$headers4 = array();
$headers4[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers4[] = 'Cookie: SESSION='.$session.'; _ga=GA1.2.37722150.1591639232; _gid=GA1.2.1301295143.1591639232; _gat_gtag_UA_129579613_1=1; BillingInfo='.$billing.'';

$toket = curl('https://topup.pointblank.id/Topup/Index', '{}', $headers4);
$veriftoken = ($toket[2]['__RequestVerificationToken']);

$headers6 = array();
$headers6[] = 'Host: topup.pointblank.id';
$headers6[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers6[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers6[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
$headers6[] = 'Accept-Encoding: gzip, deflate';
$headers6[] = 'Content-Type: application/json; charset=utf-8';
$headers6[] = '__RequestVerificationToken: SbQkut9YYjEw0LnSEuB3irUTOEKQtudYcIiN_99zcoNRo0I_gtpN-VZGznEAipejj006EVQL9L0keUregp8SLk_pIdm6-60JtEvX4KSBG-U1';
$headers6[] = 'X-Requested-With: XMLHttpRequest';
$headers6[] = 'Content-Length: 2';
$headers6[] = 'Origin: https://topup.pointblank.id';
$headers6[] = 'Connection: close';
$headers6[] = 'Referer: https://topup.pointblank.id/Topup/Index';
$headers6[] = 'Cookie: SESSION='.$session.'; _ga=GA1.2.37722150.1591639232; _gid=GA1.2.1301295143.1591639232; BillingInfo='.$billing.'; __RequestVerificationToken='.$veriftoken.'; _gat_gtag_UA_129579613_1=1';

$cashpb = curl('https://topup.pointblank.id/User/UserInfo', '{}', $headers6);

$headers7 = array();
$headers7[] = 'Host: www.pointblank.id';
$headers7[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers7[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
$headers7[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
$headers7[] = 'Accept-Encoding: gzip, deflate';
$headers7[] = 'Connection: close';
$headers7[] = 'Referer: https://www.pointblank.id/mypage/profile';
$headers7[] = 'Cookie: SESSION='.$session.'; _ga=GA1.2.37722150.1591639232; _gid=GA1.2.1301295143.1591639232; _gat_gtag_UA_129579613_1=1
Upgrade-Insecure-Requests: 1';

$data = curl('https://www.pointblank.id/mypage/info', null, $headers7);

$headers8 = array();
$headers8[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers8[] = 'Content-Type: application/json; charset=utf-8';
$headers8[] = '__RequestVerificationToken: '.$veriftoken.'';
$headers8[] = 'Cookie: SESSION='.$session.'; _ga=GA1.2.37722150.1591639232; _gid=GA1.2.1301295143.1591639232; __RequestVerificationToken='.$veriftoken.'; _gat_gtag_UA_129579613_1=1; BillingInfo='.$billing.'';

$redeem = curl('https://topup.pointblank.id/Coupon/Register', '{"couponno":"'.$voucher.'"}', $headers8);
if (strpos($redeem[1], 'Kupon sudah dipakai. Tidak dapat digunakan.')) {
	echo "Kupon sudah dipakai. Tidak dapat digunakan.";
} if (strpos($redeem[1], 'Nomor kupon yang dimasukkan salah.')) {
	echo "Nomor kupon yang dimasukkan salah.";
} if (strpos($redeem[1], '"ErrMsg":""')) {
	echo "Success Redeem";
}
}
function curl($url,$post,$headers)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	if ($headers !== null) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	if ($post !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$result = curl_exec($ch);
	$header = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
	$body = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
	$cookies = array()
;	foreach($matches[1] as $item) {
	  parse_str($item, $cookie);
	  $cookies = array_merge($cookies, $cookie);
	}
	return array (
	$header,
	$body,
	$cookies
	);
}
function get_between($string, $start, $end) 
    {
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }

function nama()
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	// $rand = json_decode($rnd_get, true);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
	return $name[2][mt_rand(0, 14) ];
	}
