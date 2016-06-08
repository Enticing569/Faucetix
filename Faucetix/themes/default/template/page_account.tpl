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
                <h1>Account</h1>
                <h3>Address</h3>
                {$address}
                <h3>Balance</h3>
                {$balance} Satoshi<br><br>
                {$resultHTML}
                {$spaceMiddle}<br /><br />
                {if $balance >= $minWithdraw}
                    <form method='post' action='?withdraw=true'>
                        <input type='hidden' name='token' value='{$token}'/><button type='submit' class='btn btn-primary'>Withdraw to FaucetBOX</button>
                    </form>
                {else}
                    <a href='#' class='btn btn-danger'>Withdraw is not avaible.</a>
                {/if}
                <br /><br />
                <h3>Stats</h3>
                <div class='row'>
                    <div class='col-md-12'>
                        <h3>All time</h3>
                    </div>
                    <div class='col-md-4'>
                        <h4>Total Claims</h4>
                        <b>{$TotalClaims}</b>
                    </div>
                    <div class='col-md-4'>
                        <h4>Total Claimed</h4>
                        <b>{$TotalReward}</b><br />Satoshi
                    </div>
                    <div class='col-md-4'>
                        <h4>Total Referral Payout</h4>
                        <b>{$TotalRefClaim}</b><br />Satoshi
                    </div>
                    <div class='col-md-12'>
                        <h3>Last 24 Hours</h3>
                    </div>
                    <div class='col-md-4'>
                        <h4>Claims</h4>
                        <b>{$ClaimsLast24h}</b>
                    </div>
                    <div class='col-md-4'>
                        <h4>Claimed</h4>
                        <b>{$ClaimedLast24h}</b><br />Satoshi
                    </div>
                    <div class='col-md-4'>
                        <h4>Total Referral Payout</h4>
                        <b>{$RefClaimedLast24h}</b><br />Satoshi
                    </div>
                </div>
                <h3>Last 15 Transactions</h3>
                <center>
                    <table class='table' style='text-align: center; width: 100%;'border='0' cellpadding='2' cellspacing='2'>
                        <thead>
                            <tr>
                                <td>Type</td>
                                <td>Amount</td>
                                <td>Time</td>
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