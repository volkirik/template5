<script language="javascript">
{ $function_doDelete}
</script>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
      <form style="margin:0px">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
          <tr class="fieldName"> 
            <td height="20"><b><font color="#FFFFFF">&nbsp;Giriş ID</font></b></td>
            <td height="20"><b><font color="#FFFFFF">&nbsp;Ad</font></b></td>
            <td height="20"><b><font color="#FFFFFF">&nbsp;Departman</font></b></td>
            <td height="20"><b><font color="#FFFFFF">&nbsp;Durum</font></b></td>
            <td height="20"><b><font color="#FFFFFF">&nbsp;İşlem</font></b></td>
        </tr>
    {section name=name loop=$rs}		
		<tr>
          <td height="20" {$rs[name][1]}>
            &nbsp;{$rs[name][0][0]}
          </td>
          <td height="20" class="p8"{$rs[name][1]}>
            &nbsp;{$rs[name][0][1]}
          </td>
          <td height="20" class="p8"{$rs[name][1]}>
            &nbsp;{$rs[name][0][2]}
          </td>
          <td height="20" class="p8"{$rs[name][1]}>
		{if $rs[name][0][5] == 0}
			&nbsp;<font color="#0000FF">Başla</font>
		{else}
			&nbsp;<font color="#FF0000">Durdur</font>
		{/if}
          </td>
          <td height="20" class="p8"{$color}>
            <a href="{$php_self}?action=showModifyForm&currentPage={$currentPage}&admin_id={$rs[name][0][0]}"><img src="{$RELA_DIR}templates/{$CURRENT_SKIN}/images/modify.gif" border="0" alt="Düzenle"></a>&nbsp;
            <a href="{$php_self}?action=deleteAdmin&currentPage={$currentPage}&admin_id={$rs[name][0][0]}" onClick="return doDelete()"><img src="{$RELA_DIR}templates/{$CURRENT_SKIN}/images/delete.gif" border="0" alt="Sil"></a>&nbsp;
            <a href="{$php_self}?action=showSetTask&currentPage={$currentPage}&admin_id={$rs[name][0][0]}"><img src="{$RELA_DIR}templates/{$CURRENT_SKIN}/images/lock.gif" border="0" alt="Erişim ayarı"></a>
          </td>
        </tr>
    {/section}
		<tr> 
          <td height="20" bgcolor="#CCCCCC" colspan="5">
		  {$pagebutton}
          </td>
        </tr>
		    </table>
      <table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
        <tr>
            <td align="center"><br>
      <input type="hidden" name="transation" value="{$transation}">
      <input type="button" name="new" value="Yeni Yönetici" onClick="document.location.href='{$php_self}?action=showAddForm'">
            </td>
          </tr></table>
      </form>
      
    </td>
  </tr>
</table>
<p>&nbsp;</p>

