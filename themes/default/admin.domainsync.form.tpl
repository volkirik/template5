                  <br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td >
	  <form action="{$php_self}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr> 
		    <td align=right>Username</td>
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
            <td width="36%" align=center colspan=2> 
              <input type="submit" name="Submit" value="Check">
              <input type="hidden" name="action" value="syncWhois">
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
                  <p>&nbsp;</p>
