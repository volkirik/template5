<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td >
	  <form action="{$content_action}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr> 
            <td align="right" >www.
              <input type="text" name="domain">
              <select name="gtld" style="width: 50px;">
			  {section name=domain loop=$domain_details}
			    <option value="{$domain_details[domain][0]}">{$domain_details[domain][1]}</option>
			  {/section}
			  </select>
            </td>
            <td width="36%"> 
              <input type="submit" name="Submit" value="Kontrol Et">
              <input type="hidden" name="action" value="getWhois">
            </td>
          </tr>
        </table>
	  </form>
      <p><br>
        <br>
        <b>Domain Adı Formatı: </b><br>
        Bir domain adı, büyük/küçük harfe duyarsız İngilizce harflerin, rakamların ve tire işaretinin rastgele bir bileşimidir. 
        Dize uzunluğu 67 karakteri geçemez. Tire ('-') işareti, karakter dizisinin başında veya sonunda bulunamaz. 
        Örneğin, 'eat-at-joes.com' geçerli bir domain adıdır, ancak '-eatatjoes.com' geçerli değildir.</p>
      </td>
  </tr>
</table>

