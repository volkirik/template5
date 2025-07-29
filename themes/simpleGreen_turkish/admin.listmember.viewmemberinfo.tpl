<br>
<form action="{$php_self}" method="post">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    
{if $message != ""}

    <tr> 
      <td width="25%" height="25" colspan="2"> 
        <div style="border:solid 1px #FF0000;padding:5px"> <font class="p8"><b> 
         {$message}
          </b></font> </div>
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25" colspan="2">&nbsp; </td>
    </tr>
{/if}
    <tr> 
      <td colspan="2" height="25">
        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="border1">
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>ID</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$member_id}</td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Seviye</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$member_level}</td>
          </tr>
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Kullanıcı Adı</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$member_name}</td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Hesap</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$account}</td>
          </tr>
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Durum</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD"><font color="#FF0000">{$status}</font></td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Kayıt Zamanı</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$reg_time}</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b><br>
        <br>
        Kayıt Bilgileri</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="border1">
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Kayıt Yapan</td>
            <td width="70%" height="20"> 
             {$r_name}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Kuruluş</td>
            <td width="70%" height="20"> 
              {$r_org}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Adres 1</td>
            <td width="70%" height="20"> 
              {$r_address1}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Adres 2</td>
            <td width="70%" height="20"> 
              {$r_address2}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Adres 3</td>
            <td width="70%" height="20"> 
              {$r_address3}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Şehir</td>
            <td width="70%" height="20"> 
              {$r_city}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">İl/İlçe</td>
            <td width="70%" height="20"> 
             {$r_province}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Ülke</td>
            <td width="70%" height="20"> 
              {$r_country}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Posta Kodu</td>
            <td width="70%" height="20">
             {$r_postalcode}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Telefon</td>
            <td width="70%" height="20">
              {$r_telephone}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Faks</td>
            <td width="70%" height="20">
              {$r_fax}
            </td>
          </tr>
          <tr>
            <td width="30%" height="20" bgcolor="#EFEFEF">E-posta</td>
            <td width="70%" height="20">
              {$r_email}
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
        <input type="submit" name="Submit" value="Geri">
        <input type="hidden" name="action" value="listMember">
        <input type="hidden" name="currentPage" value="{$currentPage}">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>

