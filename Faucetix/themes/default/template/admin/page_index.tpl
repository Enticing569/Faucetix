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
              <div class="row">
                <div class="col-md-12">
                  <h1>Faucet Admin</h1>
                  <h2>Stats</h2>
                  <hr>
                  
                  <div class="row">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-2" style="border-style: double;">
                      <h4>Users</h4>
                      <b>{$UsersCount}</b>
                    </div>
                    <br><br><br><br><br>
                    <div class="col-md-5">
                    </div>
                  </div>

                  <div class="col-md-6" style="border-style: double;">
                    <h3>All time</h3>
                    <div class="col-md-3">
                      <h4>Claims</h4>
                      <b>{$TotalClaims}</b>
                      <br>
                      BTC
                    </div>
                    <div class="col-md-3">
                      <h4>Claimed</h4>
                      <b>{$TotalReward}</b>
                      <br>
                      BTC
                    </div>
                    <div class="col-md-3">
                      <h4>Referral Payout</h4>
                      <b>{$TotalRefClaim}</b>
                      <br>
                      BTC
                    </div>
                    <div class="col-md-3">
                      <h4>Withdrawal</h4>
                      <b>{$TotalWithdraw}</b> BTC
                    </div>
                  </div>

                  <div class="col-md-6" style="border-style: double;">
                    <h3>Last 24 Hours</h3>
                    <div class="col-md-3">
                      <h4>Claims</h4>
                      <b>{$ClaimsLast24h}</b>
                      <br>
                      BTC
                    </div>
                    <div class="col-md-3">
                      <h4>Claimed</h4>
                      <b>{$ClaimedLast24h}</b>
                      <br>
                      BTC
                    </div>
                    <div class="col-md-3">
                      <h4>Referral Payout</h4>
                      <b>{$RefClaimedLast24h}</b>
                      <br>
                      BTC
                    </div>
                    <div class="col-md-3">
                      <h4>Withdrawal</h4>
                      <b>{$Withdraw24h}</b>
                      <br>
                      BTC
                    </div>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    {include file='admin/footer.tpl'}
</body>
</html>
