# ZF3Mail - Zend Framework 3 SMTP E-Mail Module
 [![Latest Stable Version](https://poser.pugx.org/mecanik/zf3mail/v/stable)](https://packagist.org/packages/mecanik/zf3mail)
 [![License](https://poser.pugx.org/mecanik/zf3mail/license)](https://packagist.org/packages/mecanik/zf3mail)
 [![Total Downloads](https://poser.pugx.org/mecanik/zf3mail/downloads)](https://packagist.org/packages/mecanik/zf3mail)
 
Description
------------
E-Mail Module to make your development much faster and easier when sending HTML emails.

### Current Features:
* Service (e-mail SMTP transport) using the "Zend 3" method
* Ability to use custom templates from `phtml` files
* Ability to use custom templates with custom layouts per email, from `phtml` files
* Ability to add custom headers
* Plugin for usage in all your controllers
* Plugin for usage in view templates (if needed)
* PHP 7 friendly (and required)
* No other dependencies (than Zend Framework 3)


Installation
------------
Installation is done via Composer:

```
composer require mecanik/zf3mail
```

SMTP Configuration
----------------
Create config/autoload/zf3mail.global.php with the content:

```php
<?php
return [
   'zf3mail_config' => [
       'smtp_login' => [
           'name' => 'smtp.hostname.net',
           'host' => 'smtp.hostname.net',
           'connection_class' => 'login',
           'connection_config' => [
               'username' => '',
               'password' => '',
               'ssl' => 'tls',
           ],
       ],
       
       // By default, the Message class assumes ASCII encoding for your email. I've set UTF-8, but change as neccessary.
       'encoding' => 'UTF-8',
       
       // Default layout used for all HTML emails. This can be replaced per email basis by specifying 'layout' array parameter when composing emails.
       'default_layout' => 'application/emails/default_layout.phtml',
   ],
];
```

Module Configuration/Usage
----------------

Load the module (in any order):

```
'Mecanik\ZF3Mail'
```

There are 3 ways to use this module:

* By injecting the service into any of your controllers (via factory): 

```
    $mailService = $container->get(\Mecanik\ZF3Mail\Service\ZF3Mail::class);
```

* By just using it as a plugin inside any of your controllers:

```
$this->zf3mail()
```

* By just using it as a plugin inside any of your views:

```
$this->zf3mail()
```

However since the module is automatically already registered as plugins, I would recommend to just use the plugin in any controller you want.

Composing e-mails
----------------

When composing emails you must specify a couple of things like 'from', 'to, 'subject', template, and all this is done via the easiest way: arrays.

You can also add extra headers, and overwrite the "default" layout if needed for each email.

```php
<?php
$headers = [      
   'from' => 'My Name <noreply@mywebsite.com>',
   'subject' => 'Hello there',
   'to' => 'Neo <neo@matrix.com>',
   // Additional headers can be specified like:
   // 'X-API-Key', 'FOO-BAR-BAZ-BAT'
];

$template = [
   'content_template' => 'application/emails/order-received.phtml',
   //'layout' => 'application/emails/layout.phtml',
];

$email = $this->zf3mail()->compose($headers, $template, $parameters);
```

When you are done composing, just simply send it:

```
$this->zf3mail()->send($email);
```

Layouts explained
----------------

As you noticed in the configuration, all HTML emails sent will use a "default" layout:

```
'default_layout' => 'application/emails/default_layout.phtml',
```

This can be overwritten for every email you send as seen above, but it must contain the variable to echo the content:

```php
 <?php echo $this->email_content ?>
```

That's all for now, enjoy!
