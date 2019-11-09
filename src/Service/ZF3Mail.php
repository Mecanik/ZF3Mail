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

namespace Mecanik\ZF3Mail\Service;

use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Mime;
use Zend\View\Model\ViewModel;
use Mecanik\ZF3Mail\Exception;

class ZF3Mail
{
    /**
     * SMTP manager.
     * @var Zend\Mail\Transport\Smtp
     */
    private $smtpManager;
    
    /**
     * PHP template renderer.
     * @var Zend\View\Renderer\PhpRenderer 
     */
    private $viewRenderer;
    
    /**
     * ZF3Mail config.
     * @var array 
     */
    private $config;

    /**
     * Constructor.
     */
    public function __construct($smtpManager, $viewRenderer, $config)
    {
        $this->smtpManager = $smtpManager;
        $this->viewRenderer = $viewRenderer;
        $this->config = $config;
    }

    public function compose($headers = [], $template = [], $parameters = null, $options = null)
    {
        if(!is_array($headers)) {
            throw new Exception\InvalidArgumentException('Invalid headers provided, expected array type.');
        }

        if(!array_key_exists('from', $headers) || !array_key_exists('to', $headers) || !array_key_exists('subject', $headers)) {
            throw new Exception\InvalidArgumentException('Invalid headers provided, expected array type containing from, to and subject.');
        }

        if(!is_array($template)) {
            throw new Exception\InvalidArgumentException('Invalid template provided, expected array type.');
        }

        if(isset($parameters) && !is_array($parameters)) {
            throw new Exception\InvalidArgumentException('Invalid parameters provided, expected array type.');
        }

        $bodyHtml = null;

        if(isset($parameters)) {
            $bodyHtml = $this->viewRenderer->render($template['content_template'], $parameters);
        }
        else {
            $bodyHtml = $this->viewRenderer->render($template['content_template']);
        }

        $viewModel = null;

        if(isset($template['layout'])) {
            $viewModel = new ViewModel(['email_content' => $bodyHtml]);
            $viewModel->setTemplate($template['layout']);
        }
        else {
            $viewModel = new ViewModel(['email_content' => $bodyHtml]);
            $viewModel->setTemplate($this->config['default_layout']);
        }
        
        $message = new Message();
        
        // Set message encoding; this only affects headers.
        $message->setEncoding($this->config['encoding']);

        // Create a MIME part specifying encoding, and content
        $html_part = new MimePart($this->viewRenderer->render($viewModel));
        $html_part->type = Mime::TYPE_HTML;

        // Create a MIME message, add the part, and attach it to the mail message:
        $email_body = new MimeMessage();
        $email_body->addPart($html_part);
        $message->setBody($email_body);

        // Add the headers including from, to, subject and any additional headers we want.
        foreach ($headers as $name => $value) {
            $message->getHeaders()->addHeaderLine($name, $value);
        }

        return $message;
    }

    public function send($message)
    {
        //var_Dump();

        $this->smtpManager->send($message);
    }
}