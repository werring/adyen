<?php

$baseDir = __DIR__.'/..';
require_once $baseDir.'/vendor/autoload.php';



$adyen = new Adyen\Adyen();

$adyen->setSharedSecret("MyHCMACode");
$adyen->setSkinCode("IUdjwkE")->setMerchantAccount("MerchantAccount");
$adyen->setMerchantReference("Order123");
$adyen->setPaymentAmount(99.99);
$adyen->setShopperEmail("user@email.com");
$adyen->setShopperReference("User123");


// Optional:
$adyen->setCurrencyCode('EUR'); // Default: EUR
$adyen->setShipBeforeDate(strtotime("+1 week"));
$adyen->setSessionValidity(strtotime("+1 day"));
/*
$adyen->setRecurringContract("RECURRING"); // Options: RECURRING, ONECLICK
$adyen->setCountryCode("NL");
$adyen->setShopperStatement();
$adyen->setOrderData();
$adyen->setShopperLocale();
$adyen->setAllowedMethods();
$adyen->setBlockedMethods();
$adyen->setOffset();
*/

try {
    $form = $adyen->getForm('myAdyenFormID');
    echo '<h1>Use this hidden form in your page and user javascript to submit the form</h1>';
    echo '<pre>'.htmlentities(str_replace('<input ', "\n<input ", $form)).'</pre>';

    $url = $adyen->getPaymentURL();
    echo '<h1>Use this PaymentURL in a &lt;a&gt; tag</h1>';
    echo '<pre>'.htmlentities($url).'</pre>';
    echo '<a href="'.$url.'">Click me to Pay!</a>';
} catch(Adyen\AdyenException $e) {
    echo '<h1>Adyen Error</h1>';
    echo '<p>'.$e->getMessage().'</p>';
}

