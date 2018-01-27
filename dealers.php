<?php

require 'vendor/autoload.php';;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;

$state = $_GET["SCode"];
$district = $_GET["DCode"];
$block = $_GET["BCode"];
$x = rand(5,25);
$y = rand(5,25);

header("Access-Control-Allow-Origin: *");

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.farmer.gov.in/FertilizerPesticideDealers.aspx?dealertype=P&SCode=".$state."&DCode=".$district."&BCode=".$block,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36"
  ),
  CURLOPT_COOKIEFILE =>'./cookie.txt',
  CURLOPT_COOKIEJAR => './cookie.txt',
));
$response = curl_exec($curl);


preg_match_all("/id=\"__VIEWSTATE\" value=\"(.*?)\"/", $response, $arr_viewstate);
$viewstate = urlencode($arr_viewstate[1][0]);
$postBody = "__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE="
          .$viewstate
          ."&__VIEWSTATEENCRYPTED="
          ."&".urlencode('ctl00$ContentPlaceHolder1$DropDownListDealerStatus')."="."A"
          ."&".urlencode('ctl00$ContentPlaceHolder1$DropDownListState')."=".$state
          ."&".urlencode('ctl00$ContentPlaceHolder1$DropDownListDistrict')."=".$district
          ."&".urlencode('ctl00$ContentPlaceHolder1$DropDownListBlock')."=".$block
          ."&".urlencode('ctl00$ContentPlaceHolder1$btnExcels.x')."=".$x
          ."&".urlencode('ctl00$ContentPlaceHolder1$btnExcels.y')."=".$y;

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.farmer.gov.in/FertilizerPesticideDealers.aspx?dealertype=P&SCode=".$state."&DCode=".$district."&BCode=".$block,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36"
  ),
  CURLOPT_POSTFIELDS => $postBody,
  CURLOPT_COOKIEFILE =>'./cookie.txt',
  CURLOPT_COOKIEJAR => './cookie.txt',
));

$response = curl_exec($curl);
curl_close($curl);
$crawler = new Crawler($response);
$crawler = $crawler->filter("div");

/* $crawler->filter('table tbody tr td')->each(function (Crawler $crawler,$i) {
  foreach ($crawler as $node) {
    if($i %)
      $node->parentNode->removeChild($node);
  }
}); */

echo $crawler->html();
//echo $response;
function parseXLS($data){
    $row_count=0;
    $json = array();
    $crawler = new Crawler($data);
    $crawler = $crawler->filter("tr");
    $len = $crawler->count();
    $i = 0;
    foreach($crawler as $node){
      if($i == 0 || $i == $len-1)
      {
        continue;
      }
      //$row = $node->children();
     // $id = $row->eq(1)->children();
     $i++;
    }

    echo $i;
}

//parseXLS($response);
