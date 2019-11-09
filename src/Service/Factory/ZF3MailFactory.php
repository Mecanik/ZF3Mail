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

namespace Mecanik\ZF3Mail\Service\Factory;

use Interop\Container\ContainerInterface;
use Mecanik\ZF3Mail\Service\ZF3Mail;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * This is the factory class for ZF3Mail service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class ZF3MailFactory implements FactoryInterface
{
    /**
     * This method creates the ZF3Mail service and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $config = $container->get('Config');

        $zf3mail_config = isset($config['zf3mail_config']['smtp_login']) ? $config['zf3mail_config']['smtp_login'] : [];

        $smtp_config = new \Zend\Mail\Transport\SmtpOptions($zf3mail_config);

        $smtpManager = new \Zend\Mail\Transport\Smtp($smtp_config);

        $viewRenderer = $container->get('ViewRenderer');

        // Create the ZF3Mail and inject dependency to its constructor.
        return new ZF3Mail($smtpManager, $viewRenderer, $config['zf3mail_config']);
    }
}