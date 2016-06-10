{include file='header.tpl' PAGE_TITLE=$lang.account.title}
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
                <h1>{$lang.account.title}</h1>
                <h3>{$lang.global.address}</h3>
                {$address}
                <h3>{$lang.global.balance}</h3>
                {$balance} {$lang.global.satoshi}<br><br>
                {$resultHTML}
                {$spaceMiddle}<br /><br />
                {if $balance >= $minWithdraw}
                    <form method='post' action='?withdraw=true'>
                        <input type='hidden' name='token' value='{$token}'/><button type='submit' class='btn btn-primary'>{$lang.account.withdraw_faucetbox}</button>
                    </form>
                {else}
                    <a href='#' class='btn btn-danger'>{$lang.account.withdraw_unavailable}</a>
                {/if}
                <br /><br />
                <h3>{$lang.account.stats}</h3>
                <div class='row'>
                    <div class='col-md-12'>
                        <h3>{$lang.account.all_time}</h3>
                    </div>
                    <div class='col-md-4'>
                        <h4>{$lang.account.total_claims}</h4>
                        <b>{$TotalClaims}</b>
                    </div>
                    <div class='col-md-4'>
                        <h4>{$lang.account.total_claimed}</h4>
                        <b>{$TotalReward}</b><br />{$lang.global.satoshi}
                    </div>
                    <div class='col-md-4'>
                        <h4>{$lang.account.total_referral_payout}</h4>
                        <b>{$TotalRefClaim}</b><br />{$lang.global.satoshi}
                    </div>
                    <div class='col-md-12'>
                        <h3>{$lang.account.last24h}</h3>
                    </div>
                    <div class='col-md-4'>
                        <h4>{$lang.account.claims}</h4>
                        <b>{$ClaimsLast24h}</b>
                    </div>
                    <div class='col-md-4'>
                        <h4>{$lang.account.claimed}</h4>
                        <b>{$ClaimedLast24h}</b><br />{$lang.global.satoshi}
                    </div>
                    <div class='col-md-4'>
                        <h4>{$lang.account.total_referral_payout}</h4>
                        <b>{$RefClaimedLast24h}</b><br />{$lang.global.satoshi}
                    </div>
                </div>
                <h3>{$lang.account.last15transactions}</h3>
                <center>
                    <table class='table' style='text-align: center; width: 100%;'border='0' cellpadding='2' cellspacing='2'>
                        <thead>
                            <tr>
                                <td>{$lang.account.type}</td>
                                <td>{$lang.account.amount}</td>
                                <td>{$lang.account.time}</td>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $userTransaction as $row}

                                <tr>
                                    <td>{$row.type}</td>
                                    <td>{$row.amount}</td>
                                    <td>{$row.timestamp|timeAgo}</td>
                                </tr>

                            {/foreach}
                        </tbody>
                    </table>
                </center>
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