<?php

namespace Adyen;

/**
* Wrapper Class for Adyen Communication
*/
class Adyen {

    protected $live;
    protected $brand;
    protected $encoding;
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
    protected $openInvoiceLines;
    protected $recurringContract;
    protected $countryCode;
    protected $shopperStatement;
    protected $merchantSig;
    protected $orderData;
    protected $shopperLocale;
	protected $allowedMethods;
	protected $blockedMethods;
	protected $offset;
	protected $shopper_interaction;
	protected $billingAddressType;
	protected $deliveryAddressType;
	protected $shopperType;

	protected $WSUser;
	protected $WSUserPassword;

    public function __construct() {
        $this->live = true;
        $this->type = "standard";
        $this->encoding = "sha1";
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

    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function getBrans()
    {
        return $this->brand;
    }

    public function setType($type)
    {
        if ($type == "moto") {
            $this->type = $type;
        } else {
            $this->type = "standard";
        }
        return $this;
    }

    private function getUrl()
    {
        if ($this->type == "moto") {
            return $this->live ? 'https://callcenter-live.adyen.com/callcenter/action/callcenter.shtml' : 'https://callcenter-test.adyen.com/callcenter/action/callcenter.shtml';
        } else {
            return $this->live ? 'https://live.adyen.com/hpp/pay.shtml' : 'https://test.adyen.com/hpp/pay.shtml';
        }
    }

    private function getWSDLUrl()
    {
        return $this->live ? 'https://pal-live.adyen.com/pal/adapter/httppost' : 'https://pal-test.adyen.com/pal/adapter/httppost';
    }

    /* isLive */
    public function setLive($live) {
        $this->live = $live;
        return $this;
    }

    public function getLive() {
        return $this->live;
    }

    public function setEncoding($encoding) {
        $this->encoding = $encoding;
        return $this;
    }

    public function setWSUserAuthentication($user, $password) {
        $this->WSUser = $user;
        $this->WSUserPassword = $password;
        return $this;
    }

    public function getWSUser() {
        return $this->WSUser;
    }

    public function getWSUserPassword() {
        return $this->WSUserPassword;
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

    /* shopperReference */
    public function setOpenInvoiceLines($openInvoiceLines) {
        $this->openInvoiceLines = $openInvoiceLines;
        return $this;
    }

    public function getOpenInvoiceLines() {
        return $this->openInvoiceLines;
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

    /* offset */
    public function setShopperInteraction($value) {
        $this->shopper_interaction = $value;
        return $this;
    }

    public function getShopperInteraction() {
        return $this->shopper_interaction;
    }

    /* billingAddressType */
    public function setBillingAddressType($value) {
	    $this->billingAddressType = $value;
	    return $this;
    }

	public function getBillingAddressType() {
	    return $this->billingAddressType;
    }

    /* deliveryAddressType */
    public function setDeliveryAddressType($value) {
	    $this->deliveryAddressType = $value;
	    return $this;
    }

	public function getDeliveryAddressType() {
	    return $this->deliveryAddressType;
    }

    /* shopperType */
    public function setShopperType($value) {
	    $this->shopperType = $value;
	    return $this;
    }

	public function getShopperType() {
	    return $this->shopperType;
    }

    public function getForm($formid = 'adyenform') {
        if ($this->encoding == "sha256") {
            $params=$this->getSha256HPPParams();
        } else {
            $params=$this->getHPPParams();
        }
        $formUrl = $this->getUrl();

        $html='<form method="post" id="'.$formid.'" action="' . $formUrl . '">';
        foreach($params as $name=>$value) {
            $html.='<input type="hidden" name="'.$name.'" value="'.$value.'">';
        }
        $html.='</form>';
        return $html;
    }

	public function getPaymentURL()
	{
        if ($this->encoding == "sha256") {
            $params=$this->getSha256HPPParams();
        } else {
            $params=$this->getHPPParams();
        }

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
        $shopperInteraction = $this->getShopperInteraction();


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
        if($shopperInteraction) $rv['shopperInteraction']   = $shopperInteraction;

        $rv['merchantSig'] = $this->getMerchantSignature();
    	return $rv;
	}

    public function getSha256HPPParams()
    {
    	global $TEMPLATE, $ARGS, $CONFIG, $DB;
        $hmacKey = $this->getSharedSecret();

        $requiredParams = array(
            "merchantAccount" => $this->getMerchantAccount(),
            "merchantReference" => $this->getMerchantReference(),
            "currencyCode" => $this->getCurrencyCode(),
            "paymentAmount" => $this->getPaymentAmount(),
            "sessionValidity" => $this->getSessionValidity(),
            "shipBeforeDate" => $this->getShipBeforeDate(),
            "shopperLocale" => $this->getShopperLocale(),
            "skinCode" => $this->getSkinCode()
        );
        foreach ($requiredParams as $key => $value) {
            if ($key == "paymentAmount" && $value < 1) {
                throw new AdyenException("Invalid paymentAmount: zero.");
            } elseif (!$value) {
                throw new AdyenException("No {$key} set.");
            }
        }

        // If calculation goes wrong...check these params first ^DH
        $optionalParams = array(
            "shopperEmail" => $this->getShopperEmail(),
            "shopperReference" => $this->getShopperReference(),
            "recurringContract" => $this->getRecurringContract(),
            "countryCode" => $this->getCountryCode(),
            "shopperStatement" => $this->getShopperStatement(),
            "orderData" => $this->getOrderData(),
            "allowedMethods" => $this->getAllowedMethods(),
            "blockedMethods" => $this->getBlockedMethods(),
            "offset" => $this->getOffset(),
            "shopperInteraction" => $this->getShopperInteraction()
        );

    	$params = $requiredParams;
        foreach ($optionalParams as $key => $value) {
            if ($key == "orderData" && $value) {
                $params[$key] = base64_encode(gzencode($value));
            } elseif ($value) {
                $params[$key] = $value;
            }
        }

        // The character escape function
        $escapeval = function($val) {
         return str_replace(':','\\:',str_replace('\\','\\\\',$val));
        };

        // Sort the array by key using SORT_STRING order
        ksort($params, SORT_STRING);

        // Generate the signing data string
        $signData = implode(":",array_map($escapeval,array_merge(array_keys($params), array_values($params))));

        // base64-encode the binary result of the HMAC computation
        $merchantSig = base64_encode(hash_hmac('sha256',$signData,pack("H*" , $hmacKey),true));
        $params["merchantSig"] = $merchantSig;

        return $params;
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
	        . $this->getBillingAddressType()
	        . $this->getDeliveryAddressType()
	        . $this->getShopperType()
        ;

        return base64_encode(hash_hmac('sha1', $hmacData, $sharedSecret, true));
    }


    // ! Recurring Functions
    private function sendRecurringHTTPPost($request = array())
    {
        $WSUserAuthentication = $this->getWSUser() . ":" . $this->getWSUserPassword();
        $WSDLUrl = $this->getWSDLUrl();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $WSDLUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC  );
        curl_setopt($ch, CURLOPT_USERPWD,$WSUserAuthentication);
        curl_setopt($ch, CURLOPT_POST,count($request));
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        if ($result === false) {
             $response = "Error: " . curl_error($ch);
        } else {
        	parse_str($result, $result);
            $response = $result;
        }
        curl_close($ch);

        return $response;
    }


    public function requestRecurringContract($contractRequest = "ONECLICK,RECURRING")
    {
        /**
         * Request recurring contract details using HTTP Post
         *
         * Once a shopper has stored RECURRING details with Adyen you are able to process
         * a RECURRING payment. This file shows you how to retrieve the RECURRING contract(s)
         * for a shopper using HTTP Post.
         *
         * Please note: using our API requires a web service user. Set up your Webservice
         * user: Adyen Test CA >> Settings >> Users >> ws@Company. >> Generate Password >> Submit
         *
         * @link	5.Recurring/httppost/request-recurring-contract.php
         * @author	Created by Adyen - Payments Made Easy
         */
        /**
         * The request should contain the following variables:
         * - action: Specifies which action on the API is required
         * - merchantAccount: The merchant account the payment was processed with.
         * - shopperReference: The reference to the shopper. This shopperReference must be the same as the
         *   shopperReference used in the initial payment.
         * - recurring->contract: This should be the same value as recurringContract in the payment where the recurring
         *   contract was created. However if ONECLICK,RECURRING was specified initially
         *   then this field can be either ONECLICK or RECURRING.
         */
         $request = array(
            "action" => "Recurring.listRecurringDetails",
            "recurringDetailsRequest.merchantAccount" => $this->getMerchantAccount(),
            "recurringDetailsRequest.shopperReference" => $this->getShopperReference(),
            "recurringDetailsRequest.recurring.contract" => $contractRequest // i.e.: "ONECLICK","RECURRING" or "ONECLICK,RECURRING"
         );

        /**
         * The response will be a result with a list of zero or more details at least containing the following:
         * - recurringDetailReference: The reference the details are stored under.
         * - variant: The payment method (e.g. mc, visa, elv, ideal, paypal)
         * - creationDate: The date when the recurring details were created.
         */
         return $this->sendRecurringHTTPPost($request);
    }


    public function submitRecurringPayment($recurringDetailReference = null)
    {
        /**
         * Submit Recurring Payment using HTTP Post
         *
         * You can submit a recurring payment using a specific recurringDetails record or by using the last created
         * recurringDetails record. The request for the recurring payment is done using a paymentRequest.
         * This file shows how a recurring payment can be submitted using our HTTP Post API.
         *
         * Please note: using our API requires a web service user. Set up your Webservice
         * user: Adyen Test CA >> Settings >> Users >> ws@Company. >> Generate Password >> Submit
         *
         * @link	5.Recurring/httppost/submit-recurring-payment.php
         * @author	Created by Adyen - Payments Made Easy
         */

        /**
          * A recurring payment can be submitted by sending a PaymentRequest
          * to the authorise action, the request should contain the following
          * variables:
          * - action: Specifies which action on the API is required
          * - selectedRecurringDetailReference: The recurringDetailReference you want to use for this payment.
          *   The value LATEST can be used to select the most recently used recurring detail. See request-recurring-contract.php
          *   on how to retrieve contract details for a shopper.
          * - recurring: This should be RECURRING.
          * - merchantAccount: The merchant account the payment was processed with.
          * - amount: The amount of the payment
          * 	- currency: the currency of the payment
          * 	- amount: the amount of the payment
          * - reference: Your reference of this recurring transaction.
          * - shopperEmail: The e-mail address of the shopper
          * - shopperReference: The shopper reference, i.e. the shopper ID
          * - shopperInteraction: Should be ContAuth which specifies it's a RECURRING payment.
          * - fraudOffset: Numeric value that will be added to the fraud score (optional)
          * - shopperIP: The IP address of the shopper (optional)
          * - shopperStatement: Some acquirers allow you to provide a statement (optional)
          */

        $merchantAccount = $this->getMerchantAccount();
        $merchantReference = $this->getMerchantReference();
        $currencyCode = $this->getCurrencyCode();
        $paymentAmount = $this->getPaymentAmount();
        $shopperEmail = $this->getShopperEmail();
        $shopperReference = $this->getShopperReference();
        $openInvoiceLines = $this->getOpenInvoiceLines();
        $brand = $this->getBrand();


        if(!$merchantAccount)       throw new AdyenException("No merchantAccount set.");
        if(!$merchantReference)     throw new AdyenException("No merchantReference set.");
        if(!$currencyCode)          throw new AdyenException("No Currency Code set.");
        if(!$paymentAmount)         throw new AdyenException("No paymentAmount set.");
        if($paymentAmount < 1)      throw new AdyenException("Invalid paymentAmount: zero.");
        if(!$shopperEmail)          throw new AdyenException("No shopperEmail set.");
        if(!$shopperReference)      throw new AdyenException("No shopperReference set.");

        if (!isset($recurringDetailReference)) {
            $recurringDetailReference = "LATEST";
        }

        $request = array(
            "action" => "Payment.authorise",
            "paymentRequest.selectedRecurringDetailReference" => $recurringDetailReference,
            "paymentRequest.selectedBrand" => $brand,
            "paymentRequest.recurring.contract" => "RECURRING",
            "paymentRequest.merchantAccount" => $merchantAccount,
            "paymentRequest.amount.currency" => $currencyCode,
            "paymentRequest.amount.value" => $paymentAmount,
            "paymentRequest.reference" => $merchantReference . "-" . date("Y-m-d-H:i:s"),

            "paymentRequest.shopperEmail" => $shopperEmail,
            "paymentRequest.shopperReference" => $shopperReference,
            "paymentRequest.shopperInteraction" => "ContAuth",
        );

        if(count($openInvoiceLines) > 0) {
            $openInvoice = array();

            $linenumber = 1;
            foreach($openInvoiceLines as $line) {
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.ItemVATPercentage']  =  $line['ItemVATPercentage'];
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.currencyCode']       =  $line['currencyCode'];
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.description']        =  $line['description'];
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.itemAmount']         =  $line['itemAmount'];
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.itemVatAmount']      =  $line['itemVatAmount'];
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.lineReference']      =  $line['lineReference'];
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.numberOfItems']      =  $line['numberOfItems'];
                $request['paymentRequest.additionalData.openinvoicedata.line'.$linenumber.'.vatCategory']        =  $line['vatCategory'];
                $linenumber++;
            }
            $request['paymentRequest.additionalData.openinvoicedata.numberOfLines'] = intval(count($openInvoiceLines));

            //$request['openInvoiceData'] = $openInvoice;
        }

        /*  UNKNOWN
        	"paymentRequest.fraudOffset" => "",
        	"paymentRequest.shopperIP" => "ShopperIPAddress",
        	"paymentRequest.shopperStatement" => "",
        */

    	/**
    	 * If the recurring payment message passes validation a risk analysis will be done and, depending on the
    	 * outcome, an authorisation will be attempted. You receive a
    	 * payment response with the following fields:
    	 * - pspReference: The reference we assigned to the payment;
    	 * - resultCode: The result of the payment. One of Authorised, Refused or Error;
    	 * - authCode: An authorisation code if the payment was successful, or blank otherwise;
    	 * - refusalReason: If the payment was refused, the refusal reason.
    	 */
         return $this->sendRecurringHTTPPost($request);
    }



    public function disableRecurringContract($recurringDetailReference = null)
    {
        /**
         * Disable recurring contract using HTTP Post
         *
         * Disabling a recurring contract (detail) can be done by calling the disable action
         * on the Recurring service with a request. This file shows how you can disable
         * a recurring contract using HTTP Post.
         *
         * Please note: using our API requires a web service user. Set up your Webservice
         * user: Adyen Test CA >> Settings >> Users >> ws@Company. >> Generate Password >> Submit
         *
         * @link	5.Recurring/httppost/disable-recurring-contract.php
         * @author	Created by Adyen - Payments Made Easy
         */

        /**
         * The request should contain the following variables:
         * - action: Specifies which action on the API is required
         * - merchantAccount: The merchant account the payment was processed with.
         * - shopperReference: The reference to the shopper. This shopperReference must be the same as the
         *   shopperReference used in the initial payment.
         * - recurringDetailReference: The recurringDetailReference of the details you wish to
         *   disable. If you do not supply this field all details for the shopper will be disabled
         *   including the contract! This means that you can not add new details anymore.
         */
         $request = array(
            "action" => "Recurring.disable",
            "disableRequest.merchantAccount" => $this->getMerchantAccount(),
            "disableRequest.shopperReference" => $this->getShopperReference()
         );

         if (isset($recurringDetailReference)) {
             $request["disableRequest.recurringDetailReference"] = $recurringDetailReference;
         }


    	/**
    	 * The response will be a result object with a single field response. If a single detail was
    	 * disabled the value of this field will be [detail-successfully-disabled] or, if all
    	 * details are disabled, the value is [all-details-successfully-disabled].
    	 */
         return $this->sendRecurringHTTPPost($request);
    }


}

