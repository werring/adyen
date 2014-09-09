<?php

$baseDir = __DIR__.'/..';
require_once $baseDir.'/vendor/autoload.php';



$adyen = new Adyen\Adyen();

$adyen->setLive(false)
    ->setSharedSecret("MyHCMACode")
    ->setCurrencyCode($order->c['currency'])
    ->setSkinCode("IUdjwkE")
    ->setMerchantAccount("MerchantAccount")
    ->setMerchantReference("Order123")
    ->setPaymentAmount(99.99)
    ->setShopperEmail("user@email.com")
    ->setShopperReference("User123")
    ->setShopperLocale("nl")
    ->setRecurringContract(false)
    ->setAllowedMethods("ideal")

// Optional:
$adyen->setCurrencyCode('EUR'); // Default: EUR
$adyen->setShipBeforeDate(strtotime("+1 week"));
$adyen->setSessionValidity(1); // integer is hours

/*
$adyen->setCountryCode("NL");
$adyen->setShopperStatement();
$adyen->setOrderData();
$adyen->setShopperLocale();
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

