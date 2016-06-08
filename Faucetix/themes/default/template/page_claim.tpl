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
                <h1>2. Solve Captcha</h1><br />
                {if isset($verifykey)}
                    {if $verifykey != $user_claimtoken}
                        <div class="alert alert-danger" role="alert">Claim failed. <a href="index">Go back</a></div>
                    {else}
                        {$spaceMiddle}<br /><br />
                        <form method='post' action='dashboard?c=1'>
                            <div class='form-group'>
                                <center><div class='g-recaptcha' data-sitekey='{$GCaptchaPubKey}'></div></center>
                            </div>
                            <input type='hidden' name='verifykey' value='{$claim_token}'/>
                            <input type='hidden' name='token' value='{$token}'/>                          
                            <button type='submit' class='btn btn-success'>Claim</button>
                        </form>
                    {/if}
                {else}
                    <div class="alert alert-danger" role="alert">Abusing the system is not allowed. <a href="index">Go back</a></div>
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