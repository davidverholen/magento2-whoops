<?php
/**
 * Plugin.php
 *
 * PHP Version 5
 *
 * @category magento2
 * @package  magento2
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */

namespace DavidVerholen\Whoops\Model;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\PrettyPageHandlerFactory;
use Whoops\Run;
use Whoops\RunFactory;

/**
 * Class Plugin
 *
 * @category magento2
 * @package  DavidVerholen\Whoops\Model
 * @author   David Verholen <david@verholen.com>
 * @license  http://opensource.org/licenses/OSL-3.0 OSL-3.0
 * @link     http://github.com/davidverholen
 */
class Plugin
{
    /**
     * @var bool
     */
    private static $isWhoopsRegistered = false;

    /**
     * @var RunFactory
     */
    private $whoopsFactory;

    /**
     * @var PrettyPageHandlerFactory
     */
    private $prettyPageHandlerFactory;

    /**
     * Plugin constructor.
     *
     * @param RunFactory               $whoopsFactory
     * @param PrettyPageHandlerFactory $prettyPageHandlerFactory
     */
    public function __construct(
        RunFactory $whoopsFactory,
        PrettyPageHandlerFactory $prettyPageHandlerFactory
    ) {
        $this->whoopsFactory = $whoopsFactory;
        $this->prettyPageHandlerFactory = $prettyPageHandlerFactory;
    }

    /**
     * beforeLoad
     *
     * @param $subject
     * @param $identifier
     *
     * @return array
     */
    public function beforeLoad(
        $subject,
        $identifier
    ) {
        if (self::$isWhoopsRegistered) {
            return [$identifier];
        }

        /** @var Run $whoops */
        $whoops = $this->whoopsFactory->create();

        /** @var PrettyPageHandler $prettyPageHandler */
        $prettyPageHandler = $this->prettyPageHandlerFactory->create();

        $whoops->pushHandler($prettyPageHandler);
        $whoops->register();

        return [$identifier];
    }
}
