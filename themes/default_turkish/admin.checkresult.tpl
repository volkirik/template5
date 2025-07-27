<br>

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td height="25" colspan="2">
            <b>
                {if $result == 1}
                    Aşağıdaki alan adı kullanılabilir değil
                {else}
                    Aşağıdaki alan adı kullanılabilir
                {/if}
            </b><br>
            <br>
            <form action="{$php_self}" method="post" style="margin:0px">
                <input type="hidden" name="action" value="selectMember">
                <input type="hidden" name="domain" value="{$domain}">
                <input type="hidden" name="gtld" value="{$gtld}">
                <table width="95%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="30" bgcolor="#EFEFEF" align="center">
                            {if $result == 1}
                                {$real_domain}
                            {else}
                                {$real_domain}
                                </td>
                                <td bgcolor="#EFEFEF">
                                    <input type="submit" name="Submit" value="Devam Et >>">
                            {/if}
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            <br>
            Daha fazla alan adı kontrolü yapmak isterseniz, lütfen aşağıdaki alan adını girin 
            ve Kontrol et düğmesine tıklayın.<br>
            <br>
        </td>
    </tr>
    <tr> 
        <td>
            <form action="{$php_self}" method="post" style="margin:0px">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td align="right" valign="middle">www.</td>
                        <td> 
                            <input type="text" name="domain" valign="middle">
                            <select name="gtld">
                                {section name=r loop=$rs}
                                    <option value="{$rs[r][0]}">{$rs[r][1]}</option>
                                {/section}
                            </select>
                        </td>
                        <td valign="middle"> 
                            <input type="submit" name="Submit" value="Kontrol Et" align="left">
                            <input type="hidden" name="action" value="checkDomain">
                        </td>
                    </tr>
                </table>
            </form>
            <p><br>
                <br>
                <b>Alan Adı Formatı: </b><br>
                Bir alan adı, büyük/küçük harf duyarlılığı olmayan İngilizce harfler, 
                rakamlar ve kısa çizgi içeren rastgele bir bileşimdir. Dize 67 karakteri aşamaz. 
                Kısa çizgi ('-') karakter dizisinin başında veya sonunda bulunamaz. 
                Örneğin, 'eat-at-joes.com' geçerli bir alan adıdır, '-eatatjoes.com' değildir.
            </p>
        </td>
    </tr>
</table>
<p>&nbsp;</p>

