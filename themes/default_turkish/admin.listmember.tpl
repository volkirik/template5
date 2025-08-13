<script language="javascript">
function doDelete()
{
	if(confirm("Bu üyeyi silmek istediğinize emin misiniz?"))
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<br>
<form action="{$php_self}" method="post" style="margin:0px">
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#E1ECFB" class="border1">
    <tr>
      <td> 
        <table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
          <tr> 
            <td align=center> Kayıt tarihi aralığı 
              <select name="startYear">
                <option>Yıl</option>
		
		{section name=yr loop=$iyear}
			{if $startYear == $iyear[yr]}

				<option value={$iyear[yr]} selected>{$iyear[yr]}
			{else}
				<option value={$iyear[yr]}>{$iyear[yr]}
			{/if}
		{/section}	
              </select>
              <select name="startMonth">
                <option>Ay</option>
               
				
		{section name=i loop=$imonth}
			{if $startMonth == $imonth[i]}

				<option value={$imonth[i]} selected>{$imonth[i]}
			{else}
				<option value={$imonth[i]}>{$imonth[i]}
			{/if}
		{/section}	

              </select>
              <select name="startDay">
                <option>Gün</option>
                

		{section name=i loop=$iday}
			{if $startDay == $iday[i]}
		
				<option value={$iday[i]} selected>{$iday[i]}
			{else}
				<option value={$iday[i]}>{$iday[i]}
			{/if}
		{/section}
		
              </select>
              - 
              <select name="toYear">
                <option>Yıl</option>

		{section name=yr loop=$iyear}
			{if $toYear == $iyear[yr]}
		
				<option value={$iyear[yr]} selected>{$iyear[yr]}
			{else}
				<option value={$iyear[yr]}>{$iyear[yr]}
			{/if}
		{/section}	
              </select>
              <select name="toMonth">
                <option>Ay</option>
     

		
		{section name=i loop=$imonth}
			{if $toMonth == $imonth[i]}
			
				<option value={$imonth[i]} selected>{$imonth[i]}
			{else}
				<option value={$imonth[i]}>{$imonth[i]}
			{/if}
		{/section}	
              </select>
              <select name="toDay">
                <option>Gün</option>
   

		{section name=i loop=$iday}
			{if $toDay == $iday[i]}
			<option value={$iday[i]} selected>{$iday[i]}
			{else}
				<option value={$iday[i]}>{$iday[i]}
			{/if}
		{/section}

              </select>
            </td>
          </tr>
        </table>
        <br>
        <table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
          <tr> 
            <td width="21%">Sıralama Kriteri:</td>
            <td width="10%"> 
              <select name="orders">

 {if $orders == 1 }

                <option value="1" selected>Üye Seviyesi</option>
                <option value="2">Alfabetik Sıra</option>
                <option value="3">Kayıt Tarihi</option>
{elseif $orders == 2}
                <option value="1">Üye Seviyesi</option>
                <option value="2" selected>Alfabetik Sıra</option>
                <option value="3">Kayıt Tarihi</option>
{elseif $orders == 3}
                <option value="1">Üye Seviyesi</option>
                <option value="2">Alfabetik Sıra</option>
                <option value="3" selected>Kayıt Tarihi</option>
{else}
                <option value="1" selected>Üye Seviyesi</option>
                <option value="2">Alfabetik Sıra</option>
                <option value="3">Kayıt Tarihi</option>
{/if}
              </select>
            </td>
            <td width="20%">Kullanıcı Adı: </td>
            <td width="24%"> 
              <input type="text" name="member_name" size="10" value="{$member_name}">
            </td>
            <td width="25%"> 
              <input type="submit" name="Submit" value="Sorgula">
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
<br>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
      <form style="margin:0px">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
          <tr class="fieldName"> 
            <td width="12%" height="20"><b><font color="#FFFFFF">&nbsp;ID</font></b></td>
            <td width="27%" height="20"><b><font color="#FFFFFF">&nbsp;Kullanıcı Adı</font></b></td>
            <td width="27%" height="20"><b><font color="#FFFFFF">&nbsp;Seviye</font></b></td>
            <td width="14%" height="20"><b><font color="#FFFFFF">&nbsp;Durum</font></b></td>
            <td width="20%" height="20"><b><font color="#FFFFFF">&nbsp;İşlem</font></b></td>
        </tr>

{if $rs}
    {section name=i loop=$rs}
        <tr>
          <td height="20" class="p8"{$rs[i][1]}>
            &nbsp;{$rs[i][0][0]}
          </td>
          <td height="20" class="p8"{$rs[i][1]}>
            &nbsp;{$rs[i][0][1]}
          </td>
          <td height="20" class="p8"{$rs[i][1]}>
            &nbsp;{$rs[i][0][4]}
          </td>
          <td height="20" class="p8"{$rs[i][1]}>

		{if $rs[i][0][3] == 0}
			&nbsp;<font color=\"#0000FF\">Aktif</font>
		{else}
			&nbsp;<font color=\"#FF0000\">Pasif</font>
		{/if}
          </td>
          <td height="20" class="p8"{$rs[i][1]}>
            <a href="{$php_self}?action=viewMemberInfo&currentPage={$currentPage}&member_id={$rs[i][0][0]}"><img src="{$RELA_DIR}templates/{$CURRENT_SKIN}/images/view.jpg" border="0" alt="Üye Bilgilerini Görüntüle"></a>&nbsp;
            <a href="{$php_self}?action=showModifyForm&currentPage={$currentPage}&member_id={$rs[i][0][0]}"><img src="{$RELA_DIR}templates/{$CURRENT_SKIN}/images/modify.gif" border="0" alt="Üye Bilgilerini Düzenle"></a>&nbsp;
            <a href="{$php_self}?action=deleteMember&currentPage={$currentPage}&member_id={$rs[i][0][0]}" onClick="return doDelete()"><img src="{$RELA_DIR}templates/{$CURRENT_SKIN}/images/delete.gif" border="0" alt="Üyeyi Sil"></a>&nbsp;
          </td>
        </tr>
    {/section}
        <tr> 
          <td height="20" bgcolor="#CCCCCC" colspan="5">
    {$pagebutton}
          </td>
        </tr>
{/if}
        </form>
		<tr><td>&nbsp;</td></tr>
        <form action="{$RELA_DIR}admin/signup.php" method="post">
		<tr>
		    <td colspan=6 align="center"><input type='submit' value="Yeni Üye Ekle">
			</td>
		</tr>
		</form>
      </table>
    </td>
  </tr>
</table>
<p>&nbsp;</p>

