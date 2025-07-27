<br>
<form action="{$php_self}" method="post">
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
            <td height="20" width="30%" bgcolor="#F2F8FD">
              <select name="member_level">

{if $member_level == 0}

				<option value="0" selected>0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
{elseif $member_level == 1}

				<option value="0">0</option>
				<option value="1" selected>1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
{elseif $member_level == 2}

				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2" selected>2</option>
				<option value="3">3</option>
				<option value="4">4</option>
{elseif $member_level == 3}

				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3" selected>3</option>
				<option value="4">4</option>
{elseif $member_level == 4}

				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4" selected>4</option>
{else}

				<option value="0" selected>0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
{/if}
              </select>
            </td>
          </tr>
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Username</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$member_name}</td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Account</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$account}</td>
          </tr>
          <tr> 
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Status</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">

{if $flag == 0}


              <input type="checkbox" name="flag" value="1">
{else}

              <input type="checkbox" name="flag" value="1" checked>
{/if}
              Account is disabled</td>
            <td height="20" width="20%" bgcolor="#E1ECFB"><b>Reg Time</b></td>
            <td height="20" width="30%" bgcolor="#F2F8FD">{$reg_time}</td>
          </tr>
		  <tr>
		    <td height="20" width="20%" bgcolor="#E1ECFB"><b>New Password</b></td>
			<td height="20" width="30%" bgcolor="#F2F8FD">
			    <input type="password" name="r_password" >
			</td>
			<td height="20" width="20%" bgcolor="#E1ECFB"></td>
			<td height="20" width="30%" bgcolor="#F2F8FD"></td>
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
            <td width="70%" height="20"> {$r_name}
<!--              <input type="text" name="r_name" value="{$r_name}" readonly> -->
              
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Organization</td>
            <td width="70%" height="20"> 
              <input type="text" name="r_org" value="{$r_org}">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Address 1</td>
            <td width="70%" height="20"> 
              <input type="text" name="r_address1" value="{$r_address1}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Address 2</td>
            <td width="70%" height="20"> 
              <input type="text" name="r_address2" value="{$r_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Address 3</td>
            <td width="70%" height="20"> 
              <input type="text" name="r_address3" value="{$r_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">City</td>
            <td width="70%" height="20"> 
              <input type="text" name="r_city" value="{$r_city}">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Province/State</td>
            <td width="70%" height="20"> 
              <input type="text" name="r_province" value="{$r_province}">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Country</td>
            <td width="70%" height="20">
        <select name="r_country">


{section name=i loop=$rs}
	    {if $rs[i][1] == $r_country}
		    <option value= {$rs[i][1]}  selected>{$rs[i][0]}</option>
	{else}
		<option value= {$rs[i][1]}>{$rs[i][0]} </option>
	{/if}
	{/section}	
        </select>
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Postalcode</td>
            <td width="70%" height="20">
              <input type="text" name="r_postalcode" value="{$r_postalcode}">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Telephone</td>
            <td width="70%" height="20">
              <input type="text" name="r_telephone" value="{$r_telephone}">
            </td>
          </tr>
          <tr> 
            <td width="30%" height="20" bgcolor="#EFEFEF">Fax</td>
            <td width="70%" height="20">
              <input type="text" name="r_fax" value="{$r_fax}">
            </td>
          </tr>
          <tr>
            <td width="30%" height="20" bgcolor="#EFEFEF">E-mail</td>
            <td width="70%" height="20">
              <input type="text" name="r_email" value="{$r_email}">
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
        <input type="submit" name="Submit" value="Modify member info">
        <input type="hidden" name="action" value="modifyMemberInfo">
        <input type="hidden" name="member_id" value="{$member_id}">
        <input type="hidden" name="currentPage" value="{$currentPage}">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
