<?php

    require 'vendor/autoload.php';;
    use Symfony\Component\DomCrawler\Crawler;
    use Symfony\Component\CssSelector\CssSelectorConverter;

    header("Access-Control-Allow-Origin: *");

    //$state = $_GET["SCode"];
    //$dist = $_GET["DCode"];
    
    $state = "04";
    $dist = "0408";

    $host = "http://www.farmer.gov.in/";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://www.farmer.gov.in",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache"
        ),
        CURLOPT_COOKIEFILE =>'./cookie.txt',
        CURLOPT_COOKIEJAR => './cookie.txt',
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    //echo $response;
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://www.farmer.gov.in/State.aspx?SCode=".$state,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "Referer: http://www.farmer.gov.in"
        ),
        CURLOPT_COOKIEFILE =>'./cookie.txt',
        CURLOPT_COOKIEJAR => './cookie.txt'
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://www.farmer.gov.in/District.aspx?SCode=".$state."&DCode=".$dist,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "Referer: http://www.farmer.gov.in/State.aspx?SCode=".$state
        ),
        CURLOPT_COOKIEFILE =>'./cookie.txt',
        CURLOPT_COOKIEJAR => './cookie.txt'
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    echo $response;
