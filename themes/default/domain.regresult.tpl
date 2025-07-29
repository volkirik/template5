                  <br>
                  
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
   <tr>
     
    <td width="25%" height="25" colspan="2"><b><font color="#990000">Register Successfully!</font></b> Your account has been charged ${$product_price[$year]}.<br>
      <br>
      <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td height="22" bgcolor="#EFEFEF" align="center">{$domain_name}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        {if $count > 0}
        <tr>
            <td bgcolor="#EFEFEF" align="center">
                Please click <a href={$php_self}?action=initDomainRegistration>here</a> to continue the registration. 
            </td>
        </tr>
        {/if}
      </table>
    </td>
  </tr>
  <tr> 
    <td > 
      <p><br>
      </p>
      <p><br>
        <b>Note:</b> A failed registration could be a result of network congestion 
        or other technical issues and does not necessarily mean that domain is 
        not available. Check the Whois database for details.<br>
      </p>
    </td>
  </tr>
</table>
                  <p>&nbsp;</p>
