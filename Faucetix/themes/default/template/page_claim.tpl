{include file='header.tpl' PAGE_TITLE=$lang.claim.title}
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
                <h1>{$lang.claim.solve_captcha}</h1><br />
                {if isset($verifykey)}
                    {if $verifykey != $user_claimtoken}
                        <div class="alert alert-danger" role="alert">{$lang.claim.claim_failed}</div>
                    {else}
                        {$spaceMiddle}<br /><br />
                        <form method='post' action='dashboard?c=1'>
                            <div class='form-group'>
                                <center><div class='g-recaptcha' data-sitekey='{$GCaptchaPubKey}'></div></center>
                            </div>
                            <input type='hidden' name='verifykey' value='{$claim_token}'/>
                            <input type='hidden' name='token' value='{$token}'/>                          
                            <button type='submit' class='btn btn-success'>{$lang.global.claim}</button>
                        </form>
                    {/if}
                {else}
                    <div class="alert alert-danger" role="alert">{$lang.global.system_abuse}</div>
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