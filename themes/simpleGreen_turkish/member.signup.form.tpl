<form action="{$content_action}" method="post">
  <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td width="25%" height="25" colspan="2"><font color="#FF0000" class="p8">Yıldız (*) zorunludur</font></td>
    </tr>
    <tr> 
      <td width="25%" height="25">Kullanıcı Adı</td>
      <td width="75%" height="25"> 
        <input type="text" name="member_name" size="20" maxlength="20" value="{$member_name}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Şifre</td>
      <td width="75%" height="25"> 
        <input type="password" name="member_password1" size="20" maxlength="20" value="{$member_password1}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Şifreyi Onayla</td>
      <td width="75%" height="25"> 
        <input type="password" name="member_password2" size="20" maxlength="20" value="{$member_password2}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">&nbsp;</td>
      <td width="75%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td width="25%" height="25">Kayıt Yapan</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_name" size="20" maxlength="20" value="{$r_name}">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Kuruluş</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_org" value="{$r_org}">
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Cadde 1</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_address1" size="30" maxlength="60" value="{$r_address1}">
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Cadde 2</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_address2" size="30" maxlength="60" value="{$r_address2}">
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Cadde 3</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_address3" size="30" maxlength="60" value="{$r_address3}">
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Şehir</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_city" maxlength="60" value="{$r_city}">
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Bölge</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_province" maxlength="60" value="{$r_province}">
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Ülke</td>
      <td width="75%" height="25">
        <select name="r_country">
            {foreach key=key item=item from=$countries}
                <option value="{$key}"
                    {if $key==$r_country}selected{/if}>{$item}
                </option>
            {/foreach}
        </select>
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Posta Kodu</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_postalcode" maxlength="60" value="{$r_postalcode}">
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Telefon (örneğin: +1.4156657168)</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_telephone" maxlength="60" value="{$r_telephone}">
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">Faks (örneğin: +1.4156657168)</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_fax" maxlength="60" value="{$r_fax}">
        <font color="#FF0000">*</font> 
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25">E-posta</td>
      <td width="75%" height="25"> 
        <input type="text" name="r_email" maxlength="60" value="{$r_email}">
        <font color="#FF0000">*</font> </td>
    </tr>
    {if $CAPTCHA_ENABLE === 1 && (!isset($IS_ADMIN) || $IS_ADMIN == false) }
    <tr> 
      <td width="25%"><img src="{$RELA_DIR}common/Captcha/displayCaptcha.php"></td>
      <td width="75%">  Captcha giriniz;<br>
              <input type="text" name="keystring">
        <font color="#FF0000">*</font> </td>
    </tr>
    {/if}
    <tr> 
      <td width="25%" height="25">&nbsp;</td>
      <td width="75%" height="25">&nbsp;</td>
    </tr>
    <tr>
      <td width="25%" height="25">&nbsp;</td>
      <td width="75%" height="25"> 
        <input type="submit" value="Üye Ol" name="Submit">
      </td>
    </tr>
  </table>
</form>

