<br>
<form action="{$content_action}" method="post">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    
{if $message != ""}

    <tr> 
      <td width="25%" height="25" colspan="2"> 
        <div style="border:solid 1px #FF0000;padding:5px"> <font class="p8"><b> 
          {$message}
          </b></font> </div>
      </td>
    </tr>
{/if}
    <tr bgcolor="#EFEFEF"> 
      <td width="30%" height="25">&nbsp;<b>Ad</b></td>
      <td width="70%" height="25" bgcolor="#EFEFEF"> 
        {$admin_name}
      </td>
    </tr>
    <tr bgcolor="#EFEFEF"> 
      <td width="30%" height="25">&nbsp;<b>Departman</b></td>
      <td width="70%" height="25"> 
        {$admin_dept}
      </td>
    </tr>
    <tr bgcolor="#EFEFEF"> 
      <td height="25">&nbsp;<b>Eklenme Zamanı</b></td>
      <td height="25"> 
       {$add_time}
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b>Yönetici Görevi</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border1">
		{section name=list loop=$rs}
          <tr> 
            <td width="10%" height="25" align="center"> 
              <input type="checkbox" name="task_id[]" value="{$rs[list][0][0]}" {$rs[list][1]}>
            </td>
            <td width="90%" height="25"> {$rs[list][0][1]}</td>
          </tr>
{/section}
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
        <input type="submit" name="Submit" value="Yönetici Görevini Ayarla">
        <input type="hidden" name="action" value="setAdminTask">
        <input type="hidden" name="admin_id" value="{$admin_id}">
        <input type="hidden" name="currentPage" value="{$current_page}">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>

