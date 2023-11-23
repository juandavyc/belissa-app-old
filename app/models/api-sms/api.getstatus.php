<?php
$url = "https://api.netelip.com/v1/sms/status.php";
$post = array(
   "token"  => "0d5a98763262819147c4651e9a8e66a5693f69c8bc9565e251e50ae785aa6be6",
   "id-sms" => $_GET['id'],
//    "id-sms" => "1668096243.9832",
//    "id-sms" => "1668095773.3444",
//    "id-sms" => "1668095774.5843",
);

$request = curl_init($url);
curl_setopt($request, CURLOPT_POST, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $post);
curl_setopt($request, CURLOPT_TIMEOUT, 180);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($request);
$response_code = curl_getinfo($request, CURLINFO_HTTP_CODE);
if ($response !== false) {
   echo $response;
} 

curl_close($request);
?>
