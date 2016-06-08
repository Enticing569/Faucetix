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

$pageName = 'Admin Login';

require_once 'global.admin.php';

if (isset($input->p)) {
    $username = $input->p['username'];
    $password = sha1($input->p['password']);

    if (empty($username)) {
        $error[] = 'Username em branco!';
        $alertForm = 'has-error';
    }

    if (empty($password)) {
        $error[] = 'Password em branco!';
        $alertForm = 'has-error';
    }

    if (!empty($username) && !empty($password) && !$error) {
        $checkAdmin = $db->Query('SELECT `id` FROM `admin` WHERE `username` = :username AND `password` = :password');
        $checkAdmin->Bind(':username', $username, PDO::PARAM_STR);
        $checkAdmin->Bind(':password', $password, PDO::PARAM_STR);

        if ($checkAdmin->Evaluate(0) != 0) {
            $admin_token = sha1(md5('bitLucky@username:' . $username . '-bitLucky@password:' . $password));
            
            $updateAdmin = $db->Query('UPDATE `admin` SET `token` = :token WHERE `username` = :username;');
            $updateAdmin->Bind(':token', $admin_token, PDO::PARAM_STR);
            $updateAdmin->Bind(':username', $username, PDO::PARAM_STR);
            $updateAdmin->Execute();
            
            $_SESSION['faucet_admin'] = $admin_token;
            header('Location: index');
            exit;
        } else {
            $error[] = 'Dados não conferem!';
            $alertForm = 'has-error';
        }
    }
}

$template->assign('alertForm', $alertForm);
$template->assign('error', $error);
$template->display('admin/page_login.tpl');
