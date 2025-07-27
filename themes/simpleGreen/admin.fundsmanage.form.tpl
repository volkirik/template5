<br>
<form action="{$php_self}" method="post">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="3" class="border1">
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Username</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD"> 
              <input type="text" name="member_name" size="20">
            </td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Type</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD"> 
              <select name="type">
                <option value="1" selected>Funds added</option>
                <option value="2">Funds subtracted</option>
              </select>
            </td>
          </tr>
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Amount</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD"> 
              <input type="text" name="amount" size="20">
            </td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Note</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD"> 
              <input type="text" name="note" size="20">
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25">&nbsp; </td>
    </tr>
    <tr> 
      <td width="30%" height="25">&nbsp;</td>
      <td width="70%" height="25"> 
        <input type="submit" name="Submit" value="Confirm">
        <input type="hidden" name="action" value="modifyFunds">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
