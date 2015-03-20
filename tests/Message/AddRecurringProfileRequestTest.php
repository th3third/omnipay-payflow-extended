<?php

    namespace Omnipay\PayflowExtended\Message;

    use Omnipay\Tests\TestCase;

    class AddRecurringProfileRequestTest extends TestCase
    {
        public function setUp()
        {
            $this->request = new RecurringProfileAddRequest($this->getHttpClient(), $this->getHttpRequest());
        }
    }
