
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
            <td width="36%"> 
              <input type="submit" name="Submit" value="Check">
              <input type="hidden" name="action" value="getWhois">
            </td>
          </tr>
        </table>
	  </form>
      <p><br>
        <br>
        <b>Domain Name Format: </b><br>
        A domain name is a random composition of case insensitive English letters, 
        numbers and the hyphen. The string can not exceed 67 characters in length. 
        The hyphen ('-') can not appear at the beginning or the end of the character 
        string. For example, 'eat-at-joes.com' is a valid domain name, '-eatatjoes.com' 
        is not.</p>
      </td>
  </tr>
</table>
