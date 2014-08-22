<?php
use Piton\Appender\Null;

class NullTest extends \PHPUnit_Framework_TestCase {

    public function testConstruction(){
        $appender = new Null();
        $expected = '';
        $appender->append('Ignore me', []);
        $actual = $appender->getTarget();
        $this->assertEquals($expected, $actual);
    }

    public function testTypeOf(){
        $appender = new Null();
        $this->assertInstanceOf('Piton\Common\Abstracts\Appender', $appender);

    }

}