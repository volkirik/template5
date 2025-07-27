 <script language="javascript" type="text/javascript">
    function regToAdmin(){$smarty.ldelim}
            document.add_cust.administrator.value=document.add_cust.registrant.value;
            document.add_cust.a_org.value=document.add_cust.r_org.value;
            document.add_cust.a_address1.value=document.add_cust.r_address1.value;
            document.add_cust.a_address2.value=document.add_cust.r_address2.value;
            document.add_cust.a_address3.value=document.add_cust.r_address3.value;
            document.add_cust.a_city.value=document.add_cust.r_city.value;
            document.add_cust.a_province.value=document.add_cust.r_province.value;
            document.add_cust.a_country.value=document.add_cust.r_country.options[document.add_cust.r_country.selectedIndex].value;
            document.add_cust.a_postalcode.value=document.add_cust.r_postalcode.value;
            document.add_cust.a_telephone.value=document.add_cust.r_telephone.value;
            document.add_cust.a_fax.value=document.add_cust.r_fax.value;
            document.add_cust.a_email.value=document.add_cust.r_email.value;
    {$smarty.rdelim}
    
    function regToTech() {$smarty.ldelim}
        document.add_cust.technical.value=document.add_cust.registrant.value;
        document.add_cust.t_org.value=document.add_cust.r_org.value;
        document.add_cust.t_address1.value=document.add_cust.r_address1.value;
        document.add_cust.t_address2.value=document.add_cust.r_address2.value;
        document.add_cust.t_address3.value=document.add_cust.r_address3.value;
        document.add_cust.t_city.value=document.add_cust.r_city.value;
        document.add_cust.t_province.value=document.add_cust.r_province.value;
        document.add_cust.t_country.value=document.add_cust.r_country.options[document.add_cust.r_country.selectedIndex].value;
        document.add_cust.t_postalcode.value=document.add_cust.r_postalcode.value;
        document.add_cust.t_telephone.value=document.add_cust.r_telephone.value;
        document.add_cust.t_fax.value=document.add_cust.r_fax.value;
        document.add_cust.t_email.value=document.add_cust.r_email.value;
    {$smarty.rdelim}
 
    function regToBilling() {$smarty.ldelim}
        document.add_cust.billing.value=document.add_cust.registrant.value;
        document.add_cust.b_org.value=document.add_cust.r_org.value;
        document.add_cust.b_address1.value=document.add_cust.r_address1.value;
        document.add_cust.b_address2.value=document.add_cust.r_address2.value;
        document.add_cust.b_address3.value=document.add_cust.r_address3.value;
        document.add_cust.b_city.value=document.add_cust.r_city.value;
        document.add_cust.b_province.value=document.add_cust.r_province.value;
        document.add_cust.b_country.value=document.add_cust.r_country.options[document.add_cust.r_country.selectedIndex].value;
        document.add_cust.b_postalcode.value=document.add_cust.r_postalcode.value;
        document.add_cust.b_telephone.value=document.add_cust.r_telephone.value;
        document.add_cust.b_fax.value=document.add_cust.r_fax.value;
        document.add_cust.b_email.value=document.add_cust.r_email.value;
    {$smarty.rdelim}
    
 </script>

 <br><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td >
	<form action="{$php_self}" method="post" style="margin:0px" name="add_cust">
	<input type="hidden" name="action" value="modifyContact">
	<input type="hidden" name="domain_id" value="{$domain_id}">
	<input type="hidden" name="registrant" value="{$registrant}">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="25%">Password for domain:</td>
            <td width="25%"> 
              <input type="password" name="password1" value="{$password1}">
            </td>
            <td width="20%">Password again:</td>
            <td width="30%"> 
              <input type="password" name="password2" value="{$password2}">
            </td>
          </tr>
        </table>
	    <br>
		
		        <br>
        <b>Registrant Information</b><br>
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Registrant full name</td>
            <td width="61%"> {$registrant }
