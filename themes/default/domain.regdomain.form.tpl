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
                  
                  <br>

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td >
	<form action="{$php_self}" method="post" style="margin:0px" name="add_cust">
	<input type="hidden" name="action" value="registerDomain">
	<input type="hidden" name="domain" value="{$domain}">
	<input type="hidden" name="gtld" value="{$gtld}">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%">Domain name:</td>
            <td width="28%">{$domain}{$product_info[3]}</td>
            <td width="12%">Price</td>
            <td width="35%">
			<select name="year">
			
			
{php}
	for($i = 1; $i < 11; $i ++)
	{
		if(($product_info[3] == ".us" || $product_info[3] == ".info" || $product_info[3] == ".biz") && ($i == 1))
		{
		}else {
			if($i == $year)
			{
				echo "<option value=\"" . $i . "\" selected>$" . $product_price[$i] . "/" . $i . (($i == 1)?"year":"years") . "</option>";
			}else {
				echo "<option value=\"" . $i . "\">$" . $product_price[$i] . "/" . $i . (($i == 1)?"year":"years") . "</option>";
			}
		}
	}
{/php}
			</select>
            </td>
          </tr>
          <tr> 
            <td width="25%">Password for domain:</td>
            <td width="28%"> 
              <input type="password" name="password1" value="{$password1}">
            </td>
            <td width="12%">Dns 1:</td>
            <td width="35%"> 
              <input type="text" name="dns1" value="{$dns1}">
            </td>
          </tr>
          <tr> 
            <td width="25%">Password again:</td>
            <td width="28%"> 
              <input type="password" name="password2" value="{$password2}">
            </td>
            <td width="12%">Dns 2:</td>
            <td width="35%">
              <input type="text" name="dns2" value="{$dns2}">
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
            <td width="61%"> 
              <input type="text" name="registrant" value="{$registrant}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Organization name</td>
            <td width="61%"> 
              <input type="text" name="r_org" value="{$r_org}">
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
              <input type="text" name="r_address3" value="{$r_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">City</td>
            <td width="61%"> 
              <input type="text" name="r_city" value="{$r_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Province/State</td>
            <td width="61%"> 
              <input type="text" name="r_province" value="{$r_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Country/Region</td>
            <td width="61%">
              <select name="r_country">

				{foreach item=val key=key from=$countries}
						{if $key == $r_country}
							<option value={$key} selected>{$val}</option>
						{else}
							<option value={$key} >{$val}</option>
						{/if}
				{/foreach}

              </select><font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Postal code</td>
            <td width="61%"> 
              <input type="text" name="r_postalcode" value="{$r_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telephone(eg:+1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="r_telephone" value="{$r_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(eg:+1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="r_fax" value="{$r_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr>
            <td width="39%">E-mail</td>
            <td width="61%">
              <input type="text" name="r_email" value="{$r_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br>
        <b>Administrator Information</b><br>
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Full name of administrator</td>
            <td width="61%"> 
              <input type="text" name="administrator" value="$administrator}">
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
              <input type="text" name="a_address3" value="{$a_address3}" size="30">
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
				{foreach item=val key=key from=$countries}
						{if $key == $a_country}
							<option value={$key} selected>{$val}</option>
						{else}
							<option value={$key} >{$val}</option>
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
              <input type="text" name="a_telephone" value="{$a_telephone}">
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
              <input type="text" name="a_email" value="{$a_email}" size="30">
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
              <input type="text" name="t_org" value="{$t_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Address 1</td>
            <td width="61%"> 
              <input type="text" name="t_address1" value="{$r_address1 ?>" size="30">
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

				{foreach item=val key=key from=$countries}
						{if $key == $t_country}
							<option value={$key} selected>{$val}</option>
						{else}
							<option value={$key} >{$val}</option>
						{/if}
				{/foreach}
              </select><font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Postal code</td>
            <td width="61%"> 
              <input type="text" name="t_postalcode" value="{$t_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telephone(eg:+1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="t_telephone" value="{$t_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(eg:+1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="t_fax" value="{$t_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-mail</td>
            <td width="61%"> 
              <input type="text" name="t_email" value="{$t_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br><br>
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
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Organization name</td>
            <td width="61%"> 
              <input type="text" name="b_org" value="{$b_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Address 1</td>
            <td width="61%"> 
              <input type="text" name="b_address1" value="{$b_address1}" size="30">
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
              <input type="text" name="b_address3" value="{$b_address3}" size="30">
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
              <input type="text" name="b_province" value="{$b_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Country/Region</td>
            <td width="61%"> 
              <select name="b_country">


            	{foreach item=val key=key from=$countries}
						{if $key == $b_country}
							<option value={$key} selected>{$val}</option>
						{else}
							<option value={$key} >{$val}</option>
						{/if}
				{/foreach}
              </select>
              <font color="#990000">*</font></td>
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
              <input type="text" name="b_telephone" value="{$b_telephone ?>">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(eg:+1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="b_fax" value="{$b_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-mail</td>
            <td width="61%"> 
              <input type="text" name="b_email" value="{$b_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td colspan="2">

{if $product_info[3] == ".us"}

			<br>
              <b>NEXUS Information</b><br>
              <hr size="1" noshade>
              <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
                <tr>
                  <td colspan="3">This requirement is intended to ensure that 
                    only those individuals or organizations that have a substantive 
                    lawful connection to the United States are permitted to register 
                    for usTLD domain names.</td>
                </tr>
                <tr>
                  <td colspan="3">Please choose your appropriate status</td>
                </tr>
                <tr>
                  <td width="13%">Category</td>
                  <td width="28%" valign="top"> 
                    <input type="radio" name="category" value="C11" checked>
                    Category 1: (1)</td>
                  <td width="59%">A natural person: Who is a United States citizen</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C12">
                    Category 1: (2)</td>
                  <td width="59%">A natural person: Who is a permanent resident 
                    of the United States of America or any of its possessions 
                    or territories</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C21">
                    Category 2: (1)</td>
                  <td width="59%">A United States Organization incorporated within 
                    one of the 50 U.S. states, the District of Columbia, or any 
                    of the United States possessions or territories or organized 
                    or otherwise constituted nder the laws of a state of the United 
                    States of America, the District of Columbia or any of its 
                    possessions or territories or a U.S. federal, state or local 
                    government entity or a political subdivision thereof</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C31">
                    Category 3: (1)</td>
                  <td width="59%">An entity or organization that has a bona fide 
                    presence in the United States of America or any of its possessions 
                    or territories: Which regularly engages in lawful activities 
                    (sales off goods or services or other business, commercial 
                    or non-commercial, including not-for-profit relations in the 
                    United States)</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C32">
                    Category 3: (2)</td>
                  <td width="59%">An entity or organization that has a bona fide 
                    presence in the United States of America or any of its possessions 
                    or territories: Which has an office or other facility in the 
                    United States</td>
                </tr>
                <tr>
                  <td width="13%">&nbsp;</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%">Home Country For Category 3</td>
                  <td width="59%"> 
                    <select name="validator">
                      <option value="AF">AFGHANISTAN</option>
                      <option value="AL">ALBANIA</option>
                      <option value="BW">BOTSWANA</option>
                      <option value="DZ">ALGERIA</option>
                      <option value="AS">AMERICAN SAMOA</option>
                      <option value="AD">ANDORRA</option>
                      <option value="AO">ANGOLA</option>
                      <option value="AI">ANGUILLA</option>
                      <option value="AQ">ANTARCTICA</option>
                      <option value="AG">ANTIGUA AND BARBUDA</option>
                      <option value="AR">ARGENTINA</option>
                      <option value="AM">ARMENIA</option>
                      <option value="AW">ARUBA</option>
                      <option value="AU">AUSTRALIA</option>
                      <option value="AT">AUSTRIA</option>
                      <option value="AZ">AZERBAIJAN</option>
                      <option value="BS">BAHAMAS</option>
                      <option value="BH">BAHRAIN</option>
                      <option value="BD">BANGLADESH</option>
                      <option value="BB">BARBADOS</option>
                      <option value="BY">BELARUS</option>
                      <option value="BE">BELGIUM</option>
                      <option value="BZ">BELIZE</option>
                      <option value="BJ">BENIN</option>
                      <option value="BM">BERMUDA</option>
                      <option value="BT">BHUTAN</option>
                      <option value="BO">BOLIVIA</option>
                      <option value="BA">BOSNIA AND HERZEGOV</option>
                      <option value="BV">BOUVET ISLAND</option>
                      <option value="BR">BRAZIL</option>
                      <option value="IO">BRITISH INDIAN OCEA</option>
                      <option value="BN">BRUNEI DARUSSALAM</option>
                      <option value="BG">BULGARIA</option>
                      <option value="BF">BURKINA FASO</option>
                      <option value="BI">BURUNDI</option>
                      <option value="KH">CAMBODIA</option>
                      <option value="CM">CAMEROON</option>
                      <option value="CA">CANADA</option>
                      <option value="CV">CAPE VERDE</option>
                      <option value="KY">CAYMAN ISLANDS</option>
                      <option value="CF">CENTRAL AFRICAN REP</option>
                      <option value="TD">CHAD</option>
                      <option value="CL">CHILE</option>
                      <option value="CN">CHINA</option>
                      <option value="CX">CHRISTMAS ISLAND</option>
                      <option value="CC">COCOS (KEELING) ISL</option>
                      <option value="CO">COLOMBIA</option>
                      <option value="KM">COMOROS</option>
                      <option value="CG">CONGO</option>
                      <option value="CD">CONGO, THE DEMOCRAT</option>
                      <option value="CK">COOK ISLANDS</option>
                      <option value="CR">COSTA RICA</option>
                      <option value="CI">C?TE D'IVOIRE</option>
                      <option value="HR">CROATIA</option>
                      <option value="CU">CUBA</option>
                      <option value="CY">CYPRUS</option>
                      <option value="CZ">CZECH REPUBLIC</option>
                      <option value="DK">DENMARK</option>
                      <option value="DJ">DJIBOUTI</option>
                      <option value="DM">DOMINICA</option>
                      <option value="DO">DOMINICAN REPUBLIC</option>
                      <option value="TP">EAST TIMOR</option>
                      <option value="EC">ECUADOR</option>
                      <option value="EG">EGYPT</option>
                      <option value="SV">EL SALVADOR</option>
                      <option value="GQ">EQUATORIAL GUINEA</option>
                      <option value="ER">ERITREA</option>
                      <option value="EE">ESTONIA</option>
                      <option value="ET">ETHIOPIA</option>
                      <option value="FK">FALKLAND ISLANDS (M</option>
                      <option value="FO">FAROE ISLANDS</option>
                      <option value="FJ">FIJI</option>
                      <option value="FI">FINLAND</option>
                      <option value="FR">FRANCE</option>
                      <option value="GF">FRENCH GUIANA</option>
                      <option value="PF">FRENCH POLYNESIA</option>
                      <option value="TF">FRENCH SOUTHERN TER</option>
                      <option value="GA">GABON</option>
                      <option value="GM">GAMBIA</option>
                      <option value="GE">GEORGIA</option>
                      <option value="DE">GERMANY</option>
                      <option value="GH">GHANA</option>
                      <option value="GI">GIBRALTAR</option>
                      <option value="GR">GREECE</option>
                      <option value="GL">GREENLAND</option>
                      <option value="GD">GRENADA</option>
                      <option value="GP">GUADELOUPE</option>
                      <option value="GU">GUAM</option>
                      <option value="GT">GUATEMALA</option>
                      <option value="GN">GUINEA</option>
                      <option value="GW">GUINEA-BISSAU</option>
                      <option value="GY">GUYANA</option>
                      <option value="HT">HAITI</option>
                      <option value="HM">HEARD ISLAND AND MC</option>
                      <option value="VA">HOLY SEE (VATICAN C</option>
                      <option value="HN">HONDURAS</option>
                      <option value="HK">HONG KONG</option>
                      <option value="HU">HUNGARY</option>
                      <option value="IS">ICELAND</option>
                      <option value="IN">INDIA</option>
                      <option value="ID">INDONESIA</option>
                      <option value="IR">IRAN, ISLAMIC REPUB</option>
                      <option value="IQ">IRAQ</option>
                      <option value="IE">IRELAND</option>
                      <option value="IL">ISRAEL</option>
                      <option value="IT">ITALY</option>
                      <option value="JM">JAMAICA</option>
                      <option value="JP">JAPAN</option>
                      <option value="JO">JORDAN</option>
                      <option value="KZ">KAZAKSTAN</option>
                      <option value="KE">KENYA</option>
                      <option value="KI">KIRIBATI</option>
                      <option value="KP">KOREA, DEMOCRATIC P</option>
                      <option value="KR">KOREA, REPUBLIC OF</option>
                      <option value="KW">KUWAIT</option>
                      <option value="KG">KYRGYZSTAN</option>
                      <option value="LA">LAO PEOPLE'S DEMOCR</option>
                      <option value="LV">LATVIA</option>
                      <option value="LB">LEBANON</option>
                      <option value="LS">LESOTHO</option>
                      <option value="LR">LIBERIA</option>
                      <option value="LY">LIBYAN ARAB JAMAHIR</option>
                      <option value="LI">LIECHTENSTEIN</option>
                      <option value="LT">LITHUANIA</option>
                      <option value="LU">LUXEMBOURG</option>
                      <option value="MO">MACAU</option>
                      <option value="MK">MACEDONIA, THE FORM</option>
                      <option value="MG">MADAGASCAR</option>
                      <option value="MW">MALAWI</option>
                      <option value="MY">MALAYSIA</option>
                      <option value="MV">MALDIVES</option>
                      <option value="ML">MALI</option>
                      <option value="MT">MALTA</option>
                      <option value="MH">MARSHALL ISLANDS</option>
                      <option value="MQ">MARTINIQUE</option>
                      <option value="MR">MAURITANIA</option>
                      <option value="MU">MAURITIUS</option>
                      <option value="YT">MAYOTTE</option>
                      <option value="MX">MEXICO</option>
                      <option value="FM">MICRONESIA, FEDERAT</option>
                      <option value="MD">MOLDOVA, REPUBLIC O</option>
                      <option value="MC">MONACO</option>
                      <option value="MN">MONGOLIA</option>
                      <option value="MS">MONTSERRAT</option>
                      <option value="MA">MOROCCO</option>
                      <option value="MZ">MOZAMBIQUE</option>
                      <option value="MM">MYANMAR</option>
                      <option value="NA">NAMIBIA</option>
                      <option value="NR">NAURU</option>
                      <option value="NP">NEPAL</option>
                      <option value="NL">NETHERLANDS</option>
                      <option value="AN">NETHERLANDS ANTILLE</option>
                      <option value="NC">NEW CALEDONIA</option>
                      <option value="NZ">NEW ZEALAND</option>
                      <option value="NI">NICARAGUA</option>
                      <option value="NE">NIGER</option>
                      <option value="NG">NIGERIA</option>
                      <option value="NU">NIUE</option>
                      <option value="NF">NORFOLK ISLAND</option>
                      <option value="MP">NORTHERN MARIANA IS</option>
                      <option value="NO">NORWAY</option>
                      <option value="OM">OMAN</option>
                      <option value="PK">PAKISTAN</option>
                      <option value="PW">PALAU</option>
                      <option value="PS">PALESTINIAN TERRITO</option>
                      <option value="PA">PANAMA</option>
                      <option value="PG">PAPUA NEW GUINEA</option>
                      <option value="PY">PARAGUAY</option>
                      <option value="PE">PERU</option>
                      <option value="PH">PHILIPPINES</option>
                      <option value="PN">PITCAIRN</option>
                      <option value="PL">POLAND</option>
                      <option value="PT">PORTUGAL</option>
                      <option value="PR">PUERTO RICO</option>
                      <option value="QA">QATAR</option>
                      <option value="RE">RUNION</option>
                      <option value="RO">ROMANIA</option>
                      <option value="RU">RUSSIAN FEDERATION</option>
                      <option value="RW">RWANDA</option>
                      <option value="SH">SAINT HELENA</option>
                      <option value="KN">SAINT KITTS AND NEV</option>
                      <option value="LC">SAINT LUCIA</option>
                      <option value="PM">SAINT PIERRE AND MI</option>
                      <option value="VC">SAINT VINCENT AND T</option>
                      <option value="WS">SAMOA</option>
                      <option value="SM">SAN MARINO</option>
                      <option value="ST">SAO TOME AND PRINCI</option>
                      <option value="SA">SAUDI ARABIA</option>
                      <option value="SN">SENEGAL</option>
                      <option value="SC">SEYCHELLES</option>
                      <option value="SL">SIERRA LEONE</option>
                      <option value="SG">SINGAPORE</option>
                      <option value="SK">SLOVAKIA</option>
                      <option value="SI">SLOVENIA</option>
                      <option value="SB">SOLOMON ISLANDS</option>
                      <option value="SO">SOMALIA</option>
                      <option value="ZA">SOUTH AFRICA</option>
                      <option value="GS">SOUTH GEORGIA AND T</option>
                      <option value="ES">SPAIN</option>
                      <option value="LK">SRI LANKA</option>
                      <option value="SD">SUDAN</option>
                      <option value="SR">SURINAME</option>
                      <option value="SJ">SVALBARD AND JAN MA</option>
                      <option value="SZ">SWAZILAND</option>
                      <option value="SE">SWEDEN</option>
                      <option value="CH">SWITZERLAND</option>
                      <option value="SY">SYRIAN ARAB REPUBLI</option>
                      <option value="TW">CHINAESE TAIBEI</option>
                      <option value="TJ">TAJIKISTAN</option>
                      <option value="TZ">TANZANIA, UNITED RE</option>
                      <option value="TH">THAILAND</option>
                      <option value="TG">TOGO</option>
                      <option value="TK">TOKELAU</option>
                      <option value="TO">TONGA</option>
                      <option value="TT">TRINIDAD AND TOBAGO</option>
                      <option value="TN">TUNISIA</option>
                      <option value="TR">TURKEY</option>
                      <option value="TM">TURKMENISTAN</option>
                      <option value="TC">TURKS AND CAICOS IS</option>
                      <option value="TV">TUVALU</option>
                      <option value="UG">UGANDA</option>
                      <option value="UA">UKRAINE</option>
                      <option value="AE">UNITED ARAB EMIRATE</option>
                      <option value="UK">UNITED KINGDOM</option>
                      <option value="US" selected >UNITED STATES</option>
                      <option value="UM">UNITED STATES MINOR</option>
                      <option value="UY">URUGUAY</option>
                      <option value="UZ">UZBEKISTAN</option>
                      <option value="VU">VANUATU</option>
                      <option value="VE">VENEZUELA</option>
                      <option value="VN">VIET NAM</option>
                      <option value="VG">VIRGIN ISLANDS, BRI</option>
                      <option value="VI">VIRGIN ISLANDS, U.S</option>
                      <option value="WF">WALLIS AND FUTUNA</option>
                      <option value="EH">WESTERN SAHARA</option>
                      <option value="YE">YEMEN</option>
                      <option value="YU">YUGOSLAVIA</option>
                      <option value="ZM">ZAMBIA</option>
                      <option value="ZW">ZIMBABWE</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td width="13%">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" width="13%">Purpose of Domain</td>
                  <td colspan="2"> 
                    <input type="radio" name="apppurpose" value="P1" checked>
                    Business use for profit<br>
                    <input type="radio" name="apppurpose" value="P2">
                    Non-profit business, club, association, religious organization, 
                    etc.<br>
                    <input type="radio" name="apppurpose" value="P3">
                    Personal Use<br>
                    <input type="radio" name="apppurpose" value="P4">
                    Education purposes<br>
                    <input type="radio" name="apppurpose" value="P5">
                    Government purposes<br>
                  </td>
                </tr>
              </table>
{/if}
            </td>
          </tr>
          <tr> 
            <td width="39%">&nbsp;</td>
            <td width="61%">&nbsp;</td>
          </tr>
          <tr> 
            <td width="39%">&nbsp;</td>
            <td width="61%"> 
              <input type="submit" name="Submit" value="Register domain">
            </td>
          </tr>
        </table>
        <br>
      </form>
      
    </td>
  </tr>
</table>
                  <p>&nbsp;</p>
