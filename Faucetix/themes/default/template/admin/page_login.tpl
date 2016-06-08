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
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="well content">
                <h2>Faucet Admin</h2>
                <h4>Enter your username and password to manage your faucet!</h4>
                {if isset($error)}
                    {foreach $error as $reason}
                        <div class="alert alert-danger" role="alert">{$reason}</div>
                    {/foreach}
                {/if}
                <form method='post' action='login'>
                    <div class='form-group {$alertForm}'>
                        <label>Username</label>
                        <center><input class='form-control' type='text' name='username' style='width: 225px;' placeholder='Type your username'></center>
                    </div>

                    <div class='form-group  {$alertForm}'>
                        <label>Password</label>
                        <center><input class='form-control' type='password' name='password' style='width: 225px;' placeholder='Type your password'></center>
                    </div>
                    <button type='submit' class='btn btn-primary'>Log In</button>
                </form>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    {include file='admin/footer.tpl'}
</body>
</html>