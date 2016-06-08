{include file='admin/header.tpl'}
<body>
    {include file='admin/navbar.tpl'}
    <div class="container">
        <div id="containertop">
            <div class="row">
                <div class="col-md-6 col-md-offset-3"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="well content">
                <h1>Faucet Admin</h1>
                <h2>Settings</h2>
                {if isset($success)}
                    {foreach $success as $message}
                        <div class="alert alert-success" role="alert">{$message}</div>
                    {/foreach}
                {/if}
                {if isset($error)}
                    {foreach $error as $reason}
                        <div class="alert alert-danger" role="alert">{$reason}</div>
                    {/foreach}
                {/if}
                <hr />

                <div class="col-md-12">
                    <div class="col-md-6">
                        <h4>Change Admin login datas</h4>
                        <form method='post' action='settings?do=login'>
                            <div class='form-group'>
                                <label>Username</label>
                                <center><input class='form-control' type='text' name='username' style='width: 225px;' value='{$username}' placeholder='Type your new username'></center>
                            </div>

                            <div class='form-group'>
                                <label>Password</label>
                                <center><input class='form-control' type='password' name='password' style='width: 225px;' placeholder='Type your new password'></center>
                            </div>

                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h4>Change Faucet name</h4>
                        <form method='post' action='settings?do=faucetname'>
                            <div class='form-group'>
                                <label>Faucetname</label>
                                <center><input class='form-control' type='text' name='faucetname' style='width: 225px;' value='{$faucetname}' placeholder='Faucetname ...'></center>
                            </div>
                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>
                    <hr>
                </div>

                <div class="col-md-12">
                    <br>
                    <br>
                    <div class="col-md-6">
                        <h4>Change Rewards</h4>
                        <form method='post' action='settings?do=rewards'>
                            <div class='form-group'>
                                <label>Mininum Reward (Satoshi)</label>
                                <center><input class='form-control' type='number' name='minreward' style='width: 225px;' value='{$minReward}' placeholder='Mininum Reward'></center>
                            </div>
                            <div class='form-group'>
                                <label>Maximum Reward (Satoshi)</label>
                                <center><input class='form-control' type='number' name='maxreward' style='width: 225px;' value='{$maxReward}' placeholder='Maximum Reward'></center>
                            </div>
                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h4>Minimum Withdraw</h4>
                        <form method='post' action='settings?do=withdraw'>
                            <div class='form-group'>
                                <label>Minimum withdraw in satoshi</label>
                                <center><input class='form-control' type='number' name='withdraw' style='width: 225px;' value='{$minWithdraw}' placeholder='25'></center>
                            </div>
                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>
                    <hr>
                </div>


                <div class="col-md-12">
                    <br>
                    <br>
                    <div class="col-md-6">
                        <h4>Timer</h4>
                        <form method='post' action='settings?do=timer'>
                            <div class='form-group'>
                                <label>Timer (minutes)</label>
                                <center><input class='form-control' type='number' name='timer' style='width: 225px;' value='{$timer}' placeholder='Timer'></center>
                            </div>
                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h4>Referral Program</h4>
                        <form method='post' action='settings?do=referral'>
                            <div class='form-group'>
                                <label>Commission in %</label>
                                <center><input class='form-control' type='number' name='referral' style='width: 225px;' value='{$refPercent}' min='1' max='100' placeholder='25'></center>
                                <span class='help-block'>To disable Referral Program enter 0</span>
                            </div>
                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>
                    <hr>
                </div>

                <div class="col-md-12">
                    <br>
                    <br>
                    <div class="col-md-6">
                        <h4>FaucetBOX API Key</h4>
                        <form method='post' action='settings?do=faucetbox'>
                            <div class='form-group'>
                                <label>Faucetbox Key</label>
                                <center><input class='form-control' type='text' name='faucetboxkey' style='width: 275px;' value='{$faucetboxkey}' placeholder='Faucetbox Key'></center>
                            </div>
                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h4>reCAPTCHA Keys</h4>
                        <form method='post' action='settings?do=recaptcha'>
                            <div class='form-group'>
                                <div class='form-group'>
                                    <label>reCAPTCHA Public Key</label>
                                    <center><input class='form-control' type='text' name='recaptcha_pubkey' style='width: 375px;' value='{$reCAPTCHA_PubKey}' placeholder='reCaptcha Public Key'></center>
                                </div>
                                <label>reCAPTCHA Private Key</label>
                                <center><input class='form-control' type='text' name='recaptcha_privkey' style='width: 375px;' value='{$reCAPTCHA_PrivKey}' placeholder='reCaptcha Private Key'></center>
                            </div>
                            <button type='submit' class='btn btn-primary'>Change</button>
                        </form>
                    </div>
                    <hr>
                </div>

                <h4>Check Proxy</h4>
                {if $checkProxy == 'yes'}
                    <a href='settings?do=checkproxy&s=0' class='btn btn-default'>Disable check proxy</a>
                {else}
                    <a href='settings?do=checkproxy&s=1' class='btn btn-default'>Enable check proxy</a>
                {/if}

                <h4>Claim</h4>
                {if $claimStatus == 'yes'}
                    <a href='settings?do=claim&s=0' class='btn btn-default'>Disable claim</a>
                {else}
                    <a href='settings?do=claim&s=1' class='btn btn-default'>Enable claim</a>
                {/if}

            </div>
        </div>
    </div>
    {include file='admin/footer.tpl'}
</body>
</html>
