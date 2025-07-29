<br>
<form method="post" action={$php_self}>
<table width="51%" class="border1" style="padding: 1px" cellspacing="1" cellpadding="3" align="center">
    <tr>
	  <td class=cellBg align="center">
	    Dns:
	  </td>
	  <td class=cellBg align="center">
		 <input type="text" name="dns">
	  </td>
	  <td class=cellBg align="center">
                    IP: 
	</td>
          <td class=cellBg align="center">
		 <input type="text" name="ip">
	  </td>
	</tr>
</table>
<table width="52%" align="center">
	<tr><td>&nbsp;</td></tr>
	<tr>
	    <td align ="center">
			<input type="submit" name="Submit" value="Kayıt Et">&nbsp; &nbsp; &nbsp; &nbsp;
			<input type="reset" name="Reset" value="Sıfırla">
			<input type="hidden" name="action" value="registerDns">
		</td>
	</tr>
</table>
</form>

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
	<input type="hidden" name="member_name" value="{$member_name}">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%">Alan Adı:</td>
            <td width="28%">{$domain}{$product_info[3]}</td>
            <td width="12%">Fiyat:</td>
            <td width="35%">${$cur_price}/{$year}yr
<!--			<select name="year">
{php}/*

for($i = 1; $i < 11; $i ++)
{echo "test abc "; print_r ($product_price); echo " test cba "; flush();
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
}*/
{/php}
			</select>
            -->
            <input type=hidden name=year value="{$year}">
            </td>
          </tr>
          <tr> 
            <td width="25%">Alan Adı Parolası:</td>
            <td width="28%"> 
              <input type="password" name="password1" value="{$password1}">&nbsp;(6-12)
            </td>
            <td width="12%">Dns 1:</td>
            <td width="35%"> 
              <input type="text" name="dns1" value="{$dns1}">
            </td>
          </tr>
          <tr> 
            <td width="25%">Parola tekrar:</td>
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
        <b>Registrant Bilgileri</b><br>
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Tam Adı:</td>
            <td width="61%"> 
              <input type="text" name="registrant" value="{$registrant}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Kurum Adı:</td>
            <td width="61%"> 
              <input type="text" name="r_org" value="{$r_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1:</td>
            <td width="61%"> 
              <input type="text" name="r_address1" value="{$r_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2:</td>
            <td width="61%"> 
              <input type="text" name="r_address2" value="{$r_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3:</td>
            <td width="61%"> 
              <input type="text" name="r_address3" value="{$r_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir:</td>
            <td width="61%"> 
              <input type="text" name="r_city" value="{$r_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl:</td>
            <td width="61%"> 
              <input type="text" name="r_province" value="{$r_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge:</td>
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
            <td width="39%">Posta Kodu:</td>
            <td width="61%"> 
              <input type="text" name="r_postalcode" value="{$r_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon(örneğin:+1.4156656387):</td>
            <td width="61%"> 
              <input type="text" name="r_telephone" value="{$r_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(örneğin:+1.4156657168):</td>
            <td width="61%"> 
              <input type="text" name="r_fax" value="{$r_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr>
            <td width="39%">E-posta:</td>
            <td width="61%">
              <input type="text" name="r_email" value="{$r_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br><br>
        <b>Yönetici Bilgileri</b><br>
        <center>
            <input type=button name="copy_r2a" value="Registrant Bilgilerini Yöneticiye Kopyala"
                 onClick="regToAdmin();">
        </center>  
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Yönetici Tam Adı:</td>
            <td width="61%"> 
              <input type="text" name="administrator" value="{$administrator}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Kurum Adı:</td>
            <td width="61%"> 
              <input type="text" name="a_org" value="{$a_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1:</td>
            <td width="61%"> 
              <input type="text" name="a_address1" value="{$a_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2:</td>
            <td width="61%"> 
              <input type="text" name="a_address2" value="{$a_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3:</td>
            <td width="61%"> 
              <input type="text" name="a_address3" value="{$a_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir:</td>
            <td width="61%"> 
              <input type="text" name="a_city" value="{$a_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl:</td>
            <td width="61%"> 
              <input type="text" name="a_province" value="{$a_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge:</td>
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
            <td width="39%">Posta Kodu:</td>
            <td width="61%"> 
              <input type="text" name="a_postalcode" value="{$a_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon(örneğin:+1.4156656387):</td>
            <td width="61%"> 
              <input type="text" name="a_telephone" value="{$a_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(örneğin:+1.4156657168):</td>
            <td width="61%"> 
              <input type="text" name="a_fax" value="{$a_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-posta:</td>
            <td width="61%"> 
              <input type="text" name="a_email" value="{$a_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <b><br><br>
        Teknik İletişim Bilgileri</b><br>
        <center>
            <input type=button name="copy_r2a" value="Registrant Bilgilerini Teknik İletişime Kopyala."
                 onClick="regToTech();">
        </center> 
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Teknik İletişim Tam Adı:</td>
            <td width="61%"> 
              <input type="text" name="technical" value="{$technical}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Kurum Adı:</td>
            <td width="61%"> 
              <input type="text" name="t_org" value="{$t_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1:</td>
            <td width="61%"> 
              <input type="text" name="t_address1" value="{$r_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2:</td>
            <td width="61%"> 
              <input type="text" name="t_address2" value="{$t_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3:</td>
            <td width="61%"> 
              <input type="text" name="t_address3" value="{$t_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir:</td>
            <td width="61%"> 
              <input type="text" name="t_city" value="{$t_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl:</td>
            <td width="61%"> 
              <input type="text" name="t_province" value="{$t_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge:</td>
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
            <td width="39%">Posta Kodu:</td>
            <td width="61%"> 
              <input type="text" name="t_postalcode" value="{$t_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon(örneğin:+1.4156656387):</td>
            <td width="61%"> 
              <input type="text" name="t_telephone" value="{$t_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(örneğin:+1.4156657168):</td>
            <td width="61%"> 
              <input type="text" name="t_fax" value="{$t_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-posta:</td>
            <td width="61%"> 
              <input type="text" name="t_email" value="{$t_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
        </table>
        <br><br>
        <b>Fatura İletişim Bilgileri</b><br>
        <center>
            <input type=button name="copy_r2a" value="Registrant Bilgilerini Fatura İletişime Kopyala"
                 onClick="regToBilling();">
        </center> 
        <hr size="1" noshade>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%">Fatura İletişim Tam Adı:</td>
            <td width="61%"> 
              <input type="text" name="billing" value="{$billing}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Kurum Adı:</td>
            <td width="61%"> 
              <input type="text" name="b_org" value="{$b_org}">
              <font color="#990000">*</font> </td>
          </tr>
          <tr> 
            <td width="39%">Adres 1:</td>
            <td width="61%"> 
              <input type="text" name="b_address1" value="{$b_address1}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Adres 2:</td>
            <td width="61%"> 
              <input type="text" name="b_address2" value="{$b_address2}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Adres 3:</td>
            <td width="61%"> 
              <input type="text" name="b_address3" value="{$b_address3}" size="30">
            </td>
          </tr>
          <tr> 
            <td width="39%">Şehir:</td>
            <td width="61%"> 
              <input type="text" name="b_city" value="{$b_city}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Eyalet/İl:</td>
            <td width="61%"> 
              <input type="text" name="b_province" value="{$b_province}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Ülke/Bölge:</td>
            <td width="61%"> 
              <select name="b_country">
        	
			{foreach key=key item=val from=$countries} 
				{if $key == $b_country}
					<option value= {$key} selected>{$val}</option>
				{else}
					<option value= {$key}> {$val}</option>
				{/if}
		    {/foreach}

              </select>
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Posta Kodu:</td>
            <td width="61%"> 
              <input type="text" name="b_postalcode" value="{$b_postalcode}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Telefon(örneğin:+1.4156656387):</td>
            <td width="61%"> 
              <input type="text" name="b_telephone" value="{$b_telephone}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">Fax(örneğin:+1.4156657168):</td>
            <td width="61%"> 
              <input type="text" name="b_fax" value="{$b_fax}">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td width="39%">E-posta:</td>
            <td width="61%"> 
              <input type="text" name="b_email" value="{$b_email}" size="30">
              <font color="#990000">*</font></td>
          </tr>
          <tr> 
            <td colspan="2">

