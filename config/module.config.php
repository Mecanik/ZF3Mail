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

namespace Mecanik\ZF3Mail;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

    // We load our service
    'service_manager' => [
        'factories' => [
            Service\ZF3Mail::class => Service\Factory\ZF3MailFactory::class,
        ],
    ],

    // We register module-provided controller plugins under this key.
    'controller_plugins' => [
        'factories' => [
            Controller\Plugin\ZF3MailPlugin::class => Controller\Plugin\Factory\ZF3MailPluginFactory::class,
        ],
        // You can change alias to anything
        'aliases' => [
            'zf3mail' => Controller\Plugin\ZF3MailPlugin::class,
        ],
    ],

    // We register module-provided view helpers under this key.
    'view_helpers' => [
        'factories' => [
            View\Helper\ZF3MailPlugin::class => View\Helper\Factory\ZF3MailPluginFactory::class,
        ],
        'aliases' => [
            'zf3mail' => View\Helper\ZF3MailPlugin::class,
        ],
    ],
];
