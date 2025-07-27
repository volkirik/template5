<br>
<span style="display:{$updateuserfund}">
<table width="60%" class=border1 align=center cellpadding=2 cellspacing=1>
    <tr><th colspan=3 align="center" class=cellBg>Domain Fiyatlandırması</th></tr>
    <tr>
        <td class=cellBg align="center">Domain Adı/Adları</td>
        <td class=cellBg align="center">Süre<br>(yıl)</td>
        <td class=cellBg align="center">Fiyatınız<br>($us)</td>
    </tr>
     {section name=i loop=$domains}
        <tr>
            <td align="right"> {$domains[i][0]}</td>
            <td align="center"> {$domains[i][1]}</td>
            <td align="center">$ {$domains[i][2]} </td>   
        </tr>
     {/section}
      
        <tr><td>&nbsp;</td>
            <td align="center"> Toplam:      </td>
            <td  align="center"> $ {$total} </td>
    
        </tr>
</table>
</span>

<br><br>
<center><b align="center" >Hesap Detayları</b></center><br>
 
 <!-- PayPal bilgilerini göster -->
<span style="display:{$pp}">
<table width="60%" align=center cellpadding=2 cellspacing=1>
        <tr>
            <td align="center" class=cellBg>PayPal</td>
       
            <td align="center" class=cellBg>{$pp_email}&nbsp;</td></span>
        </tr>
        <tr><td>&nbsp; </td></tr>
        <tr> 
            <td colspan=2 align="center">
                <form name="paypalForm"  action="https://{$pphost}/cgi-bin/webscr" method="post">
                <input type="image" src="https://{$pphost}/en_US/i/btn/x-click-but23.gif" name="submit">
                <input type="hidden" name="add" value="1">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="{$pp_gw_email}">
                <input type="hidden" name="item_name" value="{$item_name}">
                <input type="hidden" name="amount" value="{$total}">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="notify_url" value="{$notify_url}">
                <input type="hidden" name="return" value="{$return}">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="cancel_return" value="{$cancel_return}">
                <input type="hidden" name="bn" value="PP-ShopCartBF">
                </form>
            </td>
        </tr>
        
 </table>   
 </span>
 
 <!-- Kredi Kartı bilgilerini göster -->
 <span style="display:{$cc}">
    <table width="60%"  class=border1 align=center cellpadding=2 cellspacing=1>
    
        <tr> <td class=cellBg align="center" colspan=3> Kredi Kartı</td>     </tr>
        
        <tr> <td>Ad</td> <td>&nbsp;</td> <td align="right">{$cc_user}</td> </tr>
        
        <tr> <td>Kart</td> <td>&nbsp;</td> <td align="right">{$cc_name}</td> </tr>
        
        <tr> <td>Numara</td> <td>&nbsp;</td> <td align="right">{$cc_num}</td> </tr>
        <tr>
            <td>Adres</td> <td>&nbsp;</td> <td align="right">{$cc_addr}, {$cc_city}, {$cc_state}</td>
        </tr>
        <tr>
            <td>Posta Kodu</td> <td>&nbsp;</td> <td align="right">{$cc_zip}</td>
        </tr>
        <tr>
            <td>Telefon</td><td>&nbsp;</td> <td align="right">{$cc_tel}</td>
        </tr>
        <tr>
            <td>Faks</td><td>&nbsp;</td> <td align="right">{$cc_fax}</td>
        </tr>
        <tr>
            <td>E-posta</td><td>&nbsp;</td> <td align="right">{$cc_email}</td>
        </tr>    
        <tr><td align="center" colspan=3> 
        <form action="https://select.worldpay.com/wcc/purchase" method=POST>
            <input type=hidden name="instId" value="{$instId}">     
            <input type=hidden name="cartId" value="ecompf">    
            <input type=hidden name="amount" value="{$total}"> 
            <input type=hidden name="currency" value="USD"> 
            <input type=hidden name="desc" value="{$item_name}"> 
            <input type=hidden name="testMode" value="{$testmode}"> 
            <input name="hideCurrancy" type="hidden">
            <input name="fixContact" type="hidden">
            <input type=hidden name="name" value="{$cc_user}"> 
            <input type=hidden name="address" value="{$cc_addr}, {$cc_city}, {$cc_state}"> 
            <input type=hidden name="postcode" value="{$cc_zip}"> 
            <input type=hidden name="country" value="{$cc_country}"> 
            <input type=hidden name="tel" value="{$cc_tel}"> 
            <input type=hidden name="fax" value="{$cc_fax}"> 
            <input type=hidden name="email" value="{$cc_email}"> 
             
           {*if $paid_status == 'paid'*}
           {if $updateuserfund == 'none'}
            <input type=hidden name="MC_updateuserfund" value="yes"> 
           {/if}     
            <input type=hidden name="MC_selected_user" value="{$selected_user}">
            <input type=submit value="Hemen Al"> 
        </form>
        </td></tr>
    </table>
</span>
<br>

<!--
    <span style="display:'{$pp}'">
    <table width="60%"  class=border1 align=center cellpadding=2 cellspacing=1>
    <form name="paypalForm" target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

        <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/x-click-but23.gif" name="submit">
        <input type="hidden" name="add" value="1">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="{$pp_gw_email}">
        <input type="hidden" name="item_name" value="{$item_name}">
        <input type="hidden" name="amount" value="{$total}">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="notify_url" value="http://140.99.35.174/~develop/template3/test.php">
        <input type="hidden" name="return" value="http://140.99.35.174/~develop/template3/domain/domainsearch.php?action=paymentResult">
        <input type="hidden" name="rm" value="2">
        <input type="hidden" name="cancel_return" value="http://140.99.35.174/~develop/template3/domain/domainsearch.php">
    </form>
    </table>
    </span> 
-->
