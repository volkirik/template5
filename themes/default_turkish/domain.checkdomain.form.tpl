<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td >
	  <form action="{$php_self}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td align="right" width="26%">www.</td>
            <td width="38%"> 
              <input type="text" name="domain">
              <select name="gtld">
      {section name=r loop=$rs}
            <option value={$rs[r][0]}> {$rs[r][1]} </option>
		{/section}
              </select>
            </td>
            <td width="36%"> 
              <input type="submit" name="Submit" value="Kontrol Et">
              <input type="hidden" name="action" value="checkDomain">
            </td>
          </tr>
        </table>
	  </form>
      <p><br>
        <br>
        <b>Domain Adı Formatı: </b><br>
        Bir domain adı, büyük/küçük harfe duyarsız İngilizce harfler, sayılar ve tirelerden oluşan rastgele bir bileşimdir. Dize, 67 karakteri aşamaz. Tire ('-') karakter dizesinin başında veya sonunda yer alamaz. Örneğin, 'eat-at-joes.com' geçerli bir domain adıdır, '-eatatjoes.com' değildir.</p>
      </td>
  </tr>
</table>
<p>&nbsp;</p>

