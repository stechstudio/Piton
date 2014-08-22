<?php
use Piton\Appender\Console;

class ConsoleTest extends \PHPUnit_Framework_TestCase {

    public function testConstruction(){
        $appender = new Console();
        $expected = Console::STDOUT;
        $actual = $appender->getTarget();
        $this->assertEquals($expected, $actual);
    }

    public function testSetTarget(){
        $appender = new Console();
        $appender->setTarget(Console::STDERR);
        $expected = Console::STDERR;
        $actual = $appender->getTarget();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testSetTargetException(){
        $appender = new Console();
        $appender->setTarget('I no exist');
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    public function testTypeOf(){
        $appender = new Console();
        $this->assertInstanceOf('Piton\Common\Abstracts\Appender', $appender);

    }

    public function testAppend(){
        $appender = new Console();

        $streamProp = new ReflectionProperty($appender, 'fp');
        $memStream = \fopen('php://memory', 'rw');
        $streamProp->setAccessible(true);
        $streamProp->setValue($appender, $memStream);

        $expected = 'Test Log Message'.PHP_EOL;
        $appender->append($expected, []);
        \fseek($memStream, 0);
        $actual = \stream_get_contents($memStream);
        $this->assertEquals(trim(preg_replace('/\s+/', ' ', $expected)), trim(preg_replace('/\s+/', ' ', $actual)));
        $pos = ftell($memStream);

        $message= 'Test {ary} Message';
        $context = [ 'ary' => ['one', 'two'=>[1,1]]];
        $appender->append($message, $context);

        $expected='Test Array
(
    [0] => one
    [two] => Array
        (
            [0] => 1
            [1] => 1
        )

)
 Message';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);
        $this->assertEquals(trim(preg_replace('/\s+/', ' ', $expected)), trim(preg_replace('/\s+/', ' ', $actual)));


        $message= 'Test {exception} Message';
        $context = [ 'exception' => new \Exception('A PHPUNIT Test.')];
        $appender->append($message, $context);

        $expected='A PHPUNIT Test.';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);
        $this->assertContains($expected, $actual);

        $message= 'Test {object} Message';
        $context = [ 'object' => $this ];
        $appender->append($message, $context);

        $expected='ConsoleTest::testAppend';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);

        $message= 'Test {object} Message';
        $obj = new stdClass();
        $obj->tp = "test param";
        $context = [ 'object' =>  $obj];
        $appender->append($message, $context);

        $expected='stdClass';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);

        $message= 'Test {object} Message';

        $context = [ 'object' =>  \Piton\Common\LoggerLevel::findLevel('alert')];
        $appender->append($message, $context);

        $expected='ALERT';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);

        $message= 'Test {boool} Message';

        $context = [ 'boool' =>  TRUE];
        $appender->append($message, $context);

        $expected='TRUE';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);


        $message= 'Test {boool} Message';

        $context = [ 'boool' =>  FALSE];
        $appender->append($message, $context);

        $expected='FALSE';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);

        $message= 'Test {numeric} Message';

        $context = [ 'numeric' =>  1.9872222000];
        $appender->append($message, $context);

        $expected='1.9872222';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);

        $message= 'Test {resource} Message';

        $context = [ 'resource' =>  $memStream];
        $appender->append($message, $context);

        $expected='(stream)';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);

        $message= 'Test {null} Message';

        $context = [ 'null' =>  NULL];
        $appender->append($message, $context);

        $expected='NULL_TOKEN';

        \fseek($memStream, $pos);
        $actual = \stream_get_contents($memStream);
        $pos = ftell($memStream);

        $this->assertContains($expected, $actual);

    }

}