<br>
<form action={$php_self} method="POST">
  <table class="border1" align="center">
    <tr>
        <td class="cellBg" colspan=2>
            <input type=radio name=payment_method value="paypal" {$pp_checked}> Paypal </td>
    </tr>
    <tr>
        <td class="cellBg" align="right"> Paypal e-posta hesabı &nbsp;&nbsp;</td>
        <td class="cellBg2">
            <input type=text size="20" maxlength="128" value="{$pp_email}" name="pp_email"></td>
    </tr>
    <tr><td class="cellBg" colspan="2">&nbsp;</td></tr>

    <tr>
        <td class="cellBg" colspan=2>
            <input type=radio name=payment_method value="creditcard" {$cc_checked}> Kredi Kartı </td>
    </tr>
	<tr>
		<td class="cellBg" align="right">Kredi kartı&nbsp;&nbsp;</td>
		<td class="cellBg2">
           <select name="cc_name">
                {if $cc_name != ''} 
                        <option value="{$cc_name}" selected> {$cc_name} </option>
                {else}
                        <option value="">Kart seçin</option>
                {/if}
				<option value="VISA">Visa</option>
				<option value="MASTERCARD">MasterCard</option>
				<option value="DISCOVER">Discover</option>
				<option value="AMEX">American Express</option>
				<option value="JCB">JCB</option>
				<option value="DINERS">Diner's Club/Carte Blanche</option>
	    	</select>
		</td>
	</tr>
		
	<tr>
		<td class="cellBg" align="right">Kredi Kartı Numarası&nbsp;&nbsp;</td>
		<td class="cellBg2"><input type=text size="20" name=cc_num maxlength="16" value="{$cc_num}"></td>
	</tr>	

	<tr>
		<td class="cellBg" align="right">Son Kullanma Tarihi&nbsp;&nbsp;</td>
		<td class="cellBg2">
			<select name="exp_date">
                {if $exp_date != ''}
                    <option value="{$exp_date}"> {$exp_date} </option>
				{else}
                    <option value="">Ay seçin</option>
                {/if}
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select> &nbsp; 
			<select name="exp_year">
                {if $exp_year != ''}
                    <option value="{$exp_year}"> {$exp_year} </option>
                {else}
                    <option value="">Yıl seçin</option>
                {/if}
{assign var="start_year" value=$smarty.now|date_format:"%Y"}
{assign var="end_year" value=$start_year+15}

