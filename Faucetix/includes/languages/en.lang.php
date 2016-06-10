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

$lang = [
    'global' => [
        'address' => 'Address',
        'balance' => 'Balance',
        'logout' => 'Log out',
        'satoshi' => 'Satoshi',
        'next' => 'Next',
        'claim' => 'Claim',
        'withdrawal' => 'Withdrawal',
        'system_abuse' => 'Abusing the system is not allowed. <a href="index">Try again</a>'
    ],
    'navbar' => [
        'home' => 'Home',
        'faucet_list' => 'Faucet List'
    ],
    'index' => [
        'title' => 'Home',
        'invalid_address' => 'Invalid bitcoin address!',
        'faucet' => 'Faucet',
        'enter_address_claim' => 'Enter your Address and start to claim!',
        'ip_in_use' => 'Your IP address is already in use!',
        'bitcoin_address' => 'Bitcoin Address',
        'enter_address' => 'Enter your Bitcoin Address'
    ],
    'dash' => [
        'title' => 'Dashboard',
        'wrong_captcha' => 'Captcha is wrong. <a href="index">Try again</a>.',
        'proxy_detected' => 'VPN/Proxy/Tor is not allowed on this faucet.<br />Please disable and <a href="index">Try again</a>.',
        'account_stats_withdraw' => 'Account/Stats/Withdraw',
        'claim' => '1. Claim',
        'your_claim' => '3. Your Claim',
        'claim_success' => 'You\'ve claimed successfully %REWARD% Satoshi.<br />You can claim again in %TIMER% minutes!',
        'possibility_1' => 'Reward: %REWARD% Satoshi every time',
        'possibility_2' => 'Reward: %REWARD% Satoshi every %TIMER% minutes',
        'possibility_3' => 'Rewards: %MIN_REWARD% to %MAX_REWARD% Satoshi every time',
        'possibility_4' => 'Rewards: %MIN_REWARD% to %MAX_REWARD% Satoshi every %TIMER% minutes',
        'already_claimed' => 'You have already claimed in the last %TIMER% minutes.<br />You can claim again in %TIMELEFT% minutes.<br /><a href="index.php">Refresh</a>',
        'reflink' => 'Reflink:',
        'share_reflink' => 'Share this link with your friends and earn %PERCENT%% referral commission',
        'faucet_disabled' => 'Faucet disabled!'
    ],
    'claim' => [
        'title' => 'Claim',
        'solve_captcha' => '2. Solve Captcha',
        'claim_failed' => 'Claim failed. <a href="index">Go back</a>'
    ],
    'account' => [
        'title' => 'Account',
        'insufficient_funds' => 'You do not have the minimum balance for withdrawal.',
        'withdraw_faucetbox' => 'Withdraw to FaucetBOX',
        'withdraw_unavailable' => 'Withdraw is not avaible.',
        'stats' => 'Stats',
        'all_time' => 'All time',
        'total_claims' => 'Total Claims',
        'total_claimed' => 'Total Claimed',
        'total_referral_payout' => 'Total Referral Payout',
        'last24h' => 'Last 24 Hours',
        'claims' => 'Claims',
        'claimed' => 'Claimed',
        'last15transactions' => 'Last 15 Transactions',
        'type' => 'Type',
        'amount' => 'Amount',
        'time' => 'Time'
    ]
];
