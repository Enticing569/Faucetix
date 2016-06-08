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

class userManager {

    public function __construct($db) {
        $this->db = $db;
    }

    public function genToken($address) {
        return sha1($address);
    }

    public function getUserData($column, $address) {
        $getUserData = $this->db->Query('SELECT `' . $column . '` FROM `users` WHERE `address` = :address LIMIT 1;');
        $getUserData->Bind(':address', $address, PDO::PARAM_STR);
        if ($column == 'id' || $column == 'ref_id') {
            return $getUserData->Evaluate(0);
        } else {
            return $getUserData->Evaluate();
        }
    }

    public function getUserIP() {
        $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $cloudflare = $_SERVER['HTTP_CF_CONNECTING_IP'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } elseif (filter_var($cloudflare, FILTER_VALIDATE_IP)) {
            $ip = $cloudflare;
        } else {
            $ip = $remote;
        }
        return $ip;
    }

}
