<?php

    namespace Omnipay\PayflowExtended;

    use Omnipay\Common\CreditCard;
    use Omnipay\Tests\GatewayTestCase;

    class ProExtendedGatewayTest extends GatewayTestCase
    {
        public function setUp()
        {
            parent::setUp();

            $this->gateway = new ProExtendedGateway($this->getHttpClient(), $this->getHttpRequest());

            $this->options = array(
                'amount' => '10.00',
                'card' => new CreditCard(array(
                    'firstName' => 'Example',
                    'lastName' => 'User',
                    'number' => '4111111111111111',
                    'expiryMonth' => '12',
                    'expiryYear' => '2016',
                    'cvv' => '123',
                )),
            );
        }

        public function testAddRecurringProfileSuccess()
        {
            $this->setMockHttpResponse('AddRecurringProfileSuccess.txt');

            $response = $this->gateway->addRecurringProfile($this->options)->send();

            $this->assertTrue($response->isSuccessful());
            $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
        }

        public function testAddRecurringProfileErrorError()
        {
            $this->setMockHttpResponse('AddRecurringProfileFailure.txt');

            $response = $this->gateway->addRecurringProfile($this->options)->send();

            $this->assertFalse($response->isSuccessful());
            $this->assertSame('User authentication failed', $response->getMessage());
        }
    }
