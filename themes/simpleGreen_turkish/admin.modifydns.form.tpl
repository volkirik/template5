<br>

<table width="55%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td>
      <form action="{$php_self}" method="post" style="margin:0px">
      
      <input type="hidden" name="domain_id" value="{$domain_id}">
        <br>
        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="border1">
          <tr> 
            <td width="20%" bgcolor="#E1ECFB"><b>Dns 1:</b></td>
            <td width="30%" bgcolor="#F2F8FD"> 
              <input type="text" name="dns" value="{$dns}" readonly style="background: #EFEFEF;">
            </td>
            <td width="20%" bgcolor="#E1ECFB" align="right"><b>Ip:&nbsp;</b></td>
            <td width="30%" bgcolor="#F2F8FD"> 
              <input type="text" name="ip" value="{$ip}">
            </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> <td>&nbsp;</td> </tr>
          <tr> 
            <td align="center"> 
              <input type="submit" name="Submit" value="DNS Güncelle">&nbsp; &nbsp;
              <input type="reset" name="Reset" value="Sıfırla">
              <input type="hidden" name="action" value="modifyDns">
              <input type="hidden" name="oldip" value="{$ip}">
            </td>
          </tr>
        </table>
        <br>
      </form>
      
    </td>
  </tr>
</table>

