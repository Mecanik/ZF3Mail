<?php
/**
 * ZF3Mail
 *
 * Zend Framework 3 SMTP E-Mail Module
 *
 * @link https://github.com/Mecanik/ZF3Mail
 * @copyright Copyright (c) 2019 Norbert Boros ( a.k.a Mecanik )
 * @license https://github.com/Mecanik/ZF3Mail/blob/master/LICENSE
 */

namespace Mecanik\ZF3Mail\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Mecanik\ZF3Mail\Controller\Plugin\ZF3MailPlugin;
use Mecanik\ZF3Mail\Service\ZF3Mail;

/**
 * This is the factory for ZF3MailPlugin. Its purpose is to instantiate the plugin
 * and inject dependencies into its constructor.
 */
class ZF3MailPluginFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $mailService = $container->get(ZF3Mail::class);
        
        return new ZF3MailPlugin($mailService);
    }
}