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

require_once '../includes/core.inc.php';

error_reporting(0);

//SOLVE SCOPE ERRORS
$success = null;
$error = null;
$alertForm = null;

if (isset($_SESSION['faucet_admin'])) {
    $template->assign('loggedin', true);
}

$getFaucetName = $db->Query('SELECT `value` FROM `settings` WHERE `setting` = "faucetName" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
$template->assign('faucetname', $getFaucetName['value']);
$template->assign('pageName', $pageName);
$template->assign('year', date('Y'));