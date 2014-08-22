<?php
use Piton\Appender\SplunkStorm;

class SplunkStormTest extends \PHPUnit_Framework_TestCase {

    protected $target;
    protected $name;
    protected $context;
    /**
     * @var SplunkStorm
     */
    protected $appender;

    protected function setUp(){
        $this->target = 'api-fake.data.splunkstorm.com';
        $this->name = 'SplunkStorm Logger';
        $this->context = ['SplunkStorm' => ['projectID'=>'SomeFakeProjectID',
            'accessToken' => 'AnotherFakeAccessToken',
            'apiVersion'  => 1,
            'apiEndpoint' => 'inputs/http',
            'urlScheme'   => 'https'
        ]
        ];
        $this->appender = new SplunkStorm($this->name, $this->target, $this->context );
    }

    public function testConstruction(){
        $this->assertEquals($this->name, $this->appender->getName());
    }

    public function testAppend(){
        $client = $this->getMockBuilder('GuzzleHttp\Client')
            ->setMethods(['send'])
            ->getMock();
        $client->expects($this->once())
            ->method('send')
            ->will($this->returnArgument(0));
        $this->appender->setClient($client);
        $this->appender->append('PHPUNIT Test', []);
        $this->assertTrue(TRUE);
    }

    public function testAppendThrowsException(){
        // Set the expectation of the exception
        $this->setExpectedException('SebastianBergmann\Exporter\Exception');
        $this->appender->append('PHPUNIT Test', []);
    }

    public function testConfigureThrowsException(){
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->appender->configure(array());
    }

    public function testVerifyThrowsException(){
        $this->context = ['SplunkStorm' => ['projectID'=>'SomeFakeProjectID',
        ]
        ];
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->appender->configure($this->context);
    }
}