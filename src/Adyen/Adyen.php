<?php

namespace Adyen;

/**
* Wrapper Class for Adyen Communication
*/
class Adyen {

    protected $live;
    protected $sharedSecret;
    protected $merchantAccount;
    protected $merchantReference;
    protected $paymentAmount;
    protected $currencyCode;
    protected $shipBeforeDate;
    protected $skinCode;
    protected $sessionValidity;
    protected $shopperEmail;
    protected $shopperReference;
    protected $recurringContract;
    protected $countryCode;
    protected $shopperStatement;
    protected $merchantSig;
    protected $orderData;
    protected $shopperLocale;
	protected $allowedMethods;
	protected $blockedMethods;
	protected $offset;
	
    
    public function __construct() {
        $this->live = true;
        $this->currencyCode = 'EUR';
        $this->shipBeforeDate = date("Y-m-d", strtotime("+5 day"));
        $this->sessionValidity = date(
            DATE_ATOM,
            mktime(
                date("H") + 1, // IN HOURS
                date("i"),
                date("s"),
                date("m"),
                date("j"),
                date("Y")
            )
        );
    }
    
    private function getUrl() {
        return $this->live ? 'https://live.adyen.com/hpp/pay.shtml' : 'https://test.adyen.com/hpp/pay.shtml';
    }
    
    /* isLive */
    public function setLive($live) {
        $this->live = $live;
        return $this;
    }
    
    public function getLive() {
        return $this->live;
    }
    

    /* sharedSecret */
    public function setSharedSecret($sharedSecret) {
        $this->sharedSecret = $sharedSecret;
        return $this;
    }
    
    public function getSharedSecret() {
        return $this->sharedSecret;
    }
    
    
    /* merchantAccount */
    public function setMerchantAccount($merchantAccount) {
        $this->merchantAccount = $merchantAccount;
        return $this;
    }
    
    public function getMerchantAccount() {
        return $this->merchantAccount;
    }
    
    
    /* merchantReference */
    public function setMerchantReference($merchantReference) {
        $this->merchantReference = $merchantReference;
        return $this;
    }
    
    public function getMerchantReference() {
        return $this->merchantReference;
    }
    
    
    /* paymentAmount */
    public function setPaymentAmount($paymentAmount) {
        $this->paymentAmount = intval(round($paymentAmount * 100, 0));
        return $this;
    }
    
    public function getPaymentAmount() {
        return $this->paymentAmount;
    }
    
    
    /* currencyCode */
    public function setCurrencyCode($currencyCode) {
        $this->currencyCode = $currencyCode;
        return $this;
    }
    
    public function getCurrencyCode() {
        return $this->currencyCode;
    }
    
    
    /* shipBeforeDate */
    public function setShipBeforeDate($shipBeforeDate) {
        $this->shipBeforeDate = date("Y-m-d", $shipBeforeDate);
        return $this;
    }
    
    public function getShipBeforeDate() {
        return $this->shipBeforeDate;
    }
    
    
    /* skinCode */
    public function setSkinCode($skinCode) {
        $this->skinCode = $skinCode;
        return $this;
    }
    
    public function getSkinCode() {
        return $this->skinCode;
    }
    
    
    /* sessionValidity */
    public function setSessionValidity($sessionValidity) {
        $this->sessionValidity = date(
            DATE_ATOM,
            mktime(
                date("H") + $sessionValidity,
                date("i"),
                date("s"),
                date("m"),
                date("j"),
                date("Y")
            )
        );
        return $this;
    }
    
    public function getSessionValidity() {
        return $this->sessionValidity;
    }
    
    
    /* shopperEmail */
    public function setShopperEmail($shopperEmail) {
        $this->shopperEmail = $shopperEmail;
        return $this;
    }
    
    public function getShopperEmail() {
        return $this->shopperEmail;
    }
    
    
    /* shopperReference */
    public function setShopperReference($shopperReference) {
        $this->shopperReference = $shopperReference;
        return $this;
    }
    
    public function getShopperReference() {
        return $this->shopperReference;
    }
    
    
    /* recurringContract */
    public function setRecurringContract($recurringContract) {
        $this->recurringContract = $recurringContract;
        return $this;
    }
    
    public function getRecurringContract() {
        return $this->recurringContract;
    }
    
    
    /* countryCode */
    public function setCountryCode($countryCode) {
        $this->countryCode = $countryCode;
        return $this;
    }
    
    public function getCountryCode() {
        return $this->countryCode;
    }
    
    
    /* shopperStatement */
    public function setShopperStatement($shopperStatement) {
        $this->shopperStatement = $shopperStatement;
        return $this;
    }
    
    public function getShopperStatement() {
        return $this->shopperStatement;
    }
    
    
    /* orderData */
    public function setOrderData($orderData) {
        $this->orderData = $orderData;
        return $this;
    }
    
    public function getOrderData() {
        return $this->orderData;
    }
    
    
    /* shopperLocale */
    public function setShopperLocale($shopperLocale) {
        $this->shopperLocale = $shopperLocale;
        return $this;
    }
    