{section name=year loop=$end_year - $start_year + 1}
    {assign var="year_value" value=$start_year + $smarty.section.year.index}
    <option value="{$year_value}">{$year_value}</option>
{/section}
			</select>
		</td>
	</tr>

	<tr>
		<td class="cellBg" align="right">Kart Sahibinin Adı&nbsp;&nbsp;</td>
		<td class="cellBg2"><input type=text size="20" maxlength="128" value="{$cc_user}" name="cc_user"></td>
	</tr>

	<tr>
		<td class="cellBg" align="right">Kart ID Numarası&nbsp;&nbsp;<br/>&nbsp;</td>
		<td class="cellBg2"><input type=text size="4" maxlength="4" value="{$cc_id}" name="cc_id">&nbsp;(Güvenliğiniz için gereklidir)<br>
            <a href="#" target="blank">Bu nedir?</a>
        </td>
	</tr>
   <tr><td class="cellBg" colspan="2">&nbsp;</td></tr>
	<tr>
		<td class="cellBg" colspan="2" class="text"><b>Kredi Kartı Fatura Adresi</b></td>
	</tr>
    <tr>
		<td class="cellBg" align="right">Kart Sahibinin E-postası&nbsp;</td>
		<td class="cellBg2"><input type=text size="20" maxlength="128" value="{$cc_email}" name="cc_email"></td>
	</tr>
	<tr>
		<td class="cellBg" align="right">Adres&nbsp;&nbsp;</td>
		<td class="cellBg2"><input type=text size="20" maxlength="41" value="{$cc_addr}" name="cc_addr"></td>
	</tr>
	<tr>
		<td class="cellBg" align="right">Şehir&nbsp;&nbsp;</td>
		<td class="cellBg2"><input type=text size="20" maxlength="30" value="{$cc_city}" name="cc_city"></td>
	</tr>
	<tr>
		<td class="cellBg" align="right">Eyalet/İl&nbsp;&nbsp;</td>
		<td class="cellBg2"><input type=text size="20" maxlength="40" value="{$cc_state}" name="cc_state"></td>
	</tr>
	<tr>
		<td class="cellBg" align="right">Posta Kodu&nbsp;&nbsp;</td>
		<td class="cellBg2"><input type=text size="20" maxlength="15" value="{$cc_zip}" name="cc_zip"><br></td>
	</tr>
    <tr> 
        <td class="cellBg" align="right">Telefon &nbsp; &nbsp;</td>
        <td class="cellBg2"><input type=text size="20" maxlength="15" value="{$cc_tel}" name="cc_tel"><br></td>
    </tr>
    <tr> 
        <td class="cellBg" align="right">Faks &nbsp; &nbsp;</td>
        <td class="cellBg2"><input type=text size="20" maxlength="15" value="{$cc_fax}" name="cc_fax"><br></td>
    </tr>
	<tr>
		<td class="cellBg" align="right">Ülke&nbsp;&nbsp;</td>
		<td class="cellBg2"><select name="cc_country">
		    {if $cc_country != ''}
                <option value="{$cc_country}">{$cc_country}</option>
            {else}
		        <option value="" >Ülke seçin</option>
            {/if}
		      		<option value="US">Amerika Birleşik Devletleri</option>
		      		<option value="AF">Afganistan</option>
		      		<option value="AL">Arnavutluk</option>
		      		<option value="DZ">Cezayir</option>
		      		<option value="AS">Amerikan Samoası</option>
		      		<option value="AD">Andorra</option>
		      		<option value="AO">Angola</option>
		      		<option value="AI">Anguilla</option>
		      		<option value="AQ">Antarktika</option>
		      		<option value="AG">Antigua ve Barbuda</option>
		      		<option value="AR">Arjantin</option>
		      		<option value="AM">Ermenistan</option>
		      		<option value="AW">Aruba</option>
		      		<option value="AU">Avustralya</option>
		      		<option value="AT">Avusturya</option>
		      		<option value="AZ">Azerbaycan</option>
		      		<option value="BS">Bahamalar</option>
		      		<option value="BH">Bahreyn</option>
		      		<option value="BD">Bangladeş</option>
		      		<option value="BB">Barbados</option>
		      		<option value="BY">Belarus</option>
		      		<option value="BE">Belçika</option>
		      		<option value="BZ">Belize</option>
		      		<option value="BJ">Benin</option>
		      		<option value="BM">Bermuda</option>
		      		<option value="BT">Butan</option>
		      		<option value="BO">Bolivya</option>
		      		<option value="BA">Bosna Hersek</option>
		      		<option value="BW">Botsvana</option>
		      		<option value="BV">Bouvet Adası</option>
		      		<option value="BR">Brezilya</option>
		      		<option value="IO">Britanya Hint Okyanusu Toprakları</option>
		      		<option value="BN">Brunei</option>
		      		<option value="BG">Bulgaristan</option>
		      		<option value="BF">Burkina Faso</option>
		      		<option value="BI">Burundi</option>
		      		<option value="KH">Kamboçya</option>
		      		<option value="CM">Kamerun</option>
		      		<option value="CA">Kanada</option>
		      		<option value="CV">Cape Verde</option>
		      		<option value="KY">Cayman Adaları</option>
		      		<option value="CF">Orta Afrika Cumhuriyeti</option>
		      		<option value="TD">Çad</option>
		      		<option value="CL">Şili</option>
		      		<option value="CN">Çin</option>
		      		<option value="CX">Christmas Adası</option>
		      		<option value="CC">Cocos (Keeling) Adaları</option>
		      		<option value="CO">Kolombiya</option>
		      		<option value="KM">Komorlar</option>
		      		<option value="CG">Kongo</option>
		      		<option value="CD">Kongo Demokratik Cumhuriyeti</option>
		      		<option value="CK">Cook Adaları</option>
		      		<option value="CR">Kosta Rika</option>
		      		<option value="CI">Fildişi Sahili</option>
		      		<option value="HR">Hırvatistan</option>
		      		<option value="CY">Kıbrıs</option>
		      		<option value="CZ">Çek Cumhuriyeti</option>
		      		<option value="CS">Çekoslovakya</option>
		      		<option value="DK">Danimarka</option>
		      		<option value="DJ">Cibuti</option>
		      		<option value="DM">Dominika</option>
		      		<option value="DO">Dominik Cumhuriyeti</option>
		      		<option value="TP">Doğu Timor</option>
		      		<option value="EC">Ekvador</option>
		      		<option value="EG">Mısır</option>
		      		<option value="SV">El Salvador</option>
		      		<option value="GQ">Ekvator Ginesi</option>
		      		<option value="ER">Eritre</option>
		      		<option value="EE">Estonya</option>
		      		<option value="ET">Etiyopya</option>
		      		<option value="FK">Falkland Adaları</option>
		      		<option value="FO">Faroe Adaları</option>
		      		<option value="FJ">Fiji</option>
		      		<option value="FI">Finlandiya</option>
		      		<option value="FR">Fransa</option>
		      		<option value="GF">Fransız Guyanası</option>
		      		<option value="PF">Fransız Polinezyası</option>
		      		<option value="TF">Fransız Güney Toprakları</option>
		      		<option value="GA">Gabon</option>
		      		<option value="GM">Gambiya</option>
		      		<option value="GE">Gürcistan</option>
		      		<option value="DE">Almanya</option>
		      		<option value="GH">Gana</option>
		      		<option value="GI">Cebelitarık</option>
		      		<option value="GB">Büyük Britanya</option>
		      		<option value="GR">Yunanistan</option>
		      		<option value="GL">Grönland</option>
		      		<option value="GD">Grenada</option>
		      		<option value="GP">Guadeloupe</option>
		      		<option value="GU">Guam</option>
		      		<option value="GT">Guatemala</option>
		      		<option value="GG">Guernsey</option>
		      		<option value="GN">Gine</option>
		      		<option value="GW">Gine-Bissau</option>
		      		<option value="GY">Guyana</option>
		      		<option value="HT">Haiti</option>
		      		<option value="HM">Heard ve Mc Donald Adaları</option>
		      		<option value="HN">Honduras</option>
		      		<option value="HK">Hong Kong</option>
		      		<option value="HU">Macaristan</option>
		      		<option value="IS">İzlanda</option>
		      		<option value="IN">Hindistan</option>
		      		<option value="IQ">Irak</option>
		      		<option value="IE">İrlanda</option>
		      		<option value="IM">Man Adası</option>
		      		<option value="IL">İsrail</option>
		      		<option value="IT">İtalya</option>
		      		<option value="JM">Jamaika</option>
		      		<option value="JP">Japonya</option>
		      		<option value="JE">Jersey</option>
		      		<option value="JO">Ürdün</option>
		      		<option value="KZ">Kazakistan</option>
		      		<option value="KE">Kenya</option>
		      		<option value="KI">Kiribati</option>
		      		<option value="KR">Güney Kore</option>
		      		<option value="KW">Kuveyt</option>
		      		<option value="KG">Kırgızistan</option>
		      		<option value="LA">Laos</option>
		      		<option value="LV">Letonya</option>
		      		<option value="LB">Lübnan</option>
		      		<option value="LS">Lesotho</option>
		      		<option value="LR">Liberya</option>
		      		<option value="LY">Libya</option>
		      		<option value="LI">Lihtenştayn</option>
		      		<option value="LT">Litvanya</option>
		      		<option value="LU">Lüksemburg</option>
		      		<option value="MO">Makao</option>
		      		<option value="MK">Makedonya</option>
		      		<option value="MG">Madagaskar</option>
		      		<option value="MW">Malavi</option>
		      		<option value="MY">Malezya</option>
		      		<option value="MV">Maldivler</option>
		      		<option value="ML">Mali</option>
		      		<option value="MT">Malta</option>
		      		<option value="MH">Marshall Adaları</option>
		      		<option value="MQ">Martinik</option>
		      		<option value="MR">Moritanya</option>
		      		<option value="MU">Mauritius</option>
		      		<option value="YT">Mayotte</option>
		      		<option value="MX">Meksika</option>
		      		<option value="FM">Mikronezya</option>
		      		<option value="MD">Moldova</option>
		      		<option value="MC">Monako</option>
		      		<option value="MN">Moğolistan</option>
		      		<option value="MS">Montserrat</option>
		      		<option value="MA">Fas</option>
		      		<option value="MZ">Mozambik</option>
		      		<option value="MM">Myanmar</option>
		      		<option value="NA">Namibya</option>
		      		<option value="NR">Nauru</option>
		      		<option value="NP">Nepal</option>
		      		<option value="NL">Hollanda</option>
		      		<option value="AN">Hollanda Antilleri</option>
		      		<option value="NT">Tarafsız Bölge</option>
		      		<option value="NC">Yeni Kaledonya</option>
		      		<option value="NZ">Yeni Zelanda</option>
		      		<option value="NI">Nikaragua</option>
		      		<option value="NE">Nijer</option>
		      		<option value="NG">Nijerya</option>
		      		<option value="NU">Niue</option>
		      		<option value="NF">Norfolk Adası</option>
		      		<option value="MP">Kuzey Mariana Adaları</option>
		      		<option value="NO">Norveç</option>
		      		<option value="OM">Umman</option>
		      		<option value="PK">Pakistan</option>
		      		<option value="PW">Palau</option>
		      		<option value="PA">Panama</option>
		      		<option value="PG">Papua Yeni Gine</option>
		      		<option value="PY">Paraguay</option>
		      		<option value="PE">Peru</option>
		      		<option value="PH">Filipinler</option>
		      		<option value="PN">Pitcairn</option>
		      		<option value="PL">Polonya</option>
		      		<option value="PT">Portekiz</option>
		      		<option value="PR">Porto Riko</option>
		      		<option value="QA">Katar</option>
		      		<option value="RE">Reunion</option>
		      		<option value="RO">Romanya</option>
		      		<option value="RU">Rusya Federasyonu</option>
		      		<option value="RW">Ruanda</option>
		      		<option value="KN">Saint Kitts ve Nevis</option>
		      		<option value="LC">Saint Lucia</option>
		      		<option value="VC">Saint Vincent ve Grenadinler</option>
		      		<option value="WS">Samoa</option>
		      		<option value="SM">San Marino</option>
		      		<option value="ST">Sao Tome ve Principe</option>
		      		<option value="SA">Suudi Arabistan</option>
		      		<option value="SN">Senegal</option>
		      		<option value="SC">Seyşeller</option>
		      		<option value="SL">Sierra Leone</option>
		      		<option value="SG">Singapur</option>
		      		<option value="SK">Slovakya</option>
		      		<option value="SI">Slovenya</option>
		      		<option value="SB">Solomon Adaları</option>
		      		<option value="SO">Somali</option>
		      		<option value="ZA">Güney Afrika</option>
		      		<option value="GS">Güney Georgia ve Güney Sandwich Adaları</option>
		      		<option value="ES">İspanya</option>
		      		<option value="LK">Sri Lanka</option>
		      		<option value="SH">St. Helena</option>
		      		<option value="PM">Saint Pierre ve Miquelon</option>
		      		<option value="SR">Surinam</option>
		      		<option value="SJ">Svalbard ve Jan Mayen Adaları</option>
		      		<option value="SZ">Svaziland</option>
		      		<option value="SE">İsveç</option>
		      		<option value="CH">İsviçre</option>
		      		<option value="SY">Suriye Arap Cumhuriyeti</option>
		      		<option value="TW">Tayvan</option>
		      		<option value="TJ">Tacikistan</option>
		      		<option value="TZ">Tanzanya, Birleşik Cumhuriyeti</option>
		      		<option value="TH">Tayland</option>
		      		<option value="TG">Togo</option>
		      		<option value="TK">Tokelau</option>
		      		<option value="TO">Tonga</option>
		      		<option value="TT">Trinidad ve Tobago</option>
		      		<option value="TN">Tunus</option>
		      		<option value="TR">Türkiye</option>
		      		<option value="TM">Türkmenistan</option>
		      		<option value="TC">Turks ve Caicos Adaları</option>
		      		<option value="TV">Tuvalu</option>
		      		<option value="UG">Uganda</option>
		      		<option value="UA">Ukrayna</option>
		      		<option value="AE">Birleşik Arap Emirlikleri</option>
		      		<option value="UK" selected>Birleşik Krallık</option>
		      		<option value="UM">Amerika Birleşik Devletleri Küçük Dış Adaları</option>
		      		<option value="UY">Uruguay</option>
		      		<option value="SU">SSCB</option>
		      		<option value="UZ">Özbekistan</option>
		      		<option value="VU">Vanuatu</option>
		      		<option value="VA">Vatikan Şehri</option>
		      		<option value="VE">Venezuela</option>
		      		<option value="VN">Vietnam</option>
		      		<option value="VG">Virgin Adaları (Britanya)</option>
		      		<option value="VI">Virgin Adaları (ABD)</option>
		      		<option value="WF">Wallis ve Futuna Adaları</option>
		      		<option value="EH">Batı Sahra</option>
		      		<option value="YE">Yemen Cumhuriyeti</option>
		      		<option value="YU">Yugoslavya</option>
		      		<option value="ZR">Zaire</option>
		      		<option value="ZM">Zambiya</option>
		      		<option value="ZW">Zimbabve</option>
		</select><br></td>
	</tr>
    <tr>
    	<td class="cellBg" colspan="2"> &nbsp;</td>
    </tr>
 </table>
 <br>
 <table align=center>
    <tr>
        <td colspan=2 align="center">
            <input type=submit name=Submit value="Devam Et">
            <input type=hidden name=action value="updatePaymentInfo">
        </td>
    </tr>
</table>
</form>

