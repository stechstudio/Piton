<?php

use Piton\Common\Abstracts\Logger;

class AbstractLoggerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Logger
     */
    protected  $abstractLoggerStub;

    protected function setUp(){
        $this->abstractLoggerStub = $this->getMockForAbstractClass('Piton\Common\Abstracts\Logger');
        $this->abstractLoggerStub->expects($this->any())->method('log')->will($this->returnValue(NULL));
    }

    public function testSTSLoggerInterface(){
        $this->assertInstanceOf('Piton\Common\Interfaces\Logger', $this->abstractLoggerStub);
    }

    public function testPsrLogLoggerInterface(){
        $this->assertInstanceOf('\Psr\Log\LoggerInterface', $this->abstractLoggerStub);
    }


    public function testFatal(){
        $this->assertNull($this->abstractLoggerStub->fatal("Fatal Test"));
    }

    public function testEmergency(){
        $this->assertNull($this->abstractLoggerStub->emergency("Emergency Test"));
    }
    public function testAlert(){
        $this->assertNull($this->abstractLoggerStub->Alert("Alert Test"));
    }
    public function testCritical(){
        $this->assertNull($this->abstractLoggerStub->Critical("Critical Test"));
    }
    public function testError(){
        $this->assertNull($this->abstractLoggerStub->Error("Error Test"));
    }
    public function testWarning(){
        $this->assertNull($this->abstractLoggerStub->Warning("Warning Test"));
    }
    public function testNotice(){
        $this->assertNull($this->abstractLoggerStub->Notice("Notice Test"));
    }
    public function testInfo(){
        $this->assertNull($this->abstractLoggerStub->Info("Info Test"));
    }
    public function testDebug(){
        $this->assertNull($this->abstractLoggerStub->Debug("Debug Test"));
    }
    public function testTrace(){
        $this->assertNull($this->abstractLoggerStub->Trace("Trace Test"));
    }
}
 