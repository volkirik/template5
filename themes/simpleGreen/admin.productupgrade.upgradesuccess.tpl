<br>
<form action="{$php_self}" method="post">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b>Upgrade domain success, </b>please click 
        &quot;Product setting&quot; to set the domain price, dns etc. and then 
        start the domain operation<br>
        <br>
        The detail information is below:</td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td height="25" align="center"> <br>
              <table width="80%" border="0" cellspacing="1" cellpadding="2" class="border1">
                <tr> 
                  <td height="20" width="30%" bgcolor="#E1ECFB"><b>Product ID</b></td>
                  <td height="20" width="70%" bgcolor="#F2F8FD"> 
                    {$product_id}
                  </td>
                </tr>
                <tr> 
                  <td height="20" width="30%" bgcolor="#E1ECFB"><b>Domain Type</b></td>
                  <td height="20" width="70%" bgcolor="#F2F8FD"> 
                    {$domainDetails[1]}
                  </td>
                </tr>
                <tr> 
                  <td height="20" width="30%" bgcolor="#E1ECFB"><b>Product Name</b></td>
                  <td height="20" width="70%" bgcolor="#F2F8FD"> 
                    {$domainDetails[2]}
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<p>&nbsp;</p></form>
<p>&nbsp;</p>
