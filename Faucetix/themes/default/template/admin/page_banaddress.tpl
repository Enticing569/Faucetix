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
                <h1>Faucet Admin</h1>
                <h2>Ban Address</h2>
                {if isset($success)}
                    {foreach $success as $message}
                        <div class="alert alert-success" role="alert">{$message}</div>
                    {/foreach}
                {/if}
                {if isset($error)}
                    {foreach $error as $reason}
                        <div class="alert alert-danger" role="alert">{$reason}</div>
                    {/foreach}
                {/if}
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <h3>Add Address to ban</h3>
                      <p>Please enter for each line a Bitcoin Address.</p>
                      <form method='post' action='banAddress?do=ban'>
                          <textarea class='form-control' cols='65' rows='10' name='addresses'></textarea><br />
                          <button type='submit' class='btn btn-success btn-lg'>Add to the blacklist</button>
                      </form>
                    </div>

                    <div class="col-md-6">
                      <h3>Show banned Address/Remove Address</h3>
                      <div id='banlist'>
                          <table class='table' style='text-align: left; width: 100%;' cellpadding='2' cellspacing='2'>
                              <thead>
                                  <tr>
                                      <td>#</td>
                                      <td>Bitcoin Address</td>
                                      <td>Actions</td>
                                  </tr>
                              </thead>
                              <tbody>
                                  {foreach $bannedAddress as $banned}
                                  <tr>
                                      <td>{$banned.id}</td>
                                      <td>{$banned.address}</td>
                                      <td><a href='banAddress?do=unban&id={$banned.id}'>Delete</a></td>
                                  </tr>
                                  {/foreach}
                              </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    {include file='admin/footer.tpl'}
</body>
</html>
