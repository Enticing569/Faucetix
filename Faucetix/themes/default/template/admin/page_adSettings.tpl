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
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="well content">
                <h1>Faucet Admin</h1>
                <h2>Ad Settings</h2><hr />
                {if isset($error)}
                    {foreach $error as $reason}
                        <div class="alert alert-danger" role="alert">{$reason}</div>
                    {/foreach}
                {/if}
                {if isset($success)}
                    {foreach $success as $message}
                        <div class="alert alert-success" role="alert">{$message}</div>
                    {/foreach}
                {/if}
                <form method='post' action='adSettings'>
                    <h4>Ad Center Top:</h4>
                    <textarea class='form-control' cols='65' rows='10' name='adCenterTop'>{$adCenterTop}</textarea><br />
                    <h4>Ad Right:</h4>
                    <textarea class='form-control' cols='65' rows='10' name='adRight'>{$adRight}</textarea><br />
                    <h4>Ad Left:</h4>
                    <textarea class='form-control' cols='65' rows='10' name='adLeft'>{$adLeft}</textarea><br />
                    <h4>Ad Middle:</h4>
                    <textarea class='form-control' cols='65' rows='10' name='adMiddle'>{$adMiddle}</textarea><br />
                    <h4>Ad Footer:</h4>
                    <textarea class='form-control' cols='65' rows='10' name='adFooter1'>{$adFooter1}</textarea><br />
                    <textarea class='form-control' cols='65' rows='10' name='adFooter2'>{$adFooter2}</textarea><br />
                    <textarea class='form-control' cols='65' rows='10' name='adFooter3'>{$adFooter3}</textarea><br />
                    <textarea class='form-control' cols='65' rows='10' name='adFooter4'>{$adFooter4}</textarea><br />
                    <textarea class='form-control' cols='65' rows='10' name='adFooter5'>{$adFooter5}</textarea><br />
                    <button type='submit' class='btn btn-success btn-lg'>Save</button>
                </form>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    {include file='admin/footer.tpl'}
</body>
</html>