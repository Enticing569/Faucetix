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

require_once 'includes/core.inc.php';

error_reporting(0);

//SOLVE SCOPE ERRORS
$error = null;
$alertForm = null;
$userIP = $user->getUserIP();

//CHECK IF THE SESSION HAS THE SAME USER'S IP ADDRESS
if (isset($_SESSION['user_ip'])) {
    if ($_SESSION['user_ip'] != $userIP) {
        header('Location: logout');
        exit;
    }
}

//GET INFO
if (isset($_SESSION['faucet_token'])) {
    $refId = $user->getUserData('ref_id', $_SESSION['address']);
    $userBalance = $user->getUserData('balance', $_SESSION['address']);
    $userId = $user->getUserData('id', $_SESSION['address']);
    $template->assign('claim_token', $user->getUserData('claim_token', $_SESSION['address']));
    $template->assign('token', $_SESSION['faucet_token']);
}

$reCaptchaPubKey = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "recaptcha_pub_key" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('GCaptchaPubKey', $reCaptchaPubKey['value']);

$getFaucetName = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "faucetName" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('faucetname', $getFaucetName['value']);
$template->assign('pageName', $pageName);
$template->assign('year', date('Y'));

//CHECK IF SITE USES HTTPS
if ((!empty($_SERVER['HTTPS'] && $_SERVER['HTTPS'] !== 'off' )) || $_SERVER['SERVER_PORT'] == 443) {
    $template->assign('siteURL', 'https://' . $_SERVER['HTTP_HOST'] . '/');
} else {
    $template->assign('siteURL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
}

//ADS SLOTS
$template->assign('spaceleft', $site->getAdData('adLeft'));
$template->assign('spacetop', $site->getAdData('adCenterTop'));
$template->assign('spaceright', $site->getAdData('adRight'));
$template->assign('spaceMiddle', $site->getAdData('adMiddle'));

$template->assign('spaceFooter1', $site->getAdData('adFooter1'));
$template->assign('spaceFooter2', $site->getAdData('adFooter2'));
$template->assign('spaceFooter3', $site->getAdData('adFooter3'));
$template->assign('spaceFooter4', $site->getAdData('adFooter4'));
$template->assign('spaceFooter5', $site->getAdData('adFooter5'));
