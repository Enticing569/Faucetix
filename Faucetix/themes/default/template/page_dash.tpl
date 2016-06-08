{include file='header.tpl'}
<body>
    {include file='navbar.tpl'}
    <div class="container">
        <div id="containertop">
            <div class="row">
                <div class="col-md-12"><center>{$spacetop}</center></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-3">
            <div id="advertising">
                <center>{$spaceleft}</center>
            </div>
        </div>
        <div class="col-md-6">
            <div class="well content">
                <h3>Address</h3>
                {$address}
                <h3>Balance</h3>
                {$balance} Satoshi<br><br>
                <a href='account' class='btn btn-primary'>Account/Stats/Withdraw</a><br /><br />
                <a href='logout' class='btn btn-danger'>Log Out</a><br /><br />
                {$spaceMiddle}<br /><br />
                {if $faucetActive == 'yes'}
                    {if $captcha == 1}
                        {if isset($error)}
                            {foreach $error as $reason}
                                <div class="alert alert-danger" role="alert">{$reason}</div>
                            {/foreach}
                        {else}
                            <h1>3. Your Claim</h1>
                            <div class="alert alert-success" role="alert">You've claimed successfully {$reward} Satoshi.<br />You can claim again in {$faucetTimer} minutes!</div>
                            {/if}
                        {elseif $timestamp >= $nextClaim}
                            {if ($minReward == $maxReward )&& ($faucetTimer == 0)}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Reward: {$minReward} Satoshi every time</div>
                        {elseif $minReward == $maxReward}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Reward: {$minReward} Satoshi every {$faucetTimer} minutes</div>
                        {elseif $faucetTimer == 0}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Rewards: {$minReward} to {$maxReward} Satoshi every time</div>
                        {else}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Rewards: {$minReward} to {$maxReward} Satoshi every {$faucetTimer} minutes</div>
                        {/if}


                        <h1>1. Claim</h1><br />
                        <form method='post' action='claim'>
                            <input type='hidden' name='verifykey' value='{$userClaimToken}'/>
                            <input type='hidden' name='token' value='{$token}'/>
                            <button type="submit" class='btn btn-success btn-lg'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span> Next</button>
                        </form>
                    {else}
                        <div class="alert alert-warning" role="alert">You have already claimed in the last {$faucetTimer} minutes.<br />You can claim again in {$timeLeft} minutes.<br /><a href="index.php">Refresh</a></div>
                        {/if}
                        {if $refPercent != 0}
                        <blockquote class="text-left">
                            <p>
                                Reflink: <code>{$siteURL}?ref={$address}</code>
                            </p>
                            <footer>Share this link with your friends and earn {$refPercent}% referral commission</footer>
                        </blockquote>
                    {/if}
                {else}
                    <div class="alert alert-danger" role="alert">Faucet disabled</div>
                {/if}
            </div>
        </div>
        <div class="col-md-3">
            <div id="advertising">
                <center>{$spaceright}</center>
            </div>
        </div>
    </div>
    {include file='footer.tpl'}
</body>
</html>