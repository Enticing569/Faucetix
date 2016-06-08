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

$pageName = 'Faucet Stats';

require_once 'global.admin.php';

if(!isset($_SESSION['faucet_admin'])) {
    header('Location: login');
    exit;
}

/* FAUCET STATS */
//Get users count
$getUsersCount = $db->Query('SELECT `id` FROM `users`;');
$template->assign('UsersCount', $getUsersCount->rowCount());

//Get total withdraws
$getTotalWithdraws = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Withdrawal";');
$template->assign('TotalWithdraw', $getTotalWithdraws->Evaluate() ? $site->toBTC($getTotalWithdraws->Evaluate()) : 0);

/* TOTAL STATS */
//Total Claims
$TotalClaims = $db->Query('SELECT `id` FROM `history` WHERE `type` = "Reward";');
$template->assign('TotalClaims', $TotalClaims->rowCount());

//Total Claimed Reward
$TotalReward = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Reward";');
$template->assign('TotalReward', $TotalReward->Evaluate() ? $site->toBTC($TotalReward->Evaluate()) : 0);

//Total Referral Payout
$TotalRefClaim = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Referral";');
$template->assign('TotalRefClaim', $TotalRefClaim->Evaluate() ? $site->toBTC($TotalRefClaim->Evaluate()) : 0);

/* LAST 24h STATS */
//Claims last 24h
$ClaimsLast24h = $db->Query('SELECT `id` FROM `history` WHERE `type` = "Reward" AND `timestamp` > :last24h;');
$ClaimsLast24h->Bind(':last24h', (time() - 86400), PDO::PARAM_INT);
$template->assign('ClaimsLast24h', $ClaimsLast24h->rowCount());

//Withdraw last 24h
$WithdrawLast24h = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Withdrawal" AND `timestamp` > :last24h;');
$WithdrawLast24h->Bind(':last24h', (time() - 86400), PDO::PARAM_INT);
$template->assign('Withdraw24h', $WithdrawLast24h->Evaluate() ? $site->toBTC($WithdrawLast24h->Evaluate()) : 0);

//Claimed last 24h
$ClaimedLast24h = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Reward" AND `timestamp` > :last24h;');
$ClaimedLast24h->Bind(':last24h', (time() - 86400), PDO::PARAM_INT);
$template->assign('ClaimedLast24h', $ClaimedLast24h->Evaluate() ? $site->toBTC($ClaimedLast24h->Evaluate()) : 0);

//Ref Claimed last 24h
$RefClaimedLast24h = $db->Query('SELECT SUM(`amount`) FROM `history` WHERE `type` = "Referral" AND `timestamp` > :last24h;');
$RefClaimedLast24h->Bind(':last24h', (time() - 86400), PDO::PARAM_INT);
$template->assign('RefClaimedLast24h', $RefClaimedLast24h->Evaluate() ? $site->toBTC($RefClaimedLast24h->Evaluate()) : 0);

$template->display('admin/page_index.tpl');