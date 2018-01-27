<?php

require 'vendor/autoload.php';;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;

$state = "04";
$district = "1030";
$block = "3810";

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.farmer.gov.in/FertilizerPesticideDealers.aspx?dealertype=P&SCode=".$state."&DCode=".$district."&BCode=".$block,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_COOKIEFILE =>'./cookie.txt',
  CURLOPT_COOKIEJAR => './cookie.txt',
));
$response = curl_exec($curl);

$crawler = new Crawler($response);
$crawler = $crawler->filter("#ctl00_ContentPlaceHolder1_DropDownListState");

echo $crawler->html();

