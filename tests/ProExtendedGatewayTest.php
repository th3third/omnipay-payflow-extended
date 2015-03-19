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

            $this->assertTrue($response->isProfileActionSuccessful());
            $this->assertEquals('RT0000000012', $response->getProfileID());
            $this->assertEquals('R1056BE9039C', $response->getProfileReference());

            $this->assertTrue($response->isSuccessful());
            $this->assertEquals('B70E6A323E14', $response->getTransactionReference());
        }

        public function testAddRecurringProfileErrorError()
        {

        }
    }
