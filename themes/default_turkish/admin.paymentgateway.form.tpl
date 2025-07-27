<br>
<form action="{$php_self}" method=POST>
<table class="border1" align="center" cellpadding=2 cellspacing=2>
    
    <tr> <td class="cellTitleBg" colspan=2 align="center"> Paypal </td> </tr>
    <tr><td class="cellBg" colspan=2 >&nbsp</td></tr>
    <tr>
        <td class="cellBg"> Paypal e-posta </td>
        <td class="cellBg2">
            <input type="text" name="pp_email" value="{$pp_email}">
        </td>
    </tr>
    <tr>
        <td class="cellBg"> Test modunu etkinleştir </td>
        <td class="cellBg2">
            &nbsp;<input type="checkbox" name="pptestmode" value="enabled" {$pptestmode}>
        </td>
    </tr>
    <tr><td class="cellBg" colspan=2 >&nbsp</td></tr>
    <tr>
        <td class="cellTitleBg" colspan=2 align="center">
             WorldPay
        </td>
    </tr>
    <tr><td class="cellBg" colspan=2 >&nbsp</td></tr>
    <tr>
        <td class="cellBg"> Kurulum Kimliği </td>
        <td class="cellBg2">
            <input type="text" name="instId" value="{$instId}">
        </td>
    </tr>
    <tr>
        <td class="cellBg"> Geri Arama Şifresi </td>
        <td class="cellBg2">
            <input type="text" name="callbackPW" value="{$callbackPW}">
        </td>
    </tr>
    <tr>
        <td class="cellBg"> Test modunu etkinleştir </td>
        <td class="cellBg2">
            &nbsp;<input type="checkbox" name="wptestmode" value="enabled" {$wptestmode}>
        </td>
    </tr>
    <tr><td class="cellBg" colspan=2 >&nbsp</td></tr>
    <tr>
        <td class="cellBg" colspan=2 align="center">
            <input type="submit" name="submit" value="Ayarları Kaydet">
            <input type="hidden" name="action" value="updateSettings">
        </td>
    </tr>
</table>
</form>

