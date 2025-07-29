                  <br>
                  
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
   <tr>
     
    <td height="25" colspan="2">
	<b>
		{if $result == 1}
			The follow domain is unavailable
		{else}
			The follow domain is available
		{/if}
    </b><br>
      <br>
      <form action="{$php_self}" method="post" style="margin:0px">
      <input type="hidden" name="action" value="selectMember">
      <input type="hidden" name="domain" value="{$domain}">
      <input type="hidden" name="gtld" value="{$gtld}">
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="30" bgcolor="#EFEFEF" align="center">
			{if $result == 1}
				{$real_domain}
			{else}
				{$real_domain}
				</td><td bgcolor=#EFEFEF><input type=submit name=Submit value="Continue >>">
			{/if}
          </td>
        </tr>
      </table>
      </form>
      <br>
      <br>
      If you want to check more domain names, please enter the domain name below 
      and click Check to check domain.<br>
      <br>
    </td>
  </tr>
  <tr> 
    <td >
	  <form action="{$php_self}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td align="right"  valign=middle>www.</td>
            <td> 
              <input type="text" name="domain" valign=middle>
              <select name="gtld">
				{section name=r loop=$rs}
					<option value={$rs[r][0]} >{$rs[r][1]}</option>
				{/section}
              </select>
            </td>
            <td  valign=middle> 
              <input type="submit" name="Submit" value="Check" align=left>
              <input type="hidden" name="action" value="checkDomain">
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
