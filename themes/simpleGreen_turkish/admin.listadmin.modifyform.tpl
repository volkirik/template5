<br>
<form action="{$content_action}" method="post">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <?php
{if $message != "" }

    <tr> 
      <td width="25%" height="25" colspan="2"> 
        <div style="border:solid 1px #FF0000;padding:5px"> <font class="p8"><b> 
          {$message}
          </b></font> </div>
      </td>
    </tr>
{/if}
    <tr> 
      <td width="30%" height="25">Ad</td>
      <td width="70%" height="25"> 
        <input type="text" name="admin_name" size="20" value="{$admin_name}">
      </td>
    </tr>
    <tr>
      <td width="30%" height="25">Departman</td>
      <td width="70%" height="25">
        <input type="text" name="admin_dept" size="20" value="{$admin_dept}">
      </td>
    </tr>
    <tr> 
      <td width="30%" height="25">Şifre</td>
      <td width="70%" height="25">
        <input type="password" name="admin_password" size="20" value="{$admin_password}">
      </td>
    </tr>
    <tr> 
      <td width="30%" height="25">Şifre Tekrarı</td>
      <td width="70%" height="25">
        <input type="password" name="admin_password1" size="20" value="{$admin_password1}">
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" height="25">

{if $init_admin_flag == 0 }
        <input type="checkbox" name="admin_flag" value="1">
{else}
	<input type="checkbox" name="admin_flag" value="1" checked>
{/if}
        Hesap devre dışı</td>
    </tr>
    <tr> 
      <td width="30%" height="25">&nbsp;</td>
      <td width="70%" height="25"> 
        <input type="submit" name="Submit" value="Yöneticiyi Düzenle">
        <input type="hidden" name="action" value="modifyAdmin">
        <input type="hidden" name="admin_id" value="{$admin_id}">
        <input type="hidden" name="currentPage" value="{$current_page}">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>

