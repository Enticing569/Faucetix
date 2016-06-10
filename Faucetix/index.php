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

require_once 'global.php';

if (isset($_SESSION['faucet_token'])) {
    header('Location: dashboard');
    exit;
}

if (!$_COOKIE['ref']) {
    if ($input->g['ref'] != null) {
        setcookie('ref', $input->g['ref'], time() + (3600 * 24));
    }
}

if (isset($input->p)) {
    $address = $input->p['address'];
    $ref_id = $ref_id ? $user->getUserData('id', $_COOKIE['ref']) : $user->getUserData('id', $input->g['ref']);
    $token = $user->genToken($input->p['address']);

    if (!$wallet->validate($address)) {
        $error[] = $lang['index']['invalid_address'];
        $alertForm = 'has-error';
    }

    $getUserByIP = $db->Query('SELECT `id` FROM `users` WHERE `last_ip` = :last_ip;');
    $getUserByIP->Bind(':last_ip', $userIP, PDO::PARAM_STR);
    $userCountByIP = $getUserByIP->rowCount();

    //CHECK IF ADDRESS IS BANNED
    $checkAddressBan = $db->Query('SELECT `id` FROM `address_banned` WHERE `address` = :address;');
    $checkAddressBan->Bind(':address', $address, PDO::PARAM_STR);
    if ($checkAddressBan->rowCount() > 0) {
        $error[] = 'Your address is banned from this service!';
    }

    $getRefPercent = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "ref_percent" LIMIT 1;')->Single(PDO::FETCH_ASSOC);

    if (!$error) {
        $checkAccount = $db->Query('SELECT `id` FROM `users` WHERE `address` = :address LIMIT 1;');
        $checkAccount->Bind(':address', $address, PDO::PARAM_STR);

        if ($checkAccount->rowCount() < 1 && $userCountByIP < 1) {
            $createAccount = $db->Query('INSERT INTO `users` (address, token, ref_id, last_ip, last_activity) VALUES (:address, :token, :ref_id, :last_ip, :last_activity);');
            $createAccount->Bind(':address', $address, PDO::PARAM_STR);
            $createAccount->Bind(':token', $token, PDO::PARAM_STR);
            if ($getRefPercent['value'] > 0) {
                $createAccount->Bind(':ref_id', $ref_id, PDO::PARAM_INT);
            } else {
                $createAccount->Bind(':ref_id', 0, PDO::PARAM_INT);
            }
            $createAccount->Bind(':last_ip', $userIP, PDO::PARAM_STR);
            $createAccount->Bind(':last_activity', time(), PDO::PARAM_INT);
            $createAccount->Execute();

            $_SESSION['faucet_token'] = $user->genToken($address);
            $_SESSION['address'] = $address;
            $_SESSION['user_ip'] = $userIP;

            header('Location: dashboard');
            exit;
        } elseif ($checkAccount->rowCount() == 1 && $userCountByIP == 1) {
            $loginAccount = $db->Query('UPDATE `users` SET `last_activity` = :last_activity, `last_ip` = :last_ip WHERE `address` = :address;');
            $loginAccount->Bind(':last_activity', time(), PDO::PARAM_INT);
            $loginAccount->Bind(':last_ip', $userIP, PDO::PARAM_STR);
            $loginAccount->Bind(':address', $address, PDO::PARAM_STR);
            $loginAccount->Execute();

            $_SESSION['faucet_token'] = $user->genToken($address);
            $_SESSION['address'] = $address;
            $_SESSION['user_ip'] = $userIP;

            header('Location: dashboard');
            exit;
        } else {
            $error[] = $lang['index']['ip_in_use'];
        }
    }
}

$template->assign('address', $input->p['address']);
$template->assign('alertForm', $alertForm);
$template->assign('error', $error);
$template->display('page_index.tpl');
