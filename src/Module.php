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

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
