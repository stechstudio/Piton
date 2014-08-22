<?php
use Piton\Common\LoggerLevel;

class LoggerLevelTest extends \PHPUnit_Framework_TestCase {


    public function testFindLevel(){
        $logLevel = LoggerLevel::findLevel(LoggerLevel::ALERT_STR);
        $this->assertEquals(LoggerLevel::ALERT_STR, $logLevel->toString());
        $logLevel = LoggerLevel::findLevel(LoggerLevel::ALERT);
        $this->assertEquals(LoggerLevel::ALERT, $logLevel->toInt());
    }

    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testFindBadInt(){
        LoggerLevel::findLevel(9999);
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testFindBadStr(){
        LoggerLevel::findLevel('hogwash');
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testFindBadArg(){
        LoggerLevel::findLevel(9.80);
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    public function testGetStandardLevel(){
        $logLevel = LoggerLevel::getStandardLevelByName('debug');
        $this->assertEquals(LoggerLevel::DEBUG_STR, $logLevel->__toString());
    }

    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testGetStandardLevelBadArg(){
        LoggerLevel::getStandardLevelByName(1);
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testGetStandardLevelBadName(){
        LoggerLevel::getStandardLevelByName('blarg');
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    public function testCustom(){
        $logLevel = LoggerLevel::custom(57, 'hines');
        $this->assertEquals('HINES', $logLevel->toString());
        $this->assertEquals(57, $logLevel->toInt());
    }
    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testCustomBadInt(){
        LoggerLevel::custom(5.5, 'hines');
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    /**
     * @expectedException Piton\Exceptions\InvalidArgumentException
     *
     */
    public function testCustomBadStr(){
        LoggerLevel::custom(57, array());
        $this->getExpectedException('Piton\Exceptions\InvalidArgumentException');
    }

    public function testEquals(){
        $logLevel1 = LoggerLevel::custom(57, 'hines');
        $logLevel2 = LoggerLevel::custom(57, 'hines');
        $logLevel3 = LoggerLevel::getStandardLevelByName('debug');
        $this->assertTrue($logLevel1->equals($logLevel2));
        $this->assertTrue($logLevel1->equals('hines'));
        $this->assertTrue($logLevel1->equals(57));

        $this->assertFalse($logLevel1->equals($logLevel3));
        $this->assertFalse($logLevel1->equals('debug'));
        $this->assertFalse($logLevel1->equals(500));
    }

    public function testGtEq(){
        $logLevel1 = LoggerLevel::custom(57, 'hines');
        $logLevel2 = LoggerLevel::custom(57, 'hines');
        $logLevel3 = LoggerLevel::getStandardLevelByName('fatal');
        $this->assertTrue($logLevel1->isGreaterOrEqual($logLevel2));
        $this->assertFalse($logLevel1->isGreaterOrEqual('debug'));
        $this->assertFalse($logLevel1->isGreaterOrEqual(500));

        $this->assertTrue($logLevel1->isGreaterOrEqual($logLevel3));
        $this->assertTrue($logLevel1->isGreaterOrEqual('emergency'));
        $this->assertTrue($logLevel1->isGreaterOrEqual(-2147483647));
    }

    public function testLtEq(){
        $logLevel1 = LoggerLevel::custom(57, 'hines');
        $logLevel2 = LoggerLevel::custom(57, 'hines');
        $logLevel3 = LoggerLevel::getStandardLevelByName('fatal');

        $this->assertTrue($logLevel1->isLessThanOrEqual($logLevel2));

        $this->assertTrue($logLevel1->isLessThanOrEqual('debug'));
        $this->assertTrue($logLevel1->isLessThanOrEqual(500));

        $this->assertFalse($logLevel1->isLessThanOrEqual($logLevel3));
        $this->assertFalse($logLevel1->isLessThanOrEqual('emergency'));
        $this->assertFalse($logLevel1->isLessThanOrEqual(-2147483647));
    }

}