    public function getShopperLocale() {
        return $this->shopperLocale;
    }
    
    
    /* allowedMethods */
    public function setAllowedMethods($allowedMethods) {
        $this->allowedMethods = $allowedMethods;
        return $this;
    }
    
    public function getAllowedMethods() {
        return $this->allowedMethods;
    }
    
    
    /* blockedMethods */
    public function setBlockedMethods($blockedMethods) {
        $this->blockedMethods = $blockedMethods;
        return $this;
    }
    
    public function getBlockedMethods() {
        return $this->blockedMethods;
    }
    
    
    /* offset */
    public function setOffset($offset) {
        $this->offset = $offset;
        return $this;
    }
    
    public function getOffset() {
        return $this->offset;
    }
    
    
    
    
    
    public function getForm($formid='adyenform') {
        $params=$this->getHPPParams();
        
        $html='<form method="post" id="'.$formid.'" action="'.$this->getUrl().'">';
        foreach($params as $name=>$value) {
            $html.='<input type="hidden" name="'.$name.'" value="'.$value.'">';
        }
        $html.='</form>';
        return $html;
    }
    
	public function getPaymentURL() {
        $params=$this->getHPPParams();

        $url = $this->getUrl().'?';
        foreach($params as $name=>$value) {
            $url .= "&".$name."=".urlencode($value);
        }
        return $url;    
	}
	
	private function getHPPParams() {
    	$rv=array();
                
        $merchantAccount = $this->getMerchantAccount();
        $merchantReference = $this->getMerchantReference();
        $paymentAmount = $this->getPaymentAmount();
        $currencyCode = $this->getCurrencyCode();
        $shipBeforeDate = $this->getShipBeforeDate();
        $skinCode = $this->getSkinCode();
        $sessionValidity = $this->getSessionValidity();
        $shopperEmail = $this->getShopperEmail();
        $shopperReference = $this->getShopperReference();
        $recurringContract = $this->getRecurringContract();
        $countryCode = $this->getCountryCode();
        $shopperStatement = $this->getShopperStatement();
        $merchantSig = $this->getUrl();
        $orderData = $this->getOrderData();
        $shopperLocale = $this->getShopperLocale();
        $allowedMethods = $this->getAllowedMethods();
        $blockedMethods = $this->getBlockedMethods();
        $offset = $this->getOffset();

        
        if(!$merchantReference)     throw new AdyenException("No merchantReference set.");
        if(!$paymentAmount)         throw new AdyenException("No paymentAmount set.");
        if($paymentAmount<1)        throw new AdyenException("Invalid paymentAmount: zero."); 
        if(!$shipBeforeDate)        throw new AdyenException("No shipBeforeDate set.");
        if(!$skinCode)              throw new AdyenException("No skinCode set.");
        if(!$merchantAccount)       throw new AdyenException("No merchantAccount set.");
        if(!$shopperEmail)          throw new AdyenException("No shopperEmail set.");
        if(!$shopperReference)      throw new AdyenException("No shopperReference set.");
        
        $rv['url']                  = $this->getUrl();
        $rv['merchantReference']    = $merchantReference;
        $rv['paymentAmount']        = $paymentAmount;
        $rv['shipBeforeDate']       = $shipBeforeDate;
        $rv['skinCode']             = $skinCode;
        $rv['currencyCode']         = $currencyCode;
        $rv['merchantAccount']      = $merchantAccount;
        $rv['shopperEmail']         = $shopperEmail;
        $rv['shopperReference']     = $shopperReference;
        $rv['sessionValidity']      = $sessionValidity;
        $rv['recurringContract']    = $recurringContract;        
        $rv['shopperStatement']     = $shopperStatement;

        if($orderData)          $rv['orderData']              = base64_encode(gzencode($orderData));
        if($countryCode)        $rv['countryCode']          = $countryCode;
        if($shopperLocale)      $rv['shopperLocale']        = $shopperLocale;
        if($allowedMethods)     $rv['allowedMethods']       = $allowedMethods;
        if($blockedMethods)     $rv['blockedMethods']       = $blockedMethods;
        if($offset)             $rv['offset']               = $offset;
        
        $rv['merchantSig'] = $this->getMerchantSignature();
        
    	return $rv;
	}
    
    private function getMerchantSignature() {
        $sharedSecret = $this->getSharedSecret();
        if(!$sharedSecret) throw new AdyenException("No sharedSecret set.");
        
	    $hmacData = $this->getPaymentAmount()
	        . $this->getCurrencyCode()
	        . $this->getShipBeforeDate()
	        . $this->getMerchantReference()
	        . $this->getSkinCode()
	        . $this->getMerchantAccount()
	        . $this->getSessionValidity()
	        . $this->getShopperEmail()
	        . $this->getShopperReference()
	        . $this->getRecurringContract()
	        . $this->getShopperStatement()
	        . $this->getAllowedMethods()
        ;
        
        return base64_encode(hash_hmac('sha1', $hmacData, $sharedSecret, true));
    }

}

