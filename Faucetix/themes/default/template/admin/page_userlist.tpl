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
                <h2>User List</h2><hr />
                <center>
                    <table class='table' style='text-align: center; width: 100%;' border='0' cellpadding='2' cellspacing='2'>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Address</td>
                                <td>User ID</td>
                                <td>Balance</td>
                                <td>Withdrawal</td>
                                <td>Ref Id</td>
                                <td>Last IP</td>
                                <td>Last Activity</td>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $userList as $row}
                                {assign var=i value=$i+1}
                                <tr>
                                    <td>{$i}</td>
                                    <td>{$row.address}</td>
                                    <td>{$row.id}</td>
                                    <td>{$row.balance}</td>
                                    <td>{$row.received}</td>
                                    <td>{$row.ref_id}</td>
                                    <td>{$row.last_ip}</td>
                                    <td>{$row.last_activity|timeAgo}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </div>
    {include file='admin/footer.tpl'}
</body>
</html>