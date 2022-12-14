<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,Accept,Access-Control-Allow-Headers');


if($_SERVER["REQUEST_METHOD"] == "POST" ){

     $data = file_get_contents('php://input');

     //Для пхп слишком большие числа, поэтому делаем через стороки)

     $random2 = strstr(strstr($data, '0.'), ',', true);
     $random3 = strstr(strstr(strstr($data, ','), '0.'), '}', true);

     $array = array(
          'random2'    => $random2,
          'random3' => $random3
     );        


     $ch = curl_init('https://week8.kodaktor.ru/render/?addr=' . $_GET['addr']);
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_HEADER, false);
     $html = curl_exec($ch);
     curl_close($ch);    

     echo $html;
}
else {
     echo 'warpion';
}
