<?php

require 'function.php';
while(true) {
    $nama = explode(" ", nama());
    $nama1 = $nama[0];
    $nama2 = $nama[1];
    $hasil_1= acak(2);
    $email = ''.$nama1.''.$hasil_1.'%40cerbidurch.cf';
    $datacurl = ''.$nama1.''.$hasil_1.'';

    $headers = [
        'Host: www.googleapis.com',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0',
        'Accept: */*',
        'Accept-Language: en-US,en;q=0.5',
        'Content-Type: application/json',
        'X-Client-Version: Firefox/JsCore/7.20.0/FirebaseCore-web',
        'Origin: https://grivy.app',
        'Connection: close',
    ];

    $data = '{"requestType":"EMAIL_SIGNIN","email":"'.$nama1.''.$nama2.'@aprilmovo.com","continueUrl":"https://grivy.app/login-email/coke-ayo-idm","canHandleCodeInApp":true}';
    $regis = curl('https://www.googleapis.com/identitytoolkit/v3/relyingparty/getOobConfirmationCode?key=AIzaSyC2Jncgy1smi8CV91PG3sUZBDAo5raozYc', $data, $headers);
    $email = get_between($regis[1], 'email": "', '"');
    if (strpos($regis[1], ''.$email.'')) {
        echo "[1] Berhasil Register Dengan $email\n";
    } else {
        echo "[1] Gagal Register\n";
    }

    sleep(5);
    $headers = array();
    $headers[] = 'Host: generator.email';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
    $headers[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
    $headers[] = 'Connection: close';
    $headers[] = 'Cookie: surl=aprilmovo.com%2F'.$nama1.''.$nama2.'; _ga=GA1.2.1171942595.1592936484; _gid=GA1.2.1882707753.1592936484; __gads=ID=123d57699689eca8:T=1592936486:S=ALNI_MZ5U15we3U99-D5aAEncHBqVAhQUw; _gat=1';
    $headers[] = 'Upgrade-Insecure-Requests: 1';

    $verifmail = curl('https://generator.email/inbox3/', null, $headers);
    $url = get_between($verifmail[1], '<p><a href="', '"');
    $hasil = urldecode($url);
    $apikey = get_between($verifmail[1], 'action?apiKey=', '&');
    $oobcode = get_between($verifmail[1], 'oobCode=', '&');

    echo "[2] Berhasil Get Apikey $apikey\n";
    echo "[3] Berhasil Get OobCode $oobcode\n";

    $headers = [
        'Host: www.googleapis.com',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0',
        'Accept: */*',
        'Accept-Language: en-US,en;q=0.5',
        'Content-Type: application/json',
        'X-Client-Version: Firefox/JsCore/7.20.0/FirebaseCore-web',
        'Origin: https://grivy.app',
        'Connection: close',
        'Referer: https://grivy.app/login-email/coke-ayo-idm?apiKey='.$apikey.'&oobCode='.$oobcode.'&mode=signIn&lang=id',
    ];

    $data = '{"email":"'.$nama1.''.$nama2.'@aprilmovo.com","oobCode":"'.$oobcode.'","returnSecureToken":true}';
    $redirect = curl('https://www.googleapis.com/identitytoolkit/v3/relyingparty/emailLinkSignin?key='.$apikey.'', $data, $headers);
    $token = get_between($redirect[1], 'idToken": "', '"');
    
    $headers = [
        'Host: us-central1-grivy-barcode.cloudfunctions.net',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0',
        'Accept: */*',
        'Accept-Language: en-US,en;q=0.5',
        'Referer: https://grivy.app/login-email/coke-ayo-idm?apiKey='.$apikey.'&oobCode='.$oobcode.'&mode=signIn&lang=id',
        'authorization: Bearer '.$token.'',
        'content-type: application/json',
        'Origin: https://grivy.app',
        'Connection: close',
    ];

    $data = '{"data":{"publicCode":"coke-ayo-idm"}}';
    $getcode = curl('https://us-central1-grivy-barcode.cloudfunctions.net/grabCoupon', $data, $headers);
    $code = get_between($getcode[1], 'code":"', '"');
    echo "[4] Code Telah Di Ambil Dengan Code : $code Expired 7 Days\n\n";
    fwrite(fopen('code.txt', 'a'), "$code\n");
}
