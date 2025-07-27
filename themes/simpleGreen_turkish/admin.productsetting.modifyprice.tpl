<script language="javascript">
function changePrice(theForm, theType, theLevel)
{$smarty.ldelim}
    
	if(theType == 1)
	{$smarty.ldelim}
		for(i = 2; i < 11; i ++)
		{$smarty.ldelim}
			var myVar = "reg_prices" + i + theLevel;
			var myFirstVar = "reg_prices1" + theLevel;
			theForm[myVar].value = theForm[myFirstVar].value * i;
		 {$smarty.rdelim}
	 {$smarty.rdelim} else {$smarty.ldelim}
		for(i = 2; i < 11; i ++)
		{$smarty.ldelim}
			var myVar = "rew_prices" + i + theLevel;
			var myFirstVar = "rew_prices1" + theLevel;
			theForm[myVar].value = theForm[myFirstVar].value * i;
		 {$smarty.rdelim}
	 {$smarty.rdelim}
 {$smarty.rdelim}
</script>
<br>
<form action="{$php_self}" method="post">
  <table width="80%"  cellspacing="0" cellpadding="0" align="center" class="border1">
    
{if $message != ""}

    <tr> 
      <td width="25%" height="25" colspan="2"> 
        <div style="border:solid 1px #FF0000;padding:5px"> <font class="p8"><b> 
        {$message}
          </b></font> </div>
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25" colspan="2">&nbsp;</td>
    </tr>
{/if}
    <tr> 
      <td width="25%" height="25" colspan="2"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="border1">
          <tr> 
            <td height="20" width="30%" bgcolor="#E1ECFB"><b>ID</b></td>
            <td height="20" width="70%" bgcolor="#F2F8FD"> 
               {$product_id}
            </td>
          </tr>
          <tr> 
            <td height="20" width="30%" bgcolor="#E1ECFB"><b>Ürün Adı</b></td>
            <td height="20" width="70%" bgcolor="#F2F8FD"> 
              {$product_name}
            </td>
          </tr>
          <tr> 
            <td height="20" width="30%" bgcolor="#E1ECFB"><b>Ürün Tipi</b></td>
            <td height="20" width="70%" bgcolor="#F2F8FD"> 
           
{if $product_type == 1}

    Alan Adı
{elseif $product_type == 2}
	Barındırma
{elseif $product_type == 3}
	Posta Ofisi
{/if}
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b>Kayıt Ücretleri</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="border1">
          <tr align="center" bgcolor="#EFEFEF"> 
            <td width="16%" height="20">Yıl/Seviye</td>
            <td height="20" width="16%">0</td>
            <td height="20" width="16%">1</td>
            <td height="20" width="16%">2</td>
            <td height="20" width="16%">3</td>
            <td height="20" width="16%">4</td>
          </tr>
		  {$reg_prices}
		       </table>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b>Silme Ücreti</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" class=border1 cellspacing="1" cellpadding="0" >
          <tr align="center" bgcolor="#EFEFEF"> 
            <td width="16%" height="20">Seviye</td>
            <td height="20" width="16%">0</td>
            <td height="20" width="16%">1</td>
            <td height="20" width="16%">2</td>
            <td height="20" width="16%">3</td>
            <td height="20" width="16%">4</td>
          </tr>
	<tr>
	{$del_prices}
     </tr>

        </table>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b>Yenileme Ücretleri</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="border1">
          <tr align="center" bgcolor="#EFEFEF"> 
            <td width="16%" height="20">Yıl/Seviye</td>
            <td height="20" width="16%">0</td>
            <td height="20" width="16%">1</td>
            <td height="20" width="16%">2</td>
            <td height="20" width="16%">3</td>
            <td height="20" width="16%">4</td>
          </tr>
		  {$new_prices}
        </table>
      </td>
    </tr>
     <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>

    <tr> 
      <td colspan="2" height="25"><b>Alan Adı Senkronizasyon Ücreti</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" class=border1 cellspacing="1" cellpadding="0">
            <tr align="center" bgcolor="#EFEFEF"> 
                <td  height="20">Seviye</td>
                <td height="20" >0</td>
                <td height="20" >1</td>
                <td height="20" >2</td>
                <td height="20" >3</td>
                <td height="20" >4</td>
            </tr>
	        <tr>
                {$sync_prices}
            </tr>
        </table>
      </td>
    </tr>
    
    <tr> 
      <td width="30%" height="25">&nbsp;</td>
      <td width="70%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td  height="25" align="center" colspan=2> 
        <input type="submit" name="Submit" value="Fiyatı Düzenle">
        <input type="hidden" name="action" value="modifyPrice">
        <input type="hidden" name="product_id" value="{$product_id}">
        <input type="hidden" name="currentPage" value="{$currentPage}">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>

