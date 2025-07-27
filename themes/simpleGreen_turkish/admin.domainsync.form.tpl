<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td>
      <form action="{$php_self}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr> 
            <td align="right">Kullanıcı Adı</td>
            <td align="left"><input type="text" name="username"></td>
          </tr>
          <tr>  
            <td align="right" width="26%">www.</td>
            <td width="38%" align="left"> 
              <input type="text" name="domain">
              <select name="gtld">
                {section name=r loop=$rs}
                    <option value={$rs[r][0]}> {$rs[r][1]} </option>
                {/section}
              </select>
            </td>
          </tr>
          <tr> 
            <td width="36%" align="center" colspan="2"> 
              <input type="submit" name="Submit" value="Kontrol Et">
              <input type="hidden" name="action" value="syncWhois">
            </td>
          </tr>
        </table>
      </form>
      <p><br>
        <br>
        <b>Alan Adı Formatı: </b><br>
        Bir alan adı, büyük/küçük harf duyarsız İngilizce harfler, sayılar ve kısa çizgilerden oluşur. Dize 67 karakterden uzun olamaz. Kısa çizgi ('-') karakter dizisinin başında veya sonunda yer alamaz. Örneğin, 'eat-at-joes.com' geçerli bir alan adı iken, '-eatatjoes.com' geçerli değildir.</p>
    </td>
  </tr>
</table>
<p>&nbsp;</p>

