<br>
<form method=POST action={$PHP_SELF}>
<table class="searchForm" align=center cellpadding=2 cellspacing=1>
    <tr>
        <td class=cellBg align="center">Alan Adı(ları)</td>
        <td class=cellBg align="center">Süre<br>(yıl)</td>
        <td class=cellBg align="center">Fiyatınız<br>($us)</td>
        <td class=cellBg align="center">&nbsp;</td>
    </tr>
    {section name=i loop=$domains}
        <tr>
            <td align="right"> {$domains[i][0]}</td>
            <td align="center">
                <select name="yrs[]" >
                     <option value={$domains[i][1]} selected>{$domains[i][1]} </option>
                     <option value=1>1 </option>
                     <option value=2>2 </option>
                     <option value=3>3 </option>
                     <option value=4>4 </option>
                     <option value=5>5 </option>
                   {if $domains[i][3] == 0}  
                     <option value=6>6 </option>
                     <option value=7>7 </option>
                     <option value=8>8 </option>
                     <option value=9>9 </option>
                     <option value=10>10 </option>
                   {/if}
                </select>
            </td>
            <td align="center">
                {$domains[i][2]}
            </td>
            <td><a href={$PHP_SELF}?action=remDomain&name={$domains[i][0]}> &laquo; kaldır</td>
        <tr>
        <tr><td colspan=4><hr></td></tr>
    {/section}
    <tr><td>&nbsp;</td>
        <td align="right"> Toplam:      </td>
         <td  align="center"> $ {$total}
        </td>
    
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td> &nbsp;</td>
        <td> <input type="submit" name="recalculate" value="Yeniden Hesapla">      </td>
        <td align="right" colspan=2> 
            <input type=hidden name=action value="fromAddDomain">
            <input type=submit name=proceed value="Satın Almaya Devam Et">
        </td>
    </tr>
</table>
</form>

