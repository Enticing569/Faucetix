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

$pageName = 'Faucet List';

require_once 'global.php';

$refAddress = '1DNAopnenZxPLiY4N4sHPwpaRZbxmYJQX7';

$getJavaScript = file_get_contents('https://static.faucetbox.com/scanthebox/BTC.js');

$array = ["faucets['BTC'] = ", ';'];
$output = str_replace($array, '', $getJavaScript);

$json = json_decode($output, true);
$template->assign('json', $json);

$template->assign('refAddress', $refAddress);
$template->display('page_faucetList.tpl');
