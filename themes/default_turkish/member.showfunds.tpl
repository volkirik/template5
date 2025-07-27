<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td > 
      <p><font size="2"><b>Hoş geldiniz </b> 
        {$member_info[1]}
        </font><font color="#FF0000"><br>
        <br>
        </font></p>
      <table width="50%" border="0" cellspacing="1" cellpadding="2" class="border1" align="center">
        <tr> 
          <td height="20" width="30%" bgcolor="#E1ECFB"><b>Hesap</b></td>
          <td height="20" width="70%" bgcolor="#F2F8FD"> <b> 
            {$member_info[1]}
            </b></td>
        </tr>
        <tr> 
          <td height="20" width="30%" bgcolor="#E1ECFB"><b>Seviye</b></td>
          <td height="20" width="70%" bgcolor="#F2F8FD"> <b> 
            {$member_info[4]}
            </b></td>
        </tr>
        <tr> 
          <td height="20" width="30%" bgcolor="#E1ECFB"><b>Bakiye</b></td>
          <td height="20" width="70%" bgcolor="#F2F8FD"> <font color="#000000">$ 
            {$member_info[6]}
            </font></td>
        </tr>
      </table>
      </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
        <td align="center">
            <form action="{$php_self}" method="POST">
                <input type="text" name="fund_amount">
                <input type="submit" name="Submit" value="Fon Ekle">
                <input type="hidden" name="action" value="selectGateway">
            </form>
        </td>
  </tr>
</table>

