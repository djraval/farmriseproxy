<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.farmrise.com/v1/users/fb3c7b8f-0305-4f9a-91cd-7dd0deeaca89/location/change",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"latitude\":\"".$_GET["lat"]."\",\"userId\":\"fb3c7b8f-0305-4f9a-91cd-7dd0deeaca89\",\"longitude\":\"".$_GET["long"]."\"}",
  CURLOPT_HTTPHEADER => array(
    "accesstoken: 17018fd8-fd74-40f3-84c9-53e0d85527e0",
    "appversion: 1.3.0",
    "authorization: Basic ZGV2ZWxvcGVyOm1vYmlsZWFwcEBGUg==",
    "cache-control: no-cache",
    "content-type: application/json",
    "deviceid: 9999999999999999",
    "phonenumber: 8469696281",
    "postman-token: d09e720d-495a-e113-c21d-c5fa15dcd71a",
    "userid: fb3c7b8f-0305-4f9a-91cd-7dd0deeaca89"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}