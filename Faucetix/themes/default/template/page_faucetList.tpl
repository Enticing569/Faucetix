{include file='header.tpl' PAGE_TITLE=$lang.faucetList.title}
<body>
    <style>
        #hot {
            padding: 2px 4px;
            font-size: 90%;
            color: white;
            background-color: #c62828;
            border-radius: 4px;
        }
        #new {
            padding: 2px 4px;
            font-size: 90%;
            color: white;
            background-color: #388e3c;
            border-radius: 4px;
        }
    </style>
    {include file='navbar.tpl'}
    <div class="container">
        <div id="containertop">
            <div class="row">
                <div class="col-md-12"><center>{$spacetop}</center></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-2">
            <div id="advertising">
                <center>{$spaceleft}</center>
            </div>
        </div>
        <div class="col-md-8">
            <div class="well content">
                <h2>{$lang.faucetList.title}</h2>
                <center>
                    <table class='table' style='text-align: center; width: 100%;'border='0' cellpadding='2' cellspacing='2'>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>{$lang.faucetList.faucet_name}</td>
                                <td>{$lang.faucetList.timer}</td>
                                <td>{$lang.faucetList.users}</td>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $json as $row}
                                {if $row.possibly_broken == '1'}
                                    {continue}
                                {/if}
                                {assign var=i value=$i+1}
                                <tr>
                                    <td>{$i}</td>
                                    <td>
                                        <a href="{$row.url}?r={$refAddress}" target='_blank'>{$row.name}</a>
                                        {if $row.hot == true}
                                            <span id="hot" title="{$lang.faucetList.hot_desc}">{$lang.faucetList.hot}</span>
                                        {/if}
                                        {if $row.new == '1'}
                                            <span id="new" title="{$lang.faucetList.new_desc}">{$lang.faucetList.new}</span>
                                        {/if}
                                    </td>
                                    <td>{$row.timer}</td>
                                    <td>{$row.users_per_day}</td>
                                </tr>

                            {/foreach}
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
        <div class="col-md-2">
            <div id="advertising">
                <center>{$spaceright}</center>
            </div>
        </div>
    </div>
    {include file='footer.tpl'}
</body>
</html>