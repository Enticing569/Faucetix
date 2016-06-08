<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index">{$faucetname} [Admin]</a>
        </div>

        {if isset($loggedin)}
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href='index'>Stats</a></li>
                <li><a href='settings'>Settings</a></li>
                <li><a href='banAddress'>Ban Address</a></li>
                <li><a href='adSettings'>Ad Settings</a></li>
                <li><a href='userList'>User List</a></li>
                <li><a href='logout'>Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
        {/if}
    </div><!-- /.container-fluid -->
</nav>
