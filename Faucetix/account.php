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

$pageName = 'Account';

require_once 'global.php';

if (!isset($_SESSION['faucet_token'])) {
    header('Location: index');
    exit;
}

//GET MININIMUM WITHDRAW
$getMinWithdraw = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "minWithdraw" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$minWithdraw = $getMinWithdraw['value'];
$template->assign('minWithdraw', $minWithdraw);

if (isset($input->g['withdraw']) == 'true') {
    if ($userBalance >= $minWithdraw) {
        $result = $faucetbox->send($_SESSION['address'], $userBalance);
        if ($result['success'] === true) {
            $updateAccount = $db->Query('UPDATE `users` SET `balance` = :balance, `received` = `received` + :received, `last_activity` = :last_activity WHERE `address` = :address;');
            $updateAccount->Bind(':balance', 0, PDO::PARAM_INT);
            $updateAccount->Bind(':received', $userBalance, PDO::PARAM_INT);
            $updateAccount->Bind(':last_activity', time(), PDO::PARAM_INT);
            $updateAccount->Bind(':address', $_SESSION['address'], PDO::PARAM_STR);
            $updateAccount->Execute();

            $insertHistory = $db->Query('INSERT INTO `history` (user_id, type, amount, timestamp) VALUES (:user_id, :type, :amount, :timestamp);');
            $insertHistory->Bind(':user_id', $userId, PDO::PARAM_INT);
            $insertHistory->Bind(':type', 'Withdrawal', PDO::PARAM_STR);
            $insertHistory->Bind(':amount', $userBalance, PDO::PARAM_INT);
            $insertHistory->Bind(':timestamp', time(), PDO::PARAM_INT);
            $insertHistory->Execute();
        }
    } else {
        $result['html'] = '<div class="alert alert-danger">You do not have the minimum balance for withdrawal.</div>';
    }
    $template->assign('resultHTML', $result['html']);
}

//Total Claims
$TotalClaims = $db->Query('SELECT `id` FROM `history` WHERE `type` = "Reward" AND `user_id` = :user_id;');
$TotalClaims->Bind(':user_id', $userId, PDO::PARAM_INT);
$template->assign('TotalClaims', $TotalClaims->rowCount());

//Total Claimed Reward
$TotalReward = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Reward" AND `user_id` = :user_id;');
$TotalReward->Bind(':user_id', $userId, PDO::PARAM_INT);
$template->assign('TotalReward', $TotalReward->Evaluate() ? $TotalReward->Evaluate() : 0);

//Total Referral Payout
$TotalRefClaim = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Referral" AND `user_id` = :user_id;');
$TotalRefClaim->Bind(':user_id', $userId, PDO::PARAM_INT);
$template->assign('TotalRefClaim', $TotalRefClaim->Evaluate() ? $TotalRefClaim->Evaluate() : 0);

//Claims last 24h
$ClaimsLast24h = $db->Query('SELECT `id` FROM `history` WHERE `type` = "Reward" AND `user_id` = :user_id AND `timestamp` > :last24h;');
$ClaimsLast24h->Bind(':user_id', $userId, PDO::PARAM_INT);
$ClaimsLast24h->Bind(':last24h', (time() - 86400), PDO::PARAM_INT);
$template->assign('ClaimsLast24h', $ClaimsLast24h->rowCount());

//Claimed last 24h
$ClaimedLast24h = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Reward" AND `user_id` = :user_id AND `timestamp` > :last24h;');
$ClaimedLast24h->Bind(':user_id', $userId, PDO::PARAM_INT);
$ClaimedLast24h->Bind(':last24h', (time() - 86400), PDO::PARAM_INT);
$template->assign('ClaimedLast24h', $ClaimedLast24h->Evaluate() ? $ClaimedLast24h->Evaluate() : 0);

//Ref Claimed last 24h
$RefClaimedLast24h = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Referral" AND `user_id` = :user_id AND `timestamp` > :last24h;');
$RefClaimedLast24h->Bind(':user_id', $userId, PDO::PARAM_INT);
$RefClaimedLast24h->Bind(':last24h', (time() - 86400), PDO::PARAM_INT);
$template->assign('RefClaimedLast24h', $RefClaimedLast24h->Evaluate() ? $RefClaimedLast24h->Evaluate() : 0);

//GET LAST 15 TRANSACTIONS OF USER
$userTransacitions = $db->Query('SELECT * FROM `history` WHERE `user_id` = :user_id ORDER BY `id` DESC LIMIT 15;');
$userTransacitions->Bind(':user_id', $userId, PDO::PARAM_INT);
$template->assign('userTransaction', $userTransacitions->resultSet(PDO::FETCH_ASSOC));

$template->assign('token', $_SESSION['faucet_token']);
$template->assign('address', $_SESSION['address']);
$template->assign('balance', $user->getUserData('balance', $_SESSION['address']));
$template->display('page_account.tpl');
