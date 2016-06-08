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

$pageName = 'Faucet Settings';

require_once 'global.admin.php';

if (!isset($_SESSION['faucet_admin'])) {
    header('Location: login');
    exit;
}

$getAdminUsername = $db->Query('SELECT `username` FROM `admin` WHERE `token` = :token LIMIT 1;');
$getAdminUsername->Bind(':token', $_SESSION['faucet_admin'], PDO::PARAM_STR);
$template->assign('username', $getAdminUsername->Evaluate());

//CHANGE ADMIN LOGIN DETAILS
if ($input->g['do'] == 'login') {
    if (isset($input->p)) {
        $username = $input->p['username'];
        $password = $input->p['password'];
        $passwordEnc = sha1($password);

        if (empty($username)) {
            $error[] = 'Username em branco!';
        }

        if (empty($password)) {
            $error[] = 'Password em branco!';
        }

        if (!$error) {
            $updateAdmin = $db->Query('UPDATE `admin` SET `username` = :username, `password` = :password WHERE `token` = :token;');
            $updateAdmin->Bind(':username', $username, PDO::PARAM_STR);
            $updateAdmin->Bind(':password', $passwordEnc, PDO::PARAM_STR);
            $updateAdmin->Bind(':token', $_SESSION['faucet_admin'], PDO::PARAM_STR);
            $updateAdmin->Execute();

            $success[] = 'Admin login details changed successful!';
        }
    }
}

//CHANGE FAUCET NAME
if ($input->g['do'] == 'faucetname') {
    if ($input->p) {
        $faucetname = $input->p['faucetname'];

        if (empty($faucetname)) {
            $error[] = 'Nome do faucet em branco!';
        }

        if (!$error) {
            $updateFaucetName = $db->Query('UPDATE `settings` SET `value` = :faucetName WHERE `setting` = "faucetName";');
            $updateFaucetName->Bind(':faucetName', $faucetname, PDO::PARAM_STR);
            $updateFaucetName->Execute();

            $success[] = 'Faucet name changed successful!';
        }
    }
}

$minReward = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "minReward";')->Single(PDO::FETCH_ASSOC);
$template->assign('minReward', $minReward['value']);

$maxReward = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "maxReward";')->Single(PDO::FETCH_ASSOC);
$template->assign('maxReward', $maxReward['value']);

//CHANGE FAUCET REWARDS
if ($input->g['do'] == 'rewards') {
    if ($input->p) {
        $minreward = $input->p['minreward'];
        $maxreward = $input->p['maxreward'];

        if (empty($minreward)) {
            $error[] = 'Recompensa mínima em branco!';
        }

        if (empty($maxreward)) {
            $error[] = 'Recompensa máxima em branco!';
        }

        if (!$error) {
            $updateMinReward = $db->Query('UPDATE `settings` SET `value` = :minReward WHERE `setting` = "minReward";');
            $updateMinReward->Bind(':minReward', $minreward, PDO::PARAM_INT);
            $updateMinReward->Execute();

            $updateMaxReward = $db->Query('UPDATE `settings` SET `value` = :maxReward WHERE `setting` = "maxReward";');
            $updateMaxReward->Bind(':maxReward', $maxreward, PDO::PARAM_INT);
            $updateMaxReward->Execute();

            $success[] = 'Rewards updated!';
        }
    }
}

$getMinWithdraw = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "minWithdraw" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('minWithdraw', $getMinWithdraw['value']);

//CHANGE MINIMUM WITHDRAW
if ($input->g['do'] == 'withdraw') {
    if ($input->p) {
        $withdraw = $input->p['withdraw'];

        if (!is_numeric($withdraw)) {
            $error[] = 'Valor não numérico!';
        }
        
        if ($withdraw < 0) {
            $error[] = 'Apenas valores iguais ou maiores que zero!';
        }

        if (!$error) {
            $updateWithdraw = $db->Query('UPDATE `settings` SET `value` = :withdraw WHERE `setting` = "minWithdraw";');
            $updateWithdraw->Bind(':withdraw', $withdraw, PDO::PARAM_INT);
            $updateWithdraw->Execute();

            $success[] = 'Minimum withdraw changed successful!';
        }
    }
}

$getTimer = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "timer" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('timer', $getTimer['value']);

//CHANGE FAUCET TIMER
if ($input->g['do'] == 'timer') {
    if ($input->p) {
        $timer = $input->p['timer'];

        if (!is_numeric($timer)) {
            $error[] = 'Valor não numérico!';
        }
        
        if ($timer < 0) {
            $error[] = 'Apenas valores iguais ou maiores que zero!';
        }

        if (!$error) {
            $updateTimer = $db->Query('UPDATE `settings` SET `value` = :timer WHERE `setting` = "timer";');
            $updateTimer->Bind(':timer', $timer, PDO::PARAM_INT);
            $updateTimer->Execute();

            $success[] = 'Faucet timer changed successful!';
        }
    }
}

