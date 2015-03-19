<?php 

    namespace Omnipay\Payflow\ProExtended\Message;

    use Omnipay\Payflow\Message\Response;

    class RecurringBillingResponse extends Response {

    	/* uncomment to debug the raw response from Paypal
        public function __construct(\Omnipay\Common\Message\RequestInterface $request, $data) {
        	\Log::debug(__METHOD__.':: Paypal Response: '.$data);
        	parent::__construct($request,$data);
    	}
    	*/
    	
    	// this is the optional sale or authorization transaction
        public function isSuccessful()
        {
            return isset($this->data['TRXRESULT']) && '0' === $this->data['TRXRESULT'];
        }

        // this is the optional sale or authorization transaction
        public function getTransactionReference()
        {
            return isset($this->data['TRXPNREF']) ? $this->data['TRXPNREF'] : null;
        }

    	// this is the optional sale or authorization transaction
        public function getMessage()
        {
            return isset($this->data['TRXRESPMSG']) ? $this->data['TRXRESPMSG'] : null;
        }

        // this is for the profile action
        public function isProfileActionSuccessful()
        {
            return isset($this->data['RESULT']) && '0' === $this->data['RESULT'];
        }

        // this is for the profile action
    	public function getProfileReference() {
            return isset($this->data['RPREF']) ? $this->data['RPREF'] : null;		
    	}

        // this is for the profile action
    	public function getProfileID() {
            return isset($this->data['PROFILEID']) ? $this->data['PROFILEID'] : null;		
    	}

        // this is for the profile action
    	public function getProfileMessage() {
            return isset($this->data['RESPMSG']) ? $this->data['RESPMSG'] : null;		
    	}

    }
