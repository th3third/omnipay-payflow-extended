<?php

    namespace Omnipay\PayflowExtended;

    use Omnipay\Common\CreditCard;
    use Omnipay\Tests\GatewayTestCase;

    class PayflowExtendedGatewayTest extends GatewayTestCase
    {
        public function setUp()
        {
            parent::setUp();

            $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

            $this->options = array(
                'amount' => '10.00'
                , 'card' => $this->getValidCard()
            );
        }

        public function testAddRecurringProfileSuccess()
        {
            $this->setMockHttpResponse('AddRecurringProfileSuccess.txt');

            $response = $this->gateway->addRecurringProfile($this->options)->send();

            $this->assertTrue($response->isSuccessful());
            $this->assertEquals('B70E6A323E14', $response->getTransactionReference());
        }

        public function testAddRecurringProfileFailure()
        {
            $this->setMockHttpResponse('AddRecurringProfileFailure.txt');

            $response = $this->gateway->addRecurringProfile($this->options)->send();

            $this->assertFalse($response->isSuccessful());
            
            $this->assertSame('User authentication failed', $response->getProfileMessage());
        }

        public function testRecurringProfileInquirySuccess()
        {
            $this->setMockHttpResponse('RecurringProfileInquirySuccess.txt');

            $response = $this->gateway->recurringProfileInquiry($this->options)->send();

            $this->assertTrue($response->isSuccessful());
            $this->assertEquals('Approved', $response->getMessage());
        }

        public function testRecurringProfileInquiryFailure()
        {
            $this->setMockHttpResponse('RecurringProfileInquiryFailure.txt');

            $response = $this->gateway->recurringProfileInquiry($this->options)->send();

            $this->assertFalse($response->isSuccessful());
            $this->assertSame('User authentication failed', $response->getMessage());
        }

        public function testDeactivateRecurringProfileSuccess()
        {
            $this->setMockHttpResponse('DeactivateRecurringProfileSuccess.txt');

            $response = $this->gateway->deactivateRecurringProfile($this->options)->send();

            $this->assertTrue($response->isSuccessful());
            $this->assertEquals('Approved', $response->getMessage());
        }

        public function testDeactivateRecurringProfileFailure()
        {
            $this->setMockHttpResponse('DeactivateRecurringProfileFailure.txt');

            $response = $this->gateway->deactivateRecurringProfile($this->options)->send();

            $this->assertFalse($response->isSuccessful());
            $this->assertSame('User authentication failed', $response->getMessage());
        }
    }
