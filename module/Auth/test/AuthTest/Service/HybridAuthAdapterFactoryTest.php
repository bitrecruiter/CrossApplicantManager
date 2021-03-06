<?php
/**
 * YAWIK - Unit Tests
 *
 * @copyright (c) 2013-2104 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */


namespace AuthTest\Service;

use Auth\Service\HybridAuthAdapterFactory as Factory;
use Zend\ServiceManager\ServiceManager;

class HybridAuthAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    
    public function testFactoryReturnsProperConfiguredInstanceOfHybridAuthAdapter()
    {
        $f = new Factory();
        $sm = new ServiceManager();
        
        $hauth = $this->getMockBuilder('\Hybrid_Auth')
            ->disableOriginalConstructor()
            ->getMock();
        
        $mapper = $this->getMockForAbstractClass('\Auth\Mapper\UserMapperInterface');
        
        $sm->setService('UserMapper', $mapper);
        $sm->setService('HybridAuth', $hauth);
        
        $adapter = $f->createService($sm);
        
        $this->assertInstanceOf('\Auth\Adapter\HybridAuth', $adapter);
        $this->assertSame($hauth, $adapter->getHybridAuth());
        $this->assertSame($mapper, $adapter->getMapper());
    }
}