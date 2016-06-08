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

$pageName = 'Ad Settings';

require_once 'global.admin.php';

if (isset($input->p)) {
    $adCenterTop = $input->p['adCenterTop'];
    $adRight = $input->p['adRight'];
    $adLeft = $input->p['adLeft'];
    $adMiddle = $input->p['adMiddle'];
    $adFooter1 = $input->p['adFooter1'];
    $adFooter2 = $input->p['adFooter2'];
    $adFooter3 = $input->p['adFooter3'];
    $adFooter4 = $input->p['adFooter4'];
    $adFooter5 = $input->p['adFooter5'];
    
    if (!$error) {
        $updateAdCenterTop = $db->Query('UPDATE `ads` SET `value` = :adCenterTop WHERE `field` = "adCenterTop";');
        $updateAdCenterTop->Bind(':adCenterTop', $adCenterTop, PDO::PARAM_STR);
        $updateAdCenterTop->Execute();

        $updateAdRight = $db->Query('UPDATE `ads` SET `value` = :adRight WHERE `field` = "adRight";');
        $updateAdRight->Bind(':adRight', $adRight, PDO::PARAM_STR);
        $updateAdRight->Execute();

        $updateAdLeft = $db->Query('UPDATE `ads` SET `value` = :adLeft WHERE `field` = "adLeft";');
        $updateAdLeft->Bind(':adLeft', $adLeft, PDO::PARAM_STR);
        $updateAdLeft->Execute();

        $updateAdMiddle = $db->Query('UPDATE `ads` SET `value` = :adMiddle WHERE `field` = "adMiddle";');
        $updateAdMiddle->Bind(':adMiddle', $adMiddle, PDO::PARAM_STR);
        $updateAdMiddle->Execute();

        $updateAdFooter1 = $db->Query('UPDATE `ads` SET `value` = :adFooter1 WHERE `field` = "adFooter1";');
        $updateAdFooter1->Bind(':adFooter1', $adFooter1, PDO::PARAM_STR);
        $updateAdFooter1->Execute();

        $updateAdFooter2 = $db->Query('UPDATE `ads` SET `value` = :adFooter2 WHERE `field` = "adFooter2";');
        $updateAdFooter2->Bind(':adFooter2', $adFooter2, PDO::PARAM_STR);
        $updateAdFooter2->Execute();

        $updateAdFooter3 = $db->Query('UPDATE `ads` SET `value` = :adFooter3 WHERE `field` = "adFooter3";');
        $updateAdFooter3->Bind(':adFooter3', $adFooter3, PDO::PARAM_STR);
        $updateAdFooter3->Execute();

        $updateAdFooter4 = $db->Query('UPDATE `ads` SET `value` = :adFooter4 WHERE `field` = "adFooter4";');
        $updateAdFooter4->Bind(':adFooter4', $adFooter4, PDO::PARAM_STR);
        $updateAdFooter4->Execute();

        $updateAdFooter5 = $db->Query('UPDATE `ads` SET `value` = :adFooter5 WHERE `field` = "adFooter5";');
        $updateAdFooter5->Bind(':adFooter5', $adFooter5, PDO::PARAM_STR);
        $updateAdFooter5->Execute();

        $success[] = 'Saved successful!';
    }
}

//ASSIGN AD
$template->assign('adCenterTop', $site->getAdData('adCenterTop'));
$template->assign('adRight', $site->getAdData('adRight'));
$template->assign('adLeft', $site->getAdData('adLeft'));
$template->assign('adMiddle', $site->getAdData('adMiddle'));
$template->assign('adFooter1', $site->getAdData('adFooter1'));
$template->assign('adFooter2', $site->getAdData('adFooter2'));
$template->assign('adFooter3', $site->getAdData('adFooter3'));
$template->assign('adFooter4', $site->getAdData('adFooter4'));
$template->assign('adFooter5', $site->getAdData('adFooter5'));

$template->assign('success', $success);
$template->assign('error', $error);
$template->display('admin/page_adSettings.tpl');
