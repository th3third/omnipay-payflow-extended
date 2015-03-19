<?php

    namespace Omnipay\PayflowExtended;

    use Omnipay\Payflow\ProGateway;

    /**
    * Payflow Pro Extended class
    *
    * @author Marshall Miller
    * @link https://www.x.com/sites/default/files/payflowgateway_guide.pdf
    */
    class ProGateway extends AbstractGateway
    {
        public function getName()
        {
            return 'Payflow_Pro_Extended';
        }

        public function addRecurringProfile(Array $parameters = array()) 
        {
            return $this->createRequest('\Omnipay\PayflowExtended\Message\RecurringBillingRequest', $parameters);
        }
    }