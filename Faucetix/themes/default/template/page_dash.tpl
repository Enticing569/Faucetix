{include file='header.tpl' PAGE_TITLE=$lang.dash.title}
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
                <h3>{$lang.global.address}</h3>
                {$address}
                <h3>{$lang.global.balance}</h3>
                {$balance} {$lang.global.satoshi}<br><br>
                <a href='account' class='btn btn-primary'>{$lang.dash.account_stats_withdraw}</a><br /><br />
                <a href='logout' class='btn btn-danger'>{$lang.global.logout}</a><br /><br />
                {$spaceMiddle}<br /><br />
                {if $faucetActive == 'yes'}
                    {if $captcha == 1}
                        {if isset($error)}
                            {foreach $error as $reason}
                                <div class="alert alert-danger" role="alert">{$reason}</div>
                            {/foreach}
                        {else}
                            <h1>{$lang.dash.your_claim}</h1>
                            {assign "reward_timer2replace" array('%REWARD%', '%TIMER%')}
                            {assign "reward_timer4replace" array($reward, $faucetTimer)}
                            <div class="alert alert-success" role="alert">{$lang.dash.claim_success|replace:$reward_timer2replace:$reward_timer4replace}</div>
                        {/if}
                    {elseif $timestamp >= $nextClaim}
                        {if ($minReward == $maxReward )&& ($faucetTimer == 0)}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> {$lang.dash.possibility_1|replace:'%REWARD%':$minReward}</div>
                        {elseif $minReward == $maxReward}
                            {assign "possibility2_2replace" array('%REWARD%', '%TIMER%')}
                            {assign "possibility2_4replace" array($minReward, $faucetTimer)}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> {$lang.dash.possibility_1|replace:$possibility2_2replace:$possibility2_4replace}</div>
                        {elseif $faucetTimer == 0}
                            {assign "possibility3_2replace" array('%MIN_REWARD%', '%MAX_REWARD%')}
                            {assign "possibility3_4replace" array($minReward, $maxReward)}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> {$lang.dash.possibility_3|replace:$possibility3_2replace:$possibility3_4replace}</div>
                        {else}
                            {assign "possibility4_2replace" array('%MIN_REWARD%', '%MAX_REWARD%', '%TIMER%')}
                            {assign "possibility4_4replace" array($minReward, $maxReward, $faucetTimer)}
                            <div class="alert alert-success" role="alert"><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> {$lang.dash.possibility_4|replace:$possibility4_2replace:$possibility4_4replace}</div>
                        {/if}


                        <h1>{$lang.dash.claim}</h1><br />
                        <form method='post' action='claim'>
                            <input type='hidden' name='verifykey' value='{$userClaimToken}'/>
                            <input type='hidden' name='token' value='{$token}'/>
                            <button type="submit" class='btn btn-success btn-lg'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span> {$lang.global.next}</button>
                        </form>
                    {else}
                        {assign "alreadyClaimed_2replace" array('%TIMER%', '%TIMELEFT%')}
                        {assign "alreadyClaimed_4replace" array($faucetTimer, $timeLeft)}
                        <div class="alert alert-warning" role="alert">{$lang.dash.already_claimed|replace:$alreadyClaimed_2replace:$alreadyClaimed_4replace}</div>
                        {/if}
                        {if $refPercent != 0}
                        <blockquote class="text-left">
                            <p>
                                {$lang.dash.reflink} <code>{$siteURL}?ref={$address}</code>
                            </p>
                            <footer>{$lang.dash.share_reflink|replace:'%PERCENT%':$refPercent}</footer>
                        </blockquote>
                    {/if}
                {else}
                    <div class="alert alert-danger" role="alert">{$lang.dash.faucet_disabled}</div>
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