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

$pageName = 'User List';

require_once 'global.admin.php';

if (!isset($_SESSION['faucet_admin'])) {
    header('Location: login');
    exit;
}

$userList = $db->Query('SELECT * FROM `users` ORDER BY `last_activity` DESC;');
$template->assign('userList', $userList->resultSet(PDO::FETCH_ASSOC));

$template->display('admin/page_userlist.tpl');