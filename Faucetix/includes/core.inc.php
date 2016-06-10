<?php

/*  _____                    _   _      
 * |  ___|_ _ _   _  ___ ___| |_(_)_  __
 * | |_ / _` | | | |/ __/ _ \ __| \ \/ /
 * |  _| (_| | |_| | (_|  __/ |_| |>  < 
 * |_|  \__,_|\__,_|\___\___|\__|_/_/\_\                                     
 *
 * @name: Faucetix Faucet Script
 * @author: Neto Melo (neto737) <contact@neto737.net>
 * @license: GNU General Public License v3
 * @copyright: Copyright (c) 2016 Faucetix
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('ROOTPATH', dirname(dirname(__FILE__)) . '/');

require_once 'config.inc.php';
require_once 'classes/databaseManager.class.php';
require_once 'classes/inputManager.class.php';
require_once 'classes/siteManager.class.php';
require_once 'classes/userManager.class.php';
require_once 'classes/walletManager.class.php';
require_once 'gateways/faucetbox.php';
require_once 'plugins/Smarty/Smarty.class.php';
require_once 'plugins/template.php';

//DATABASE CONNECTION
$db = new databaseManager($config['database']['type'], $config['database']['host'], $config['database']['port'], $config['database']['user'], $config['database']['pass'], $config['database']['name'], $config['database']['char']);

//START ANOTHERS CLASSES
$input = new inputManager;
$user = new userManager($db);
$site = new siteManager($db);
$wallet = new walletManager;

//FAUCETBOX API SETTINGS
$faucetBoxAPI = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "FaucetBOX" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$faucetbox = new FaucetBOX($faucetBoxAPI['value'], 'BTC');

//SELECT THE BEST LANGUAGE [BASED IN USER BROWSER LANGUAGE]
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

$language = (in_array($language, ['en'])) ? $language : 'en';
require_once 'languages/' . $language . '.lang.php';
$template->assign('lang', $lang);
