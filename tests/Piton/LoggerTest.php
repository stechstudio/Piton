<?php
namespace Piton;


use Piton\Common\LoggerLevel;

class LoggerTest extends \PHPUnit_Framework_TestCase
{

    protected $consoleAppender = ['console' => ['target' => 'STDOUT', 'class' => 'Piton\Appender\Console']];
    protected $allAppenders = [
        'logger' => ['level' => 'info'],
        'appenders' => [
            'console' => [
                'target' => 'STDOUT',
                'class' => 'Piton\Appender\Console'
            ],
            'null' => ['class' => 'Piton\Appender\Null'],
            'splunk' => [
                'target' => 'api-fake.data.splunkstorm.com',
                'class' => 'Piton\Appender\SplunkStorm',
                'context' => [
                    'SplunkStorm' => [
                        'projectID' => 'SomeFakeProjectID',
                        'accessToken' => 'AnotherFakeAccessToken',
                        'apiVersion' => 1,
                        'apiEndpoint' => 'inputs/http',
                        'urlScheme' => 'https'
                    ]
                ]
            ]
        ]
    ];
    /**
     * @var Logger
     */
    protected $logger;

    public function testConstructor()
    {
        $this->assertEquals(LoggerLevel::INFO_STR, $this->logger->getLevel());
    }

    public function testSetEmptyAppenders()
    {
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setAppenders([]);
    }

    public function testSetNoClassAppenders()
    {
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setAppenders(['nothing' => ['nada']]);
    }

    public function testSetNoConfigArrayAppenders()
    {
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setAppenders(['nothing']);
    }

    public function testSetEmptyClassArrayAppenders()
    {
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setAppenders(['empty' => ['class' => []]]);
    }

    public function testSetBadClassArrayAppenders()
    {
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setAppenders(['bad' => ['class' => 'NonExistantClass']]);
    }

    public function testNullFactory()
    {
        $nullLogger = Logger::defaultNullFactory();
        $this->assertEquals('null', $nullLogger->getAppender('null')->getName());
    }

    public function testConsoleFactory()
    {
        $nullLogger = Logger::defaultConsoleFactory();
        $this->assertEquals('console', $nullLogger->getAppender('console')->getName());
    }

    public function testContextualizeMessage(){
        $nullLogger = Logger::defaultNullFactory();
        $nullLogger->contextualizeMessage = TRUE;
        $nullLogger->enableTimestamp();
        $nullLogger->setRequiredMessage('{MESSAGE} {LOGLEVEL}');
        $this->assertNull($nullLogger->info('Booohyaaaa'));
    }
    public function testGetAppender()
    {
        $this->assertEquals('splunk', $this->logger->getAppender('splunk')->getName());
        $this->assertEquals('null', $this->logger->getAppender('null')->getName());
        $this->assertEquals('console', $this->logger->getAppender('console')->getName());
        $this->assertFalse($this->logger->getAppender('IDonNotExist'));
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->getAppender(['stuff']);
    }

    public function testGetSetLevel()
    {
        $this->logger->setLevel('error');
        $this->assertEquals('ERROR', $this->logger->getLevel()->toString());

        $this->logger->setLevel(500);
        $this->assertEquals('NOTICE', $this->logger->getLevel()->toString());

        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setLevel(array());

    }

    public function testRemoveAppender()
    {
        $this->assertEquals(3, $this->logger->appenderCount());
        $this->logger->removeAppender('null');
        $this->assertEquals(2, $this->logger->appenderCount());
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->removeAppender([]);
    }

    public function testTimestamp()
    {
        $this->assertFalse($this->logger->usesTimeStamp());
        $this->logger->enableTimestamp();
        $this->assertTrue($this->logger->usesTimeStamp());
        $this->logger->disableTimestamp();
        $this->assertFalse($this->logger->usesTimeStamp());

        $this->assertEquals('D M j G:i:s.u T Y', $this->logger->getTimestampFormat());
        $this->logger->setTimestampFormat('D M j G:i:s.u Y');
        $this->assertEquals('D M j G:i:s.u Y', $this->logger->getTimestampFormat());
        $this->logger->setTimestampFormat('D M j G:i:s.u T Y');
        $this->assertTrue(
            date_create_from_format('D M j G:i:s.u T Y', $this->logger->createTimeStamp()) instanceof \DateTime
        );
        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setTimestampFormat([]);
    }

    public function testRequiredMessage()
    {
        $this->assertFalse($this->logger->usesRequiredMessage());
        $this->logger->enableRequiredMessage();
        $this->assertTrue($this->logger->usesRequiredMessage());
        $this->logger->disableRequiredMessage();
        $this->assertFalse($this->logger->usesRequiredMessage());

        $this->logger->setRequiredMessage('Bubba {required} this');
        $this->assertEquals('Bubba {required} this', $this->logger->getRequiredMessage());

        $this->setExpectedException('Piton\Exceptions\InvalidArgumentException');
        $this->logger->setRequiredMessage([]);
    }

    public function testRequiredContext()
    {
        $this->assertFalse($this->logger->usesRequiredContext());
        $this->logger->enableRequiredContext();
        $this->assertTrue($this->logger->usesRequiredContext());
        $this->logger->disableRequiredContext();
        $this->assertFalse($this->logger->usesRequiredContext());

        $this->logger->setRequiredContext(['bubba' => 'said']);
        $this->assertEquals(['bubba' => 'said'], $this->logger->getRequiredContext());
    }

    public function testLogEqualLevel()
    {
        $this->logger->removeAppender('console');
        $this->logger->removeAppender('splunk');
        $this->logger->setLevel('info');
        $this->assertNull($this->logger->log('info', 'my test log', []));
    }

    public function testLogLowerLevel()
    {
        $this->logger->removeAppender('console');
        $this->logger->removeAppender('splunk');
        $this->logger->setLevel('info');
        $this->assertNull($this->logger->log('error', 'my test log', []));
    }

    public function testLogHigherLevel()
    {
        $this->logger->removeAppender('console');
        $this->logger->removeAppender('splunk');
        $this->logger->setLevel('info');
        $this->assertNull($this->logger->log('debug', 'my test log', []));
    }

    public function testLogBadLevel()
    {
        $this->logger->removeAppender('console');
        $this->logger->removeAppender('splunk');
        $this->logger->setLevel('info');
        $this->assertNull($this->logger->log([], 'my test log', []));
    }

    public function testUsingFormatedMessage(){
        $this->logger->removeAppender('console');
        $this->logger->removeAppender('splunk');
        $this->logger->setLevel('info');
        $this->logger->setRequiredMessage('bubba required this');
        $this->logger->enableRequiredMessage();
        $this->assertNull($this->logger->log('info', 'my test log', []));
    }

    public function testUsingMergedContexts(){
        $this->logger->removeAppender('console');
        $this->logger->removeAppender('splunk');
        $this->logger->setLevel('info');
        $this->logger->setRequiredContext(['testing'=>'tested']);
        $this->logger->enableRequiredContext();
        $this->assertNull($this->logger->log('info', 'my {testing} log', []));
    }

    protected function setUp()
    {
        $this->logger = new Logger($this->allAppenders);
    }

}
 