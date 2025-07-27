<br>

<table align="center" cellpadding="2" cellspacing="1">
    <tr><td><b>
        {if $paid_status == 'paid'} 
            Ödeme başarıyla tamamlandı!</b><br> İşlemi tamamlamak için Devam'a tıklayın. 
            </td> </tr><tr><td>&nbsp;</td> </tr>

            <form action="{$php_self}" method="POST">
                <tr><td align="center">
                    <input type="submit" name="submit" value="Devam">
                    <input type="hidden" name="action" value="initDomainRegistration">
                </td></tr>
            </form>
        {else}
            Ödeme başarısız! </b><br><br> Durum: {$paid_status}
            </td> </tr><tr><td>&nbsp;</td> </tr>

            <form action="{$php_self}" method="POST">
                <tr><td align="center">
                    <input type="submit" name="submit" value="Devam">
                </td></tr>
            </form>
        {/if}
</table>

