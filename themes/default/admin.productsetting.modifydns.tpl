<script language="javascript">
        function goBack(myForm)
        {$smarty.ldelim}
                myForm.action.value = "listProduct";
                myForm.submit();
        {$smarty.rdelim}
</script>
<br>
<form action="{$php_self}" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

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
            <td height="20" width="30%" bgcolor="#E1ECFB"><b>Product ID</b></td>
            <td height="20" width="70%" bgcolor="#F2F8FD"> 
             {$product_id}
            </td>
          </tr>
          <tr> 
            <td height="20" width="30%" bgcolor="#E1ECFB"><b>Product Name</b></td>
            <td height="20" width="70%" bgcolor="#F2F8FD"> 
             {$product_name }
            </td>
          </tr>
          <tr> 
            <td height="20" width="30%" bgcolor="#E1ECFB"><b>Product Type</b></td>
            <td height="20" width="70%" bgcolor="#F2F8FD"> 

{ if $product_type == 1}
     Domain
{elseif $product_type == 2}
	Hosting
{elseif $product_type == 3}
    Postoffice
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
      <td colspan="2" height="25"><b>Default DNS</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="5" cellpadding="0" class="border1">
          <tr> 
            <td width="22%" height="25" align=right>1st DNS</td>
            <td width="28%" height="25"> 
              <input type="text" name="dns1" value="{$default_dns1}">
            </td>
            <td width="22%" height="25" align=right>2nd DNS</td>
            <td width="28%" height="25"> 
              <input type="text" name="dns2" value="{$default_dns2}">
            </td>
          </tr>
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
        <input type="submit" name="Submit" value="Modify default DNS" >
        <input type="hidden" name="action" value="modifyDNS">
        <input type="hidden" name="product_id" value="{$product_id}">
        <input type="hidden" name="currentPage" value="{$currentPage}">
<!--	<a href="{$RELA_DIR}/admin/productSetting.php"> &nbsp;&nbsp;Back </a>-->
	<input type="button" name="back" value="Back" onClick="goBack(this.form);">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
