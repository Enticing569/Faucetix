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

if (!isset($_SESSION['faucet_token'])) {
    header('Location: index');
    exit;
}

$getFaucetTimer = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "timer" LIMIT 1;')->Single(PDO::FETCH_ASSOC);

$nextClaim = $user->getUserData('last_claim', $_SESSION['address']) + ($getFaucetTimer['value'] * 60);

if (time() < $nextClaim) {
    header('Location: dashboard');
    exit;
}

$template->assign('verifykey', $input->p['verifykey']);
$template->assign('user_claimtoken', $user->getUserData('claim_token', $_SESSION['address']));
$template->display('page_claim.tpl');
