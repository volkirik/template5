<br>

<form action="{$php_self}" method="post">
<table class="searchForm" align="center" width="100%" cellpadding=10 cellspacing=10>
    <tr>
        <td valign="top">
            <div><h1 style="color: #F0A82A;">1</h1>İstediğiniz 10 alan adını girin:</div>
            <div><br>www.<br>&nbsp; &nbsp;<textarea name="domains_list" class="search"></textarea></div>
            <div>
                <br>Her alan adını bir satıra girin,<br> veya virgüllerle ayırarak yazın.<br>
                örn. my-domain,testdomain
            </div>
        </td>
        <td>
            <div>
                <h1 style="color: #F0A82A;">2</h1>Alan adı uzantısını(ları) seçin:
            </div>
            <div><br>
                {section name=tld loop=$rs}
                    <input class="checkBox" type=checkbox name=gtlds[] value="{$rs[tld][0]}"> {$rs[tld][1]} <br><br>
                {/section}
            </div>
        </td>
        <td valign="top">
            <div><h1 style="color: #F0A82A;">3</h1></div>
            <div style="width: 140px;" align="center"><br>
            {if $CAPTCHA_ENABLE == 1 && (!isset($IS_ADMIN) || $IS_ADMIN == false) }
      <img src="{$RELA_DIR}common/Captcha/displayCaptcha.php">
      <br>Captcha giriniz;<br>
              <input type="text" name="keystring">
        <font color="#FF0000">*</font><br>
        {/if}
                <input type=submit name="Search" value="Ara">
                <input type=hidden name="action" value="checkDomains">
            </div>
        </td>        
    </tr>
</table>
</form>

