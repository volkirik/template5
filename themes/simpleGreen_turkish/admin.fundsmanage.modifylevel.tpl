<br>

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td height="25">
      <br>
      <form action="{$php_self}" method="post" style="margin:0px">

        <input type="hidden" name="action" value="modifyLevel">
        <input type="hidden" name="member_name" value="{$member_name}">
        <b><font color="#FF0000">Başarı!</font></b> <b>${$amount}</b>
        hesaplarına 
{if $type == 1}
    eklendi
{else}
    düşürüldü
{/if}
         <b>{$member_name}</b>.<br>
        Mevcut üye seviyesi 
        <b>{$member_level}</b> olup, üye seviyesini yeniden ayarlamak ister misiniz?<br>
        <br>
        <br>
        <table width="95%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td height="30" bgcolor="#EFEFEF" align="center">Üye seviyesi: 
              <select name="member_level">
                
{if $member_level == 0}

                <option value="0" selected>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
 
{elseif $member_level == 1}

                <option value="0">0</option>
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
{elseif $member_level == 2}

                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>

{elseif $member_level == 3}
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3" selected>3</option>
                <option value="4">4</option>
                
{elseif $member_level == 4}
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4" selected>4</option>
{else}

                <option value="0" selected>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
{/if}
              </select>
            </td>
            <td height="30" bgcolor="#EFEFEF" align="center">
              <input type="submit" name="Submit" value="   TAMAM   ">
              <input type="button" name="back" value="İptal" onClick="document.location.href='{$RELA_DIR}/admin/fundsManage.php'">
            </td>
          </tr>
        </table>
      </form>
      <br>
    </td>
  </tr>
</table>
<p>&nbsp;</p>

