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

namespace Mecanik\ZF3Mail\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * This controller plugin is used for returning the ZF3Mail service.
 */
class ZF3MailPlugin extends AbstractPlugin
{
    private $mailService;
    
    public function __construct($mailService)
    {
        $this->mailService = $mailService;
    }
    
    public function __invoke()
    {
        return $this->mailService;
    }
}