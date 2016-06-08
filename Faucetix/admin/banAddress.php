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

$pageName = 'Ban Address';

require_once 'global.admin.php';

if (!isset($_SESSION['faucet_admin'])) {
    header('Location: login');
    exit;
}

if ($input->g['do'] == 'ban') {
    $address2ban = $input->p['addresses'];
    
    if (empty($address2ban)) {
        $error[] = 'Can\'t find Bitcoin Address.';
    }
    
    if (!$error) {
        $address = explode("\r\n", $input->p['addresses']);
        foreach ($address as $addresses) {
            $banAddress = $db->Query('INSERT INTO `address_banned` (address) VALUES (:address)');
            $banAddress->Bind('address', $addresses, PDO::PARAM_STR);
            $banAddress->Execute();
        }
        
        $success[] = 'Bitcoin Address added to the blacklist.';
    }
}

if ($input->g['do'] == 'unban') {
    $unbanAddress = $input->g['id'];
    
    $verifyBan = $db->Query('SELECT `id` FROM `address_banned` WHERE `id` = :banId;');
    $verifyBan->Bind(':banId', $unbanAddress, PDO::PARAM_INT);
    if ($verifyBan->rowCount() > 0) {
        $removeBan = $db->Query('DELETE FROM `address_banned` WHERE `id` = :banId;');
        $removeBan->Bind(':banId', $unbanAddress, PDO::PARAM_INT);
        $removeBan->Execute();
        
        $success[] = 'Bitcoin Address was removed from banlist.';
    } else {
        $error[] = 'The Bitcoin Address/ID can\'t be found in the banlist.';
    }
}

$getBannedAddress = $db->Query('SELECT * FROM `address_banned`');
$template->assign('bannedAddress', $getBannedAddress->resultSet(PDO::FETCH_ASSOC));

$template->assign('success', $success);
$template->assign('error', $error);
$template->display('admin/page_banaddress.tpl');