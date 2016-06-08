# Faucetix Faucet Script

Faucetix pays to account, and the user can request withdrawal when he wants.

## Requirements
- PHP 5.4 or higher
- MySQL

## Features
- FaucetBOX compatible
- PDO
- Smarty (easier to change themes, and caching to speed up your website)
- Language system (in development)
- Check proxies
- reCAPTCHA v2
- Referral system
- Only one account per IP address
- Ban addresses
- URL Rewrite
- And more...

## Instalation
- Download the files.
- Upload files to your FTP Server
- Upload **faucetix.sql** using PhpMyAdmin (or another tool you prefer)
- Configure **includes/config.inc.php** with your MySQL data, like:

```php
$config = [
    'database' => [
        'host' => 'localhost',
        'user' => 'database_username',
        'pass' => 'database_password',
        'name' => 'database_name',
        'type' => 'mysql',
        'char' => 'utf8',
        'port' => 3306
    ]
];
```

- Open your website admin (http://yourdomain.tld/admin/) with login datas:


**Username:** admin

**Password:** admin

Now you're logged in at admin, you need to configure **FaucetBOX** API Key and **reCAPTCHA** API Keys to your faucet can start working.

## Donations
#### Donate: 1DNAopnenZxPLiY4N4sHPwpaRZbxmYJQX7