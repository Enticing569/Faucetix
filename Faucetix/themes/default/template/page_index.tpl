{include file='header.tpl' PAGE_TITLE=$lang.index.title}
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
                <h2>{$faucetname} {$lang.index.faucet}</h2>
                <h3>{$lang.index.enter_address_claim}</h3>
                {if isset($error)}
                    {foreach $error as $reason}
                        <div class="alert alert-danger" role="alert">{$reason}</div>
                    {/foreach}
                {/if}
                {$spaceMiddle}<br /><br />
                <form method='post' action='index'>
                    <!--<div class='form-group $alertForm' -->
                    <div class='form-group {$alertForm}'>
                        <label for='address'>{$lang.index.bitcoin_address}</label>
                        <center><input class='form-control' type='text' placeholder='{$lang.index.enter_address}' name='address' value='{$address}' style='width: 325px;'></center>
                    </div><br />
                    <button type="submit" class="btn btn-primary">Join</button>
                </form>
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