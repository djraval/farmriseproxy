<?php

require 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;

$type = $_GET["Type"];
$state = $_GET["SCode"];
$district = $_GET["DCode"];
$block = $_GET["BCode"];
$x = rand(5,25);
$y = rand(5,25);

header("Access-Control-Allow-Origin: *");

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.farmer.gov.in/FertilizerPesticideDealers.aspx?dealertype=".$type."&DealerStatus=A&SCode=".$state."&DCode=".$district."&BCode=".$block,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36",
    "Referer: http://www.farmer.gov.in/FertilizerPesticideDealersTotal.aspx?dealertype=F"
  ),
  CURLOPT_COOKIEFILE =>'./cookie.txt',
  CURLOPT_COOKIEJAR => './cookie.txt',
));
$response = curl_exec($curl);
//echo $response;
$response = curl_exec($curl);
curl_close($curl);

$crawler = new Crawler($response);
//$crawler = $crawler->filter("#ctl00_ContentPlaceHolder1_GridViewApproved");
$crawler = $crawler->filter("table div");
echo $crawler->html();