<?php
/**
 * ConfigurationTest.php
 *
 * PHP Version 5
 *
 * @category magento2
 * @package  magento2
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace DavidVerholen\Whoops\Test\Integration;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;

/**
 * Class ConfigurationTest
 *
 * @category magento2
 * @package  DavidVerholen\Whoops\Test
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class ModuleConfigTest extends \PHPUnit_Framework_TestCase
{
    protected $moduleName = 'DavidVerholen_Whoops';

    public function testTheModuleIsRegistered()
    {
        /** @var ComponentRegistrar $componentRegistrar */
        $componentRegistrar = $this->getObjectManager()->get(ComponentRegistrar::class);
        $this->assertArrayHasKey(
            $this->moduleName,
            $componentRegistrar->getPaths(ComponentRegistrar::MODULE)
        );
    }

    public function testTheModuleIsConfiguredAndEnabled()
    {
        /** @var ModuleList $moduleList */
        $moduleList = $this->getObjectManager()->create(ModuleList::class);
        $this->assertTrue($moduleList->has($this->moduleName), 'The Module is not enabled');
    }

    /**
     * getObjectManager
     *
     * @return ObjectManager
     */
    private function getObjectManager()
    {
        return ObjectManager::getInstance();
    }
}
