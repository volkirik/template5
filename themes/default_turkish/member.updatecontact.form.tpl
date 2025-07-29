<br>

<form action="{$php_self}" method="post">                
  <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td width="25%" height="25" colspan="2"><font color="#FF0000" class="p8">Yıldız* 
        işareti zorunlu alanı belirtir</font></td>
    </tr>
    <tr> 
      <td width="25%" height="25">Eski Şifre</td>
      <td width="75%" height="25"> 
        <input type="password" name="old_password" size="20" maxlength="20">
        </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Yeni Şifre</td>
      <td width="75%" height="25"> 
        <input type="password" name="member_password1" size="20" maxlength="20">
        </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Yeni Şifreyi Onayla</td>
      <td width="75%" height="25"> 
        <input type="password" name="member_password2" size="20" maxlength="20">
        </td>
    </tr>
    <tr> 
      <td width="25%" height="25">&nbsp;</td>
      <td width="75%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td width="25%" height="25">Kayıt Yaptıran</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_name" size="20" maxlength="20" value="{$r_name}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Kuruluş</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_org" value="{$r_org}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Sokak 1</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_address1" size="30" maxlength="60" value="{$r_address1}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Sokak 2</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_address2" size="30" maxlength="60" value="{$r_address2}">
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Sokak 3</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_address3" size="30" maxlength="60" value="{$r_address3}">
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Şehir</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_city" maxlength="60" value="{$r_city}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Bölge</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_province" maxlength="60" value="{$r_province}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Ülke</td>
      <td width="75%" height="25">
        <select name="r_country">
	{section name=i loop=$rs}
	    {if $rs[i][1] == $r_country}
		    <option value={$rs[i][1]} selected> {$rs[i][0]} </option>
		{else}
		    <option value={$rs[i][1]} > {$rs[i][0]} </option>
		{/if}
	{/section}

        </select>
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Posta Kodu</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_postalcode" maxlength="60" value="{$r_postalcode}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Telefon</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_telephone" maxlength="60" value="{$r_telephone}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Faks</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_fax" maxlength="60" value="{$r_fax}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">E-posta</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_email" maxlength="60" value="{$r_email}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">&nbsp;</td>
      <td width="75%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td width="25%" height="25">&nbsp;</td>
      <td width="75%" height="25"> 
        <input type="submit" name="Submit" value="Bilgileri Güncelle">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>

