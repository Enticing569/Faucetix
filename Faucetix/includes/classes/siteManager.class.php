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

class siteManager {

    public function __construct($db) {
        $this->db = $db;
    }

    public function toBTC($amount) {
        return number_format($amount / 100000000, 8);
    }

    public function checkCaptcha($response) {
        $reCAPTCHA_privKey = $this->db->Query('SELECT `value` FROM `settings` WHERE `setting` = "recaptcha_sec_key" LIMIT 1;')->Single(PDO::FETCH_ASSOC);
        $reCATPCHA_url = 'https://www.google.com/recaptcha/api/siteverify';
        $reCAPTCHA_data = ['secret' => $reCAPTCHA_privKey['value'], 'response' => $response];

        $reCAPTCHA_options = [
            'http' => [
                'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
                'method' => 'POST',
                'content' => http_build_query($reCAPTCHA_data)
            ]
        ];

        $reCAPTCHA_context = stream_context_create($reCAPTCHA_options);
        $reCAPTCHA_result = file_get_contents($reCATPCHA_url, false, $reCAPTCHA_context);
        return $reCAPTCHA_result;
    }
    
    public function getAdData($adField) {
        $getAd = $this->db->Query('SELECT `value` FROM `ads` WHERE `field` = :adField LIMIT 1;');
        $getAd->Bind(':adField', $adField, PDO::PARAM_STR);
        return $getAd->Single(PDO::FETCH_ASSOC)['value'];
    }

    public function checkProxy($ipAddress) {
        $json = json_decode(file_get_contents('https://check.bitlucky.org/?ip=' . $ipAddress));

        if ($json->success) {
            if ($json->suggestion === 'deny') {
                return true;
            }
        }
    }

}
