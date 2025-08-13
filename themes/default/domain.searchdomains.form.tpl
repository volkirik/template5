<br>

<form action="{$php_self}" method="post">
<table class="searchForm"  align="center" width="100%" cellpadding=10 cellspacing=10>
    <tr>
        <td valign="top">
            <div><h1 style="color: #F0A82A;">1</h1>Enter up to 10 desired domain names:</div>
            <div><br>www.<br>&nbsp; &nbsp;<textarea name="domains_list" class="search"></textarea></div>
            <div>
                <br>Enter each domain on one line,<br> or seperated by commas.<br>
                i.e. my-domain,testdomain
            </div>
        </td>
        <td>
            <div>
                <h1 style="color: #F0A82A;">2</h1>Choose the domain extension(s):
            </div>
            <div><br>
                {section name=tld loop=$rs}
                    <input class="checkBox" type=checkbox name=gtlds[] value="{$rs[tld][0]}"> {$rs[tld][1]} <br><br>
                {/section}
            </div>
        </td>
        <td valign="top">
            <div><h1 style="color: #F0A82A;">3</h1></div>
            <div style="width: 150px;" align="center"><br>
                        {if !isset($IS_ADMIN) || $IS_ADMIN == false}
      <img src="{$RELA_DIR}common/Captcha/displayCaptcha.php">
      <br>Enter Captcha;<br>
              <input type="text" name="keystring">
        <font color="#FF0000">*</font><br>
        {/if}
                <input type=submit name="Search" value="Search">
                <input type=hidden name="action" value="checkDomains">
            </div>
        </td>        
    </tr>
</table>
</form>
