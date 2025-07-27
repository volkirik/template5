<br>
<form action="{$php_self} " method="post">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    
{if $message != ""}

    <tr> 
      <td width="25%" height="25" colspan="2"> 
        <div style="border:solid 1px #FF0000;padding:5px"> <font class="p8"><b> 
         {$message}
          </b></font> </div>
      </td>
    </tr>
    <tr> 
      <td width="25%" height="25" colspan="2">&nbsp; </td>
    </tr>
{/if}
    <tr> 
      <td colspan="2" height="25">
        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="border1">
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>ID</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$member_id}</td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Level</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$member_level}</td>
          </tr>
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Username</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$member_name}</td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Account</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$account}</td>
          </tr>
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Status</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD"><font color="#FF0000">{$status}</font></td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Reg Time</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$reg_time}</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="25"><b><br>
        <br>
        Registrant information</b></td>
    </tr>
    <tr> 
      <td colspan="2" height="25"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="border1">
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Registrant</td>
            <td width="70%" height="20"> 
             {$r_name}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Organization</td>
            <td width="70%" height="20"> 
              {$r_org}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Address 1</td>
            <td width="70%" height="20"> 
              {$r_address1}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Address 2</td>
            <td width="70%" height="20"> 
              {$r_address2}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Address 3</td>
            <td width="70%" height="20"> 
              {$r_address3}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">City</td>
            <td width="70%" height="20"> 
              {$r_city}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Province/State</td>
            <td width="70%" height="20"> 
             {$r_province}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Country</td>
            <td width="70%" height="20"> 
              {$r_country}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Postalcode</td>
            <td width="70%" height="20">
             {$r_postalcode}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Telephone</td>
            <td width="70%" height="20">
              {$r_telephone}
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Fax</td>
            <td width="70%" height="20">
              {$r_fax}
            </td>
          </tr>
          <tr>
            <td width="30%" height="20" bgcolor="#EFEFEF">E-mail</td>
            <td width="70%" height="20">
              {$r_email}
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td width="30%" height="25">&nbsp;</td>
      <td width="70%" height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td width="30%" height="25">&nbsp;</td>
      <td width="70%" height="25"> 
        <input type="submit" name="Submit" value="Back">
        <input type="hidden" name="action" value="listMember">
        <input type="hidden" name="currentPage" value="{$currentPage}">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
