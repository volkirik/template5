<br>
<form action="{$php_self}" method="post">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b>Yeni alan adı</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border1">

{if $r_count == 0}
          <tr> 
            <td width="10%" height="25" align="center">&nbsp; 

            </td>
            <td width="90%" height="25">
              <font color="#FF0000">Şu anda seçilebilecek yeni alan adı bulunmamaktadır.</font>
            </td>
          </tr>
{else}

    {section name=test loop=$res}
          <tr> 
            <td width="10%" height="25" align="center"> 
              <input type="radio" name="product_id" value="{$res[test][0]}">
            </td>
            <td width="90%" height="25">
             {$res[test][1]}
            </td>
          </tr>
	{/section}
{/if}
        </table>
      </td>
    </tr>
    <tr> 
      <td width="30%" height="25">&nbsp;</td>
      <td width="70%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td width="30%" height="25">&nbsp;</td>
      <td width="70%" height="25"> 
        <input type="submit" name="Submit" value="Alan adı yükselt">
        <input type="hidden" name="action" value="upgradeDomain">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>