{if $product_info[3] == ".us"}

			<br>
              <b>NEXUS Bilgileri</b><br>
              <hr size="1" noshade>
              <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
                <tr>
                  <td colspan="3">Bu gereklilik, yalnızca Amerika Birleşik Devletleri'yle yasal bir bağı olan bireylerin veya kuruluşların .us alan adları için kayıt yaptırmalarını sağlamayı amaçlamaktadır.</td>
                </tr>
                <tr>
                  <td colspan="3">Lütfen uygun durumunuzu seçin</td>
                </tr>
                <tr>
                  <td width="13%">Kategori</td>
                  <td width="28%" valign="top"> 
                    <input type="radio" name="category" value="C11" checked>
                    Kategori 1: (1)</td>
                  <td width="59%">Bir doğal kişi: Amerika Birleşik Devletleri vatandaşı</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C12">
                    Kategori 1: (2)</td>
                  <td width="59%">Bir doğal kişi: Amerika Birleşik Devletleri veya herhangi bir mülkü veya bölgesinde daimi ikamet eden</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C21">
                    Kategori 2: (1)</td>
                  <td width="59%">Amerika Birleşik Devletleri'nde bir eyalet, Columbia Bölgesi veya Amerika Birleşik Devletleri'nin herhangi bir mülkü veya bölgesinde kurulmuş bir kuruluş veya başka bir varlık ya da Amerika Birleşik Devletleri'nde federal, eyalet veya yerel hükümet veya bir politik alt birim</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C31">
                    Kategori 3: (1)</td>
                  <td width="59%">Amerika Birleşik Devletleri veya herhangi bir mülkünde veya bölgesinde yasal faaliyetlerde (mal veya hizmet satışı veya diğer ticari, ticari olmayan, kar amacı gütmeyen ilişkiler dahil) bulunan bir kuruluş</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%"> 
                    <input type="radio" name="category" value="C32">
                    Kategori 3: (2)</td>
                  <td width="59%">Amerika Birleşik Devletleri veya herhangi bir mülkünde veya bölgesinde yerleşik bir varlık: Amerika Birleşik Devletleri'nde bir ofis veya başka bir tesise sahip bir varlık</td>
                </tr>
                <tr>
                  <td width="13%">&nbsp;</td>
                </tr>
                <tr>
                  <td width="13%"></td>
                  <td valign="top" width="28%">Kategori 3 İçin Ülke</td>
                  <td width="59%"> 
                    <select name="validator">
                      <option value="AF">AFGANİSTAN</option>
                      <option value="AL">ARNAVUTLUK</option>
                      <option value="BW">BOTSVANA</option>
                      <option value="DZ">CEZAYİR</option>
                      <option value="AS">AMERİKAN SAMOASI</option>
                      <option value="AD">ANDORRA</option>
                      <option value="AO">ANGOLA</option>
                      <option value="AI">ANGUILLA</option>
                      <option value="AQ">ANTARKTİKA</option>
                      <option value="AG">ANTIGUA VE BARBUDA</option>
                      <option value="AR">ARJANTİN</option>
                      <option value="AM">ERMENİSTAN</option>
                      <option value="AW">ARUBA</option>
                      <option value="AU">AVUSTRALYA</option>
                      <option value="AT">AVUSTURYA</option>
                      <option value="AZ">AZERBAYCAN</option>
                      <option value="BS">Bahamalar</option>
                      <option value="BH">BAHREYN</option>
                      <option value="BD">BANGLADEŞ</option>
                      <option value="BB">BARBADOS</option>
                      <option value="BY">BELARUS</option>
                      <option value="BE">BELÇİKA</option>
                      <option value="BZ">BELİZE</option>
                      <option value="BJ">BENİN</option>
                      <option value="BM">BERMUDA</option>
                      <option value="BT">BHUTAN</option>
                      <option value="BO">BOLİVYA</option>
                      <option value="BA">BOSNA HERSEK</option>
                      <option value="BV">BOUVET ADASI</option>
                      <option value="BR">BREZİLYA</option>
                      <option value="IO">BRİTANYA HİNDİSTAN OKEANI</option>
                      <option value="BN">BRUNEI</option>
                      <option value="BG">BULGARİSTAN</option>
                      <option value="BF">BURKİNA FASO</option>
                      <option value="BI">BURUNDİ</option>
                      <option value="KH">KAMBOÇYA</option>
                      <option value="CM">KAMERUN</option>
                      <option value="CA">KANADA</option>
                      <option value="CV">YEŞİL BURUN ADALARI</option>
                      <option value="KY">CAYMAN ADALARI</option>
                      <option value="CF">ORTA AFRİKA CUMHURİYETİ</option>
                      <option value="TD">ÇAD</option>
                      <option value="CL">ŞİLİ</option>
                      <option value="CN">ÇİN</option>
                      <option value="CX">CHRISTMAS ADASI</option>
                      <option value="CC">COCOS (KEELING) ADALARI</option>
                      <option value="CO">KOLOMBİYA</option>
                      <option value="KM">KOMOROS</option>
                      <option value="CG">KONGO</option>
                      <option value="CD">KONGO, DEMOKRATİK CUMHURİYETİ</option>
                      <option value="CK">COOK ADALARI</option>
                      <option value="CR">KOSTA RİKA</option>
                      <option value="CI">FİLDİŞİ SAHİLİ</option>
                      <option value="HR">HIRVATİSTAN</option>
                      <option value="CU">KÜBA</option>
                      <option value="CY">KIBRIS</option>
                      <option value="CZ">ÇEKYA</option>
                      <option value="DK">DANİMARKA</option>
                      <option value="DJ">CİBUTİ</option>
                      <option value="DM">DOMİNİKA</option>
                      <option value="DO">DOMİNİK CUMHURİYETİ</option>
                      <option value="TP">DOĞU TİMOR</option>
                      <option value="EC">EKVATOR</option>
                      <option value="EG">MISIR</option>
                      <option value="SV">EL SALVADOR</option>
                      <option value="GQ">Ekvator Ginesi</option>
                      <option value="ER">ERİTRE</option>
                      <option value="EE">ESTONYA</option>
                      <option value="ET">ETİYOPYA</option>
                      <option value="FK">FALKLAND ADALARI</option>
                      <option value="FO">FAROE ADALARI</option>
                      <option value="FJ">FİJİ</option>
                      <option value="FI">FİNLANDİYA</option>
                      <option value="FR">FRANSA</option>
                      <option value="GF">FRANSIZ GUYANASI</option>
                      <option value="PF">FRANSIZ POLİNEZYASI</option>
                      <option value="TF">FRANSIZ GÜNEY TOPRAKLARI</option>
                      <option value="GA">GABON</option>
                      <option value="GM">GAMBİYA</option>
                      <option value="GE">GÜRCİSTAN</option>
                      <option value="DE">ALMANYA</option>
                      <option value="GH">GANA</option>
                      <option value="GI">CEBELİTARIK</option>
                      <option value="GR">YUNANİSTAN</option>
                      <option value="GL">GRÖNLAND</option>
                      <option value="GD">GRENADA</option>
                      <option value="GP">GUADELOUPE</option>
                      <option value="GU">GUAM</option>
                      <option value="GT">GUATEMALA</option>
                      <option value="GN">GİNE</option>
                      <option value="GW">GİNE-BİSSAU</option>
                      <option value="GY">GUYANA</option>
                      <option value="HT">HAİTİ</option>
                      <option value="HM">HEARD ADASI VE MCDONALD ADALARI</option>
                      <option value="VA">VATİKAN</option>
                      <option value="HN">HONDURAS</option>
                      <option value="HK">HONG KONG</option>
                      <option value="HU">MACARİSTAN</option>
                      <option value="IS">İZLANDA</option>
                      <option value="IN">HİNDİSTAN</option>
                      <option value="ID">ENDONEZYA</option>
                      <option value="IR">İRAN</option>
                      <option value="IQ">IRAK</option>
                      <option value="IE">İRLANDA</option>
                      <option value="IL">İSRAİL</option>
                      <option value="IT">İTALYA</option>
                      <option value="JM">JAMAİKA</option>
                      <option value="JP">JAPONYA</option>
                      <option value="JO">ÜRDÜN</option>
                      <option value="KZ">KAZAKİSTAN</option>
                      <option value="KE">KENYA</option>
                      <option value="KI">KİRİBATİ</option>
                      <option value="KP">KUZEY KORE</option>
                      <option value="KR">GÜNEY KORE</option>
                      <option value="KW">KUVEYT</option>
                      <option value="KG">KIRGIZİSTAN</option>
                      <option value="LA">LAOS</option>
                      <option value="LV">LETONYA</option>
                      <option value="LB">LÜBNAN</option>
                      <option value="LS">LESOTO</option>
                      <option value="LR">LİBERYA</option>
                      <option value="LY">LİBYA</option>
                      <option value="LI">LİHTENŞTAYN</option>
                      <option value="LT">LİTVANYA</option>
                      <option value="LU">LÜKSEMBURG</option>
                      <option value="MO">MACAU</option>
                      <option value="MK">KUZEY MAKEDONYA</option>
                      <option value="MG">MADAGASKAR</option>
                      <option value="MW">MALAVİ</option>
                      <option value="MY">MALEZYA</option>
                      <option value="MV">MALDİVLER</option>
                      <option value="ML">MALİ</option>
                      <option value="MT">MALTA</option>
                      <option value="MH">MARSHALL ADALARI</option>
                      <option value="MQ">MARTİNİK</option>
                      <option value="MR">MAVRİTANYA</option>
                      <option value="MU">MAURİTİUS</option>
                      <option value="YT">MAYOTTE</option>
                      <option value="MX">MEKSİKA</option>
                      <option value="FM">MİKRONEZYA</option>
                      <option value="MD">MOLDOVA</option>
                      <option value="MC">MONAKO</option>
                      <option value="MN">MOĞOLİSTAN</option>
                      <option value="MS">MONTSERRAT</option>
                      <option value="MA">FAS</option>
                      <option value="MZ">MOZAMBİK</option>
                      <option value="MM">MYANMAR</option>
                      <option value="NA">NAMİBYA</option>
                      <option value="NR">NAURU</option>
                      <option value="NP">NEPAL</option>
                      <option value="NL">HOLLANDA</option>
                      <option value="AN">HOLLANDA ANTİLLERİ</option>
                      <option value="NC">YENİ KALEDONYA</option>
                      <option value="NZ">YENİ ZELANDA</option>
                      <option value="NI">NİKARAGUA</option>
                      <option value="NE">NİJER</option>
                      <option value="NG">NİJERYA</option>
                      <option value="NU">NİUE</option>
                      <option value="NF">NORFOLK ADASI</option>
                      <option value="MP">KUZEY MARIANA ADALARI</option>
                      <option value="NO">NORVEÇ</option>
                      <option value="OM">UMMAN</option>
                      <option value="PK">PAKİSTAN</option>
                      <option value="PW">PALAU</option>
                      <option value="PS">FİLİSTİN TOPRAKLARI</option>
                      <option value="PA">PANAMA</option>
                      <option value="PG">PAPUA YENİ GİNE</option>
                      <option value="PY">PARAGUAY</option>
                      <option value="PE">PERU</option>
                      <option value="PH">FİLİPİNLER</option>
                      <option value="PN">PITCAIRN ADALARI</option>
                      <option value="PL">POLONYA</option>
                      <option value="PT">PORTEKİZ</option>
                      <option value="PR">PORTO RİKO</option>
                      <option value="QA">KATAR</option>
                      <option value="RE">REUNİON</option>
                      <option value="RO">ROMANYA</option>
                      <option value="RU">RUSYA</option>
                      <option value="RW">RUANDA</option>
                      <option value="SH">AZİZ HELENA</option>
                      <option value="KN">AZİZ KİTS VE NEVİS</option>
                      <option value="LC">AZİZ LUCİA</option>
                      <option value="PM">AZİZ PİERRE VE MİQUELON</option>
                      <option value="VC">AZİZ VİNCENT VE GRENADİNLER</option>
                      <option value="WS">SAMOA</option>
                      <option value="SM">SAN MARİNO</option>
                      <option value="ST">SAO TOME VE PRİNCİPE</option>
                      <option value="SA">SUUDİ ARABİSTAN</option>
                      <option value="SN">SENEGAL</option>
                      <option value="SC">SEYŞELLER</option>
                      <option value="SL">SİERRA LEONE</option>
                      <option value="SG">SİNGAPUR</option>
                      <option value="SK">SLOVAKYA</option>
                      <option value="SI">SLOVENYA</option>
                      <option value="SB">SOLOMON ADALARI</option>
                      <option value="SO">SOMALİ</option>
                      <option value="ZA">GÜNEY AFRİKA</option>
                      <option value="GS">GÜNEY GÜRCİSTAN VE GÜNEY SANDWİCH ADALARI</option>
                      <option value="ES">İSPANYA</option>
                      <option value="LK">SRİ LANKA</option>
                      <option value="SD">SUDAN</option>
                      <option value="SR">SURİNAM</option>
                      <option value="SJ">SVALBARD VE JAN MAYEN</option>
                      <option value="SZ">SWAZILAND</option>
                      <option value="SE">İSVEÇ</option>
                      <option value="CH">İSVİÇRE</option>
                      <option value="SY">SURİYE</option>
                      <option value="TW">ÇİN TAYPEİ</option>
                      <option value="TJ">Tacikistan</option>
                      <option value="TZ">TANZANYA</option>
                      <option value="TH">TAYLAND</option>
                      <option value="TG">TOGO</option>
                      <option value="TK">TOKELAU</option>
                      <option value="TO">TONGA</option>
                      <option value="TT">TRİNİDAD VE TOBAGO</option>
                      <option value="TN">TUNUS</option>
                      <option value="TR">TÜRKİYE</option>
                      <option value="TM">TÜRKMENİSTAN</option>
                      <option value="TC">TURKS VE CAİCOS ADALARI</option>
                      <option value="TV">TUVALU</option>
                      <option value="UG">UGANDA</option>
                      <option value="UA">UKRAYNA</option>
                      <option value="AE">BİRLEŞİK ARAP EMİRLİKLERİ</option>
                      <option value="UK">BİRLEŞİK KRALLIK</option>
                      <option value="US" selected>AMERİKA BİRLEŞİK DEVLETLERİ</option>
                      <option value="UM">ABD UZAK ADALARI</option>
                      <option value="UY">URUGUAY</option>
                      <option value="UZ">ÖZBEKİSTAN</option>
                      <option value="VU">VANUATU</option>
                      <option value="VE">VENEZUELA</option>
                      <option value="VN">VİETNAM</option>
                      <option value="VG">BRİTANYA VİRJİN ADALARI</option>
                      <option value="VI">ABD VİRJİN ADALARI</option>
                      <option value="WF">WALLİS VE FUTUNA</option>
                      <option value="EH">BATI SAHRA</option>
                      <option value="YE">YEMEN</option>
                      <option value="YU">YUGOSLAVYA</option>
                      <option value="ZM">ZAMBİYA</option>
                      <option value="ZW">ZİMBABWE</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td width="13%">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" width="13%">Alan Adı Amacı</td>
                  <td colspan="2"> 
                    <input type="radio" name="apppurpose" value="P1" checked>
                    Ticari kullanım için kar amacı<br>
                    <input type="radio" name="apppurpose" value="P2">
                    Kar amacı gütmeyen iş, kulüp, dernek, dini kuruluş vb.<br>
                    <input type="radio" name="apppurpose" value="P3">
                    Kişisel Kullanım<br>
                    <input type="radio" name="apppurpose" value="P4">
                    Eğitim amaçlı<br>
                    <input type="radio" name="apppurpose" value="P5">
                    Hükümet amaçlı<br>
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
              <input type="submit" name="Submit" value="Alan Adı Kaydet">
            </td>
          </tr>
        </table>
        <br>
      </form>
      
    </td>
  </tr>
</table>
                  <p>&nbsp;</p>