<!--				<input type="text" name="registrant" value="{$registrant }" readonly>
				<font color="#990000">*</font> -->
            </td>
          </tr>
          <tr> 
            <td width="39%">Organization name</td>
            <td width="61%"> 
              <input type="text" name="r_org" value="{$r_org }">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Address 1</td>
            <td width="61%"> 
              <input type="text" name="r_address1" value="{$r_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Address 2</td>
            <td width="61%"> 
              <input type="text" name="r_address2" value="{$r_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Address 3</td>
            <td width="61%"> 
              <input type="text" name="r_address3" value="{$r_address3 }" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">City</td>
            <td width="61%"> 
              <input type="text" name="r_city" value="{$r_city }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Province/State</td>
            <td width="61%"> 
              <input type="text" name="r_province" value="{ $r_province }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Country/Region</td>
            <td width="61%">
              <select name="r_country">
				{foreach key=key item=val from=$countries} 
				{if $key == $r_country}
					<option value= {$key} selected>{$val}</option>
				{else}
					<option value= {$key}> {$val}</option>
				{/if}
				{/foreach}
              </select><font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Postal code</td>
            <td width="61%"> 
              <input type="text" name="r_postalcode" value="{$r_postalcode }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telephone(eg:+1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="r_telephone" value="{ $r_telephone }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(eg:+1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="r_fax" value="{ $r_fax }">
              <font color="#990000">*</font></td>
          </tr>
          <tr>
            <td width="39%">E-mail</td>
            <td width="61%">
              <input type="text" name="r_email" value="{$r_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br><br>
		
		<b>Administrator Information</b><br>
        <center>
            <input type=button name="copy_r2a" value="Copy from Registrant to Administrator"
                 onClick="regToAdmin();">
        </center>   
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Full name of administrator</td>
            <td width="61%"> 
              <input type="text" name="administrator" value="{$administrator }">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Organization name</td>
            <td width="61%"> 
              <input type="text" name="a_org" value="{$a_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Address 1</td>
            <td width="61%"> 
              <input type="text" name="a_address1" value="{$a_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Address 2</td>
            <td width="61%"> 
              <input type="text" name="a_address2" value="{$a_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Address 3</td>
            <td width="61%"> 
              <input type="text" name="a_address3" value="{$a_address3 }" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">City</td>
            <td width="61%"> 
              <input type="text" name="a_city" value="{$a_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Province/State</td>
            <td width="61%"> 
              <input type="text" name="a_province" value="{$a_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Country/Region</td>
            <td width="61%"> 
              <select name="a_country">
				{foreach key=key item=val from=$countries} 
				{if $key == $a_country}
					<option value= {$key} selected>{$val}</option>
				{else}
					<option value= {$key}> {$val}</option>
				{/if}
				{/foreach}
              </select><font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Postal code</td>
            <td width="61%"> 
              <input type="text" name="a_postalcode" value="{$a_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telephone(eg:+1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="a_telephone" value="{$a_telephone }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(eg:+1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="a_fax" value="{$a_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-mail</td>
            <td width="61%"> 
              <input type="text" name="a_email" value="{ $a_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
		
		<b><br><br>
        Technical Contact Information</b><br>
        <center>
            <input type=button name="copy_r2a" value="Copy from Registrant to Technical Contact"
                 onClick="regToTech();">
        </center> 
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Full name of technical contact</td>
            <td width="61%"> 
              <input type="text" name="technical" value="{$technical}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Organization name</td>
            <td width="61%"> 
              <input type="text" name="t_org" value="{$t_org }">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Address 1</td>
            <td width="61%"> 
              <input type="text" name="t_address1" value="{$t_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Address 2</td>
            <td width="61%"> 
              <input type="text" name="t_address2" value="{$t_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Address 3</td>
            <td width="61%"> 
              <input type="text" name="t_address3" value="{$t_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">City</td>
            <td width="61%"> 
              <input type="text" name="t_city" value="{$t_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Province/State</td>
            <td width="61%"> 
              <input type="text" name="t_province" value="{$t_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Country/Region</td>
            <td width="61%"> 
              <select name="t_country">
				{foreach key=key item=val from=$countries} 
				{if $key == $t_country}
					<option value= {$key} selected>{$val}</option>
				{else}
					<option value= {$key}> {$val}</option>
				{/if}
				{/foreach}
              </select><font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Postal code</td>
            <td width="61%"> 
              <input type="text" name="t_postalcode" value="{ $t_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telephone(eg:+1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="t_telephone" value="{ $t_telephone }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(eg:+1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="t_fax" value="{ $t_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-mail</td>
            <td width="61%"> 
              <input type="text" name="t_email" value="{$t_email }" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br>
		
        <br>
        <b>Billing Contact Information</b><br>
        <center>
            <input type=button name="copy_r2a" value="Copy from Registrant to Billing Contact"
                 onClick="regToBilling();">
        </center> 
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Full name of billing contact</td>
            <td width="61%">  
				<input type="text" name="billing" value="{$billing}">
				<font color="#990000">*</font> 
                
            </td>
          </tr>
          <tr> 
            <td width="39%">Organization name</td>
            <td width="61%"> 
			  <input type="text" name="b_org" value="{ $b_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Address 1</td>
            <td width="61%"> 
              <input type="text" name="b_address1" value="{ $b_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Address 2</td>
            <td width="61%"> 
              <input type="text" name="b_address2" value="{$b_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Address 3</td>
            <td width="61%"> 
              <input type="text" name="b_address3" value="{ $b_address3 }" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">City</td>
            <td width="61%"> 
              <input type="text" name="b_city" value="{$b_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Province/State</td>
            <td width="61%"> 
              <input type="text" name="b_province" value=" {$b_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Country/Region</td>
            <td width="61%"> 
              <select name="b_country">

		    {foreach key=key item=val from=$countries} 
		    {if $key == $b_country}
		        <option value= {$key} selected>{$val}</option>
			{else}
				<option value= {$key}> {$val}</option>
			{/if}
		    {/foreach}

              </select><font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Postal code</td>
            <td width="61%"> 
              <input type="text" name="b_postalcode" value="{$b_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telephone(eg:+1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="b_telephone" value="{$b_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(eg:+1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="b_fax" value="{ $b_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-mail</td>
            <td width="61%"> 
              <input type="text" name="b_email" value="{$b_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">&nbsp;</td>
            <td width="61%">&nbsp;</td>
          </tr>
          <tr>
            <td width="39%">&nbsp;</td>
            <td width="61%">
              <input type="submit" name="Submit" value="Modify domain contact">
            </td>
          </tr>
        </table>
        <br>
      </form>
      
    </td>
  </tr>
</table>
                  <p>&nbsp;</p>
