<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td >
      <form action="{$content_action}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr> 
            <td align="right" >www.
              <input type="text" name="domain">
              <select name="gtld" style=" width : 50px;">
              {section name=domain loop=$domain_details}
                <option value="{$domain_details[domain][0]}">{$domain_details[domain][1]}</option>
              {/section}
              </select>
            </td>
            {if !isset($IS_ADMIN) || $IS_ADMIN == false}
      <td width="20%"><img src="{$RELA_DIR}common/Captcha/displayCaptcha.php"></td>
      <td width="20%">  Captcha giriniz;<br>
              <input type="text" name="keystring">
        <font color="#FF0000">*</font> </td>
            <td width="20%">
         {else}
            <td width="50%">
         {/if}
              <input type="submit" name="Submit" value="Kontrol Et">
              <input type="hidden" name="action" value="getWhois">
            </td>
          </tr>
        </table>
      </form>
      <p><br>
        <br>
        <b>Alan Adı Formatı: </b><br>
        Bir alan adı, büyük/küçük harfe duyarsız İngilizce harflerden, 
        rakamlardan ve tirelerden oluşan rastgele bir kompozisyondur. 
        Dize 67 karakterden uzun olamaz. Tire ('-') karakter dizisinin 
        başında veya sonunda bulunamaz. Örneğin, 'eat-at-joes.com' geçerli bir 
        alan adıdır, '-eatatjoes.com' ise geçerli değildir.</p>
      </td>
  </tr>
</table>

