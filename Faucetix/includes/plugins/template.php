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

$template = new Smarty();

$template->caching = true;
$template->compile_check = false;
$template->force_compile = false;

$theme = 'default';

$template->setTemplateDir(ROOTPATH . '/themes/' . $theme . '/template');
$template->setCompileDir(ROOTPATH . '/themes/' . $theme . '/template_c');
$template->setCacheDir(ROOTPATH . '/themes/' . $theme . '/cache');
