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
            <td width="25%">Alan adı için şifre:</td>
            <td width="25%"> 
              <input type="password" name="password1" value="{$password1}">
            </td>
            <td width="20%">Şifreyi tekrar girin:</td>
            <td width="30%"> 
              <input type="password" name="password2" value="{$password2}">
            </td>
          </tr>
        </table>
	    <br>
		
		        <br>
        <b>Kayıt Sahibi Bilgileri</b><br>
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Kayıt sahibinin tam adı</td>
            <td width="61%"> {$registrant }
            </td>
          </tr>
          <tr> 
            <td width="39%">Organizasyon adı</td>
            <td width="61%"> 
              <input type="text" name="r_org" value="{$r_org }">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1</td>
            <td width="61%"> 
              <input type="text" name="r_address1" value="{$r_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2</td>
            <td width="61%"> 
              <input type="text" name="r_address2" value="{$r_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3</td>
            <td width="61%"> 
              <input type="text" name="r_address3" value="{$r_address3 }" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir</td>
            <td width="61%"> 
              <input type="text" name="r_city" value="{$r_city }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl</td>
            <td width="61%"> 
              <input type="text" name="r_province" value="{ $r_province }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge</td>
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
            <td width="39%">Posta Kodu</td>
            <td width="61%"> 
              <input type="text" name="r_postalcode" value="{$r_postalcode }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon (örneğin: +1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="r_telephone" value="{ $r_telephone }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Faks (örneğin: +1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="r_fax" value="{ $r_fax }">
              <font color="#990000">*</font></td>
          </tr>
          <tr>
            <td width="39%">E-posta</td>
            <td width="61%">
              <input type="text" name="r_email" value="{$r_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br><br>
		
		<b>Yönetici Bilgileri</b><br>
        <center>
            <input type=button name="copy_r2a" value="Kayıt Sahibinden Yöneticiye Kopyala"
                 onClick="regToAdmin();">
        </center>   
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Yöneticinin tam adı</td>
            <td width="61%"> 
              <input type="text" name="administrator" value="{$administrator }">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Organizasyon adı</td>
            <td width="61%"> 
              <input type="text" name="a_org" value="{$a_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1</td>
            <td width="61%"> 
              <input type="text" name="a_address1" value="{$a_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2</td>
            <td width="61%"> 
              <input type="text" name="a_address2" value="{$a_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3</td>
            <td width="61%"> 
              <input type="text" name="a_address3" value="{$a_address3 }" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir</td>
            <td width="61%"> 
              <input type="text" name="a_city" value="{$a_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl</td>
            <td width="61%"> 
              <input type="text" name="a_province" value="{$a_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge</td>
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
            <td width="39%">Posta Kodu</td>
            <td width="61%"> 
              <input type="text" name="a_postalcode" value="{$a_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon (örneğin: +1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="a_telephone" value="{$a_telephone }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Faks (örneğin: +1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="a_fax" value="{$a_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-posta</td>
            <td width="61%"> 
              <input type="text" name="a_email" value="{ $a_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
		
		<b><br><br>
        Teknik İletişim Bilgileri</b><br>
        <center>
            <input type=button name="copy_r2a" value="Kayıt Sahibinden Teknik İletişime Kopyala"
                 onClick="regToTech();">
        </center> 
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Teknik İletişim Adı</td>
            <td width="61%"> 
              <input type="text" name="technical" value="{$technical}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Organizasyon adı</td>
            <td width="61%"> 
              <input type="text" name="t_org" value="{$t_org }">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1</td>
            <td width="61%"> 
              <input type="text" name="t_address1" value="{$t_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2</td>
            <td width="61%"> 
              <input type="text" name="t_address2" value="{$t_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3</td>
            <td width="61%"> 
              <input type="text" name="t_address3" value="{$t_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir</td>
            <td width="61%"> 
              <input type="text" name="t_city" value="{$t_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl</td>
            <td width="61%"> 
              <input type="text" name="t_province" value="{$t_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge</td>
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
            <td width="39%">Posta Kodu</td>
            <td width="61%"> 
              <input type="text" name="t_postalcode" value="{ $t_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon (örneğin: +1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="t_telephone" value="{ $t_telephone }">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Faks (örneğin: +1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="t_fax" value="{ $t_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-posta</td>
            <td width="61%"> 
              <input type="text" name="t_email" value="{$t_email }" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br>
		
        <br>
        <b>Fatura İletişim Bilgileri</b><br>
        <center>
            <input type=button name="copy_r2a" value="Kayıt Sahibinden Fatura İletişime Kopyala"
                 onClick="regToBilling();">
        </center> 
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Fatura İletişim Adı</td>
            <td width="61%">  
				<input type="text" name="billing" value="{$billing}">
				<font color="#990000">*</font> 
                
            </td>
          </tr>
          <tr> 
            <td width="39%">Organizasyon adı</td>
            <td width="61%"> 
			  <input type="text" name="b_org" value="{ $b_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1</td>
            <td width="61%"> 
              <input type="text" name="b_address1" value="{ $b_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2</td>
            <td width="61%"> 
              <input type="text" name="b_address2" value="{$b_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3</td>
            <td width="61%"> 
              <input type="text" name="b_address3" value="{ $b_address3 }" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir</td>
            <td width="61%"> 
              <input type="text" name="b_city" value="{$b_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl</td>
            <td width="61%"> 
              <input type="text" name="b_province" value=" {$b_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge</td>
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
            <td width="39%">Posta Kodu</td>
            <td width="61%"> 
              <input type="text" name="b_postalcode" value="{$b_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon (örneğin: +1.4156656387)</td>
            <td width="61%"> 
              <input type="text" name="b_telephone" value="{$b_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Faks (örneğin: +1.4156657168)</td>
            <td width="61%"> 
              <input type="text" name="b_fax" value="{ $b_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-posta</td>
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
              <input type="submit" name="Submit" value="Alan Adı İletişim Bilgilerini Değiştir">
            </td>
          </tr>
        </table>
        <br>
      </form>
      
    </td>
  </tr>
</table>
<p>&nbsp;</p>