$getRefPercent = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "ref_percent" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('refPercent', $getRefPercent['value']);

//CHANGE REFERRAL PERCENTAGE
if ($input->g['do'] == 'referral') {
    if ($input->p) {
        $referral = $input->p['referral'];

        if (!is_numeric($referral)) {
            $error[] = 'Valor não numérico!';
        }
        
        if ($referral < 0) {
            $error[] = 'Apenas valores iguais ou maiores que zero!';
        }

        if (!$error) {
            $updateRef = $db->Query('UPDATE `settings` SET `value` = :referral WHERE `setting` = "ref_percent";');
            $updateRef->Bind(':referral', $referral, PDO::PARAM_INT);
            $updateRef->Execute();

            $success[] = 'Ref percent changed successful!';
        }
    }
}

$getFaucetBOX = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "FaucetBOX" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('faucetboxkey', $getFaucetBOX['value']);

//CHANGE FAUCETBOX API KEY
if ($input->g['do'] == 'faucetbox') {
    if ($input->p) {
        $faucetbox = $input->p['faucetboxkey'];

        if (empty($faucetbox)) {
            $error[] = 'FaucetBOX API Key em branco!';
        }

        if (!$error) {
            $updateFaucetBOX = $db->Query('UPDATE `settings` SET `value` = :faucetbox WHERE `setting` = "FaucetBOX";');
            $updateFaucetBOX->Bind(':faucetbox', $faucetbox, PDO::PARAM_INT);
            $updateFaucetBOX->Execute();

            $success[] = 'FaucetBOX API Key changed successful!';
        }
    }
}

$captchaPubKey = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "recaptcha_pub_key";')->Single(PDO::FETCH_ASSOC);
$template->assign('reCAPTCHA_PubKey', $captchaPubKey['value']);

$captchaPrivKey = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "recaptcha_sec_key";')->Single(PDO::FETCH_ASSOC);
$template->assign('reCAPTCHA_PrivKey', $captchaPrivKey['value']);

//CHANGE RECAPTCHA API KEYS
if ($input->g['do'] == 'recaptcha') {
    if ($input->p) {
        $pubKey = $input->p['recaptcha_pubkey'];
        $privKey = $input->p['recaptcha_privkey'];

        if (empty($pubKey)) {
            $error[] = 'Public key em branco!';
        }

        if (empty($privKey)) {
            $error[] = 'Private key em branco!';
        }

        if (!$error) {
            $updatePublicKey = $db->Query('UPDATE `settings` SET `value` = :publicKey WHERE `setting` = "recaptcha_pub_key";');
            $updatePublicKey->Bind(':publicKey', $pubKey, PDO::PARAM_STR);
            $updatePublicKey->Execute();

            $updatePrivateKey = $db->Query('UPDATE `settings` SET `value` = :privateKey WHERE `setting` = "recaptcha_sec_key";');
            $updatePrivateKey->Bind(':privateKey', $privKey, PDO::PARAM_STR);
            $updatePrivateKey->Execute();

            $success[] = 'reCAPTCHA API Keys updated!';
        }
    }
}

$checkProxyStatus = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "checkProxy";')->Single(PDO::FETCH_ASSOC);
$template->assign('checkProxy', $checkProxyStatus['value']);

//ENABLE/DISABLE CHECKPROXY
if ($input->g['do'] == 'checkproxy') {
    if ($checkProxyStatus['value'] == 'yes') {
        if ($input->g['s'] == 0) {
            $disableProxyCheck = $db->Query('UPDATE `settings` SET `value` = "no" WHERE `setting` = "checkProxy";')->Execute();
            $success[] = 'Proxy check is disabled.';
        }
    }

    if ($checkProxyStatus['value'] == 'no') {
        if ($input->g['s'] == 1) {
            $enableProxyCheck = $db->Query('UPDATE `settings` SET `value` = "yes" WHERE `setting` = "checkProxy";')->Execute();
            $success[] = 'Proxy check is enabled.';
        }
    }
}

$claimStatus = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "active";')->Single(PDO::FETCH_ASSOC);
$template->assign('claimStatus', $claimStatus['value']);

//ENABLE/DISABLE CLAIM
if ($input->g['do'] == 'claim') {
    if ($claimStatus['value'] == 'yes') {
        if ($input->g['s'] == 0) {
            $disableFaucet = $db->Query('UPDATE `settings` SET `value` = "no" WHERE `setting` = "active";')->Execute();
            $success[] = 'Claiming from Faucet is disabled.';
        }
    }

    if ($claimStatus['value'] == 'no') {
        if ($input->g['s'] == 1) {
            $enableFaucet = $db->Query('UPDATE `settings` SET `value` = "yes" WHERE `setting` = "active";')->Execute();
            $success[] = 'Claiming from Faucet is enabled.';
        }
    }
}

$template->assign('success', $success);
$template->assign('error', $error);
$template->display('admin/page_settings.tpl');
