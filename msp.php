<?php

    require 'vendor/autoload.php';;
    use Symfony\Component\DomCrawler\Crawler;
    use Symfony\Component\CssSelector\CssSelectorConverter;

    header("Access-Control-Allow-Origin: *");

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://www.farmer.gov.in/mspstatements.aspx",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Cache-Control: no-cache"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        //echo $response;
        $crawler = new Crawler($response);
        $crawler = $crawler->filter('#middlepnlMain > div:nth-of-type(2)');
        echo $crawler->html();
    }