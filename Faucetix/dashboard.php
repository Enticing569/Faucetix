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

if ($user->getUserData('id', $_SESSION['address']) == 0) {
    header('Location: logout');
    exit;
}

//VERIFY IF FAUCET IS ACTIVE
$getFaucetActive = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "active" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('faucetActive', $getFaucetActive['value']);

//GET TIMER BETWEEN REWARDS
$getFaucetTimer = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "timer" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('faucetTimer', $getFaucetTimer['value']);

//GET MIN REWARD
$getFaucetMinReward = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "minReward" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$minReward = $getFaucetMinReward['value'];
$template->assign('minReward', $minReward);

//GET MAX REWARD
$getFaucetMaxReward = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "maxReward" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$maxReward = $getFaucetMaxReward['value'];
$template->assign('maxReward', $maxReward);

//GET REFERRAL PERCENT
$getRefPercent = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "ref_percent" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('refPercent', $getRefPercent['value']);

$nextClaim = $user->getUserData('last_claim', $_SESSION['address']) + ($getFaucetTimer['value'] * 60);

if (time() >= $nextClaim) {

    if ($user->getUserData('claim_token', $_SESSION['address']) == 'null') {
        $tokenKey = hash('sha256', ('faucetKey_' . $_SESSION['address'] . time() . rand(5, 255)));
        $updateClaimToken = $db->Query('UPDATE `users` SET `claim_token` = :claim_token WHERE `address` = :address;');
        $updateClaimToken->Bind(':claim_token', $tokenKey, PDO::PARAM_STR);
        $updateClaimToken->Bind(':address', $_SESSION['address'], PDO::PARAM_STR);
        $updateClaimToken->Execute();
        header('Location: dashboard');
        exit;
    }

    if ($input->g['c'] == 1) {
        if ($input->p['verifykey'] == $user->getUserData('claim_token', $_SESSION['address'])) {
            $updateClaimedToken = $db->Query('UPDATE `users` SET `claim_token` = "null", `last_activity` = :last_activity WHERE `address` = :address;');
            $updateClaimedToken->Bind(':address', $_SESSION['address'], PDO::PARAM_STR);
            $updateClaimedToken->Bind(':last_activity', time(), PDO::PARAM_INT);
            $updateClaimedToken->Execute();

            $checkCAPTCHA = json_decode($site->checkCaptcha($input->p['g-recaptcha-response']))->success;

            //CHECK reCAPTCHA
            if (!$checkCAPTCHA) {
                $error[] = $lang['dash']['wrong_captcha'];
            }

            //CHECK IF USER ARE USING PROXY
            $getProxySetting = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "checkProxy" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
            if ($getProxySetting['value'] == 'yes' && $site->checkProxy($userIP)) {
                $error[] = $lang['dash']['proxy_detected'];
            }

            if (!$error) {
                $reward = rand($minReward, $maxReward);

                $updateAccount = $db->Query('UPDATE `users` SET `balance` = balance + :reward, `last_claim` = :last_claim WHERE `address` = :address;');
                $updateAccount->Bind(':reward', $reward, PDO::PARAM_INT);
                $updateAccount->Bind(':last_claim', time(), PDO::PARAM_INT);
                $updateAccount->Bind(':address', $_SESSION['address'], PDO::PARAM_STR);
                $updateAccount->Execute();

                $insertHistory = $db->Query('INSERT INTO `history` (user_id, type, amount, timestamp) VALUES (:user_id, :type, :amount, :timestamp);');
                $insertHistory->Bind(':user_id', $userId, PDO::PARAM_INT);
                $insertHistory->Bind(':type', 'Reward', PDO::PARAM_STR);
                $insertHistory->Bind(':amount', $reward, PDO::PARAM_INT);
                $insertHistory->Bind(':timestamp', time(), PDO::PARAM_INT);
                $insertHistory->Execute();

                $template->assign('reward', $reward);

                $getRefPercent = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "ref_percent" LIMIT 1');
                $refPercent = $getRefPercent->Evaluate(0);
                
                if ($refPercent > 0) {
                    if ($refId != 0) {
                        $refPercentDecimal = floor($refPercent) / 100;
                        $refComission = floor($refPercentDecimal * $reward);

                        $updateRef = $db->Query('UPDATE `users` SET `balance` = balance + :ref_comission WHERE `id` = :ref_id;');
                        $updateRef->Bind(':ref_comission', $refComission, PDO::PARAM_INT);
                        $updateRef->Bind(':ref_id', $refId, PDO::PARAM_INT);
                        $updateRef->Execute();

                        $refHistory = $db->Query('INSERT INTO `history` (user_id, type, amount, timestamp) VALUES (:user_id, :type, :amount, :timestamp);');
                        $refHistory->Bind(':user_id', $refId, PDO::PARAM_INT);
                        $refHistory->Bind(':type', 'Referral', PDO::PARAM_STR);
                        $refHistory->Bind(':amount', $refComission, PDO::PARAM_INT);
                        $refHistory->Bind(':timestamp', time(), PDO::PARAM_INT);
                        $refHistory->Execute();
                    }
                }
            }
        } else {
            $removeToken = $db->Query('UPDATE `users` SET `claim_token` = "null" WHERE address = :address;');
            $removeToken->Bind(':address', $_SESSION['address'], PDO::PARAM_STR);
            $removeToken->Execute();
            $error[] = $lang['global']['system_abuse'];
        }
    } else {
        $template->assign('userClaimToken', $user->getUserData('claim_token', $_SESSION['address']));
    }
} else {
    $timeLeft = floor(($nextClaim - time()) / 60);
    $template->assign('timeLeft', $timeLeft);
}

$template->assign('timestamp', time());
$template->assign('nextClaim', $nextClaim);
$template->assign('error', $error);
$template->assign('token', $_SESSION['faucet_token']);
$template->assign('captcha', $input->g['c']);
$template->assign('address', $_SESSION['address']);
$template->assign('balance', $user->getUserData('balance', $_SESSION['address']));
$template->display('page_dash.tpl');
