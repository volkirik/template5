<br>
<form action={$php_self} method="POST">
  <table class="border1" align="center">
    <tr>
        <td  class="cellBg" colspan=2>
            <input type=radio name=payment_method value="paypal" {$pp_checked}> Paypal </td>
    </tr>
    <tr>
        <td class="cellBg"  align="right"> Paypal email account &nbsp;&nbsp;</td>
        <td class="cellBg2" >
            <input type=text size="20" maxlength="128"  value="{$pp_email}" name="pp_email"></td>
    </tr>
    <tr><td class="cellBg" colspan="2">&nbsp;</td></tr>

    <tr>
        <td  class="cellBg" colspan=2>
            <input type=radio name=payment_method value="creditcard" {$cc_checked}> Credit Card </td>
    </tr>
	<tr>
		<td class="cellBg" align="right">Credit card&nbsp;&nbsp;</td>
		<td class="cellBg2" >
           <select  name="cc_name">
                {if $cc_name != ''} 
                        <option value="{$cc_name}" selected> {$cc_name} </option>
                {else}
                        <option value="">Select card         </option>
                {/if}
				<option value="VISA">Visa               </option>
				<option value="MASTERCARD">MasterCard   </option>
				<option value="DISCOVER">Discover        </option>
				<option value="AMEX">American Express   </option>
				<option value="JCB">JCB                 </option>
				<option value="DINERS">Diner's Club/Carte Blanche   </option>
	    	</select>
		</td>
	</tr>
		
	<tr>
		<td  class="cellBg"  align="right" >Credit Card Number&nbsp;&nbsp;</td>
		<td class="cellBg2" ><input type=text size="20" name=cc_num maxlength="16"  value="{$cc_num}" ></td>
	</tr>	

	<tr>
		<td  class="cellBg" align="right">Expiration Date&nbsp;&nbsp;</td>
		<td class="cellBg2" >
			<select  name="exp_date">
                {if $exp_date != ''}
                    <option value="{$exp_date}"> {$exp_date} </option>
				{else}
                    <option value="">Select month </option>
                {/if}
				<option value="01">01
				<option value="02">02
				<option value="03">03
				<option value="04">04
				<option value="05">05
				<option value="06">06
				<option value="07">07
				<option value="08">08
				<option value="09">09
				<option value="10">10
				<option value="11">11
				<option value="12">12
			</select> &nbsp; 
			<select  name="exp_year">
                {if $exp_year != ''}
                    <option value="{$exp_year}"> {$exp_year} </option>
                {else}
                    <option value="">Select Year </option>
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
		<td  class="cellBg" align="right">Cardholder's Name&nbsp;&nbsp;</td>
		<td class="cellBg2" ><input type=text size="20" maxlength="128"  value="{$cc_user}" name="cc_user"></td>
	</tr>

	<tr>
		<td  class="cellBg" align="right">Card ID Number&nbsp;&nbsp;<br/>&nbsp;</td>
		<td class="cellBg2" ><input type=text size="4" maxlength="4" value="{$cc_id}" name="cc_id">&nbsp;(Required for your security)<br>
            <a href="#" target="blank">What is this?</a>
        </td>
	</tr>
   <tr><td class="cellBg" colspan="2">&nbsp;</td></tr>
	<tr>
		<td  class="cellBg" colspan="2" class="text"><b>Credit Card Billing Address</b></td>
	</tr>
    <tr>
		<td  class="cellBg" align="right">Cardholder's E-mail&nbsp;</td>
		<td class="cellBg2" ><input type=text size="20" maxlength="128"  value="{$cc_email}" name="cc_email"></td>
	</tr>
	<tr>
		<td  class="cellBg" align="right">Address&nbsp;&nbsp;</td>
		<td class="cellBg2" ><input type=text size="20" maxlength="41"  value="{$cc_addr}" name="cc_addr"></td>
	</tr>
	<tr>
		<td  class="cellBg" align="right">City&nbsp;&nbsp;</td>
		<td class="cellBg2" ><input type=text size="20" maxlength="30"  value="{$cc_city}" name="cc_city"></td>
	</tr>
	<tr>
		<td  class="cellBg" align="right">State/Province&nbsp;&nbsp;</td>
		<td class="cellBg2" ><input type=text size="20" maxlength="40"  value="{$cc_state}" name="cc_state"></td>
	</tr>
	<tr>
		<td  class="cellBg" align="right">Zip/Postal Code&nbsp;&nbsp;</td>
		<td class="cellBg2" ><input type=text size="20" maxlength="15"  value="{$cc_zip}" name="cc_zip"><br></td>
	</tr>
    <tr> 
        <td class="cellBg" align="right">Telephone &nbsp; &nbsp;</td>
        <td class="cellBg2" ><input type=text size="20" maxlength="15"  value="{$cc_tel}" name="cc_tel"><br></td>
    </tr>
    <tr> 
        <td class="cellBg" align="right">Fax &nbsp; &nbsp;</td>
        <td class="cellBg2" ><input type=text size="20" maxlength="15"  value="{$cc_fax}" name="cc_fax"><br></td>
    </tr>
	<tr>
		<td  class="cellBg" align="right">Country&nbsp;&nbsp;</td>
		<td class="cellBg2" ><select  name="cc_country">
		    {if $cc_country != ''}
                <option value="{$cc_country}">{$cc_country}</option>
            {else}
		        <option value="" >Select country</option>
            {/if}
		      		<option value="US">United States                                   </option>
		      		<option value="AF">Afghanistan                                     </option>
		      		<option value="AL">Albania                                         </option>
		      		<option value="DZ">Algeria                                         </option>
		      		<option value="AS">American Samoa                                  </option>
		      		<option value="AD">Andorra                                         </option>
		      		<option value="AO">Angola                                          </option>
		      		<option value="AI">Anguilla                                        </option>
		      		<option value="AQ">Antarctica                                      </option>
		      		<option value="AG">Antigua And Barbuda                             </option>
		      		<option value="AR">Argentina                                       </option>
		      		<option value="AM">Armenia                                         </option>
		      		<option value="AW">Aruba                                           </option>
		      		<option value="AU">Australia                                       </option>
		      		<option value="AT">Austria                                         </option>
		      		<option value="AZ">Azerbaijan                                      </option>
		      		<option value="BS">Bahamas                                         </option>
		      		<option value="BH">Bahrain                                         </option>
		      		<option value="BD">Bangladesh                                      </option>
		      		<option value="BB">Barbados                                        </option>
		      		<option value="BY">Belarus                                         </option>
		      		<option value="BE">Belgium                                         </option>
		      		<option value="BZ">Belize                                          </option>
		      		<option value="BJ">Benin                                           </option>
		      		<option value="BM">Bermuda                                         </option>
		      		<option value="BT">Bhutan                                          </option>
		      		<option value="BO">Bolivia                                         </option>
		      		<option value="BA">Bosnia Hercegovina                              </option>
		      		<option value="BW">Botswana                                        </option>
		      		<option value="BV">Bouvet Island                                   </option>
		      		<option value="BR">Brazil                                          </option>
		      		<option value="IO">British Indian Ocean Territory                  </option>
		      		<option value="BN">Brunei Darussalam                               </option>
		      		<option value="BG">Bulgaria                                        </option>
		      		<option value="BF">Burkina Faso                                    </option>
		      		<option value="BI">Burundi                                         </option>
		      		<option value="KH">Cambodia                                        </option>
		      		<option value="CM">Cameroon                                        </option>
		      		<option value="CA">Canada                                          </option>
		      		<option value="CV">Cape Verde                                      </option>
		      		<option value="KY">Cayman Islands                                  </option>
		      		<option value="CF">Central African Republic                        </option>
		      		<option value="TD">Chad                                            </option>
		      		<option value="CL">Chile                                           </option>
		      		<option value="CN">China                                           </option>
		      		<option value="CX">Christmas Island                                </option>
		      		<option value="CC">Cocos (Keeling) Islands                         </option>
		      		<option value="CO">Colombia                                        </option>
		      		<option value="KM">Comoros                                         </option>
		      		<option value="CG">Congo                                           </option>
		      		<option value="CD">The Democratic Republic Of The Congo            </option>
		      		<option value="CK">Cook Islands                                    </option>
		      		<option value="CR">Costa Rica                                      </option>
		      		<option value="CI">Cote D'ivoire                                   </option>
		      		<option value="HR">Croatia                                         </option>
		      		<option value="CY">Cyprus                                          </option>
		      		<option value="CZ">Czech Republic                                  </option>
		      		<option value="CS">Czechoslovakia                                  </option>
		      		<option value="DK">Denmark                                         </option>
		      		<option value="DJ">Djibouti                                        </option>
		      		<option value="DM">Dominica                                        </option>
		      		<option value="DO">Dominican Republic                              </option>
		      		<option value="TP">East Timor                                      </option>
		      		<option value="EC">Ecuador                                         </option>
		      		<option value="EG">Egypt                                           </option>
		      		<option value="SV">El Salvador                                     </option>
		      		<option value="GQ">Equatorial Guinea                               </option>
		      		<option value="ER">Eritrea                                         </option>
		      		<option value="EE">Estonia                                         </option>
		      		<option value="ET">Ethiopia                                        </option>
		      		<option value="FK">Falkland Islands                                </option>
		      		<option value="FO">Faroe Islands                                   </option>
		      		<option value="FJ">Fiji                                            </option>
		      		<option value="FI">Finland                                         </option>
		      		<option value="FR">France                                          </option>
		      		<option value="GF">French Guiana                                   </option>
		      		<option value="PF">French Polynesia                                </option>
		      		<option value="TF">French Southern Territories                     </option>
		      		<option value="GA">Gabon                                           </option>
		      		<option value="GM">Gambia                                          </option>
		      		<option value="GE">Georgia                                         </option>
		      		<option value="DE">Germany                                         </option>
		      		<option value="GH">Ghana                                           </option>
		      		<option value="GI">Gibraltar                                       </option>
		      		<option value="GB">Great Britain                                   </option>
		      		<option value="GR">Greece                                          </option>
		      		<option value="GL">Greenland                                       </option>
		      		<option value="GD">Grenada                                         </option>
		      		<option value="GP">Guadeloupe                                      </option>
		      		<option value="GU">Guam                                            </option>
		      		<option value="GT">Guatemala                                       </option>
		      		<option value="GG">Guernsey                                        </option>
		      		<option value="GN">Guinea                                          </option>
		      		<option value="GW">Guinea-Bissau                                   </option>
		      		<option value="GY">Guyana                                          </option>
		      		<option value="HT">Haiti                                           </option>
		      		<option value="HM">Heard And Mc Donald Islands                     </option>
		      		<option value="HN">Honduras                                        </option>
		      		<option value="HK">Hong Kong                                       </option>
		      		<option value="HU">Hungary                                         </option>
		      		<option value="IS">Iceland                                         </option>
		      		<option value="IN">India                                           </option>
		      		<option value="IQ">Iraq                                            </option>
		      		<option value="IE">Ireland                                         </option>
		      		<option value="IM">Isle Of Man                                     </option>
		      		<option value="IL">Israel                                          </option>
		      		<option value="IT">Italy                                           </option>
		      		<option value="JM">Jamaica                                         </option>
		      		<option value="JP">Japan                                           </option>
		      		<option value="JE">Jersey                                          </option>
		      		<option value="JO">Jordan                                          </option>
		      		<option value="KZ">Kazakhstan                                      </option>
		      		<option value="KE">Kenya                                           </option>
		      		<option value="KI">Kiribati                                        </option>
		      		<option value="KR">Korea                                           </option>
		      		<option value="KW">Kuwait                                          </option>
		      		<option value="KG">Kyrgyzstan                                      </option>
		      		<option value="LA">Lao People's Democratic Republic                </option>
		      		<option value="LV">Latvia                                          </option>
		      		<option value="LB">Lebanon                                         </option>
		      		<option value="LS">Lesotho                                         </option>
		      		<option value="LR">Liberia                                         </option>
		      		<option value="LY">Libyan Arab Jamahiriya                          </option>
		      		<option value="LI">Liechtenstein                                   </option>
		      		<option value="LT">Lithuania                                       </option>
		      		<option value="LU">Luxembourg                                      </option>
		      		<option value="MO">Macau                                           </option>
		      		<option value="MK">Macedonia                                       </option>
		      		<option value="MG">Madagascar                                      </option>
		      		<option value="MW">Malawi                                          </option>
		      		<option value="MY">Malaysia                                        </option>
		      		<option value="MV">Maldives                                        </option>
		      		<option value="ML">Mali                                            </option>
		      		<option value="MT">Malta                                           </option>
		      		<option value="MH">Marshall Islands                                </option>
		      		<option value="MQ">Martinique                                      </option>
		      		<option value="MR">Mauritania                                      </option>
		      		<option value="MU">Mauritius                                       </option>
		      		<option value="YT">Mayotte                                         </option>
		      		<option value="MX">Mexico                                          </option>
		      		<option value="FM">Micronesia                                      </option>
		      		<option value="MD">Moldova                                         </option>
		      		<option value="MC">Monaco                                          </option>
		      		<option value="MN">Mongolia                                        </option>
		      		<option value="MS">Montserrat                                      </option>
		      		<option value="MA">Morocco                                         </option>
		      		<option value="MZ">Mozambique                                      </option>
		      		<option value="MM">Myanmar                                         </option>
		      		<option value="NA">Namibia                                         </option>
		      		<option value="NR">Nauru                                           </option>
		      		<option value="NP">Nepal                                           </option>
		      		<option value="NL">The Netherlands                                 </option>
		      		<option value="AN">Netherlands Antilles                            </option>
		      		<option value="NT">Neutral Zone                                    </option>
		      		<option value="NC">New Caledonia                                   </option>
		      		<option value="NZ">New Zealand                                     </option>
		      		<option value="NI">Nicaragua                                       </option>
		      		<option value="NE">Niger                                           </option>
		      		<option value="NG">Nigeria                                         </option>
		      		<option value="NU">Niue                                            </option>
		      		<option value="NF">Norfolk Island                                  </option>
		      		<option value="MP">Northern Mariana Islands                        </option>
		      		<option value="NO">Norway                                          </option>
		      		<option value="OM">Oman                                            </option>
		      		<option value="PK">Pakistan                                        </option>
		      		<option value="PW">Palau                                           </option>
		      		<option value="PA">Panama                                          </option>
		      		<option value="PG">Papua New Guinea                                </option>
		      		<option value="PY">Paraguay                                        </option>
		      		<option value="PE">Peru                                            </option>
		      		<option value="PH">Philippines                                     </option>
		      		<option value="PN">Pitcairn                                        </option>
		      		<option value="PL">Poland                                          </option>
		      		<option value="PT">Portugal                                        </option>
		      		<option value="PR">Puerto Rico                                     </option>
		      		<option value="QA">Qatar                                           </option>
		      		<option value="RE">Reunion                                         </option>
		      		<option value="RO">Romania                                         </option>
		      		<option value="RU">Russian Federation                              </option>
		      		<option value="RW">Rwanda                                          </option>
		      		<option value="KN">Saint Kitts And Nevis                           </option>
		      		<option value="LC">Saint Lucia                                     </option>
		      		<option value="VC">Saint Vincent And The Grenadines                </option>
		      		<option value="WS">Samoa                                           </option>
		      		<option value="SM">San Marino                                      </option>
		      		<option value="ST">Sao Tome And Principe                           </option>
		      		<option value="SA">Saudi Arabia                                    </option>
		      		<option value="SN">Senegal                                         </option>
		      		<option value="SC">Seychelles                                      </option>
		      		<option value="SL">Sierra Leone                                    </option>
		      		<option value="SG">Singapore                                       </option>
		      		<option value="SK">Slovakia                                        </option>
		      		<option value="SI">Slovenia                                        </option>
		      		<option value="SB">Solomon Islands                                 </option>
		      		<option value="SO">Somalia                                         </option>
		      		<option value="ZA">South Africa                                    </option>
		      		<option value="GS">South Georgia And The South Sandwich Islands    </option>
		      		<option value="ES">Spain                                           </option>
		      		<option value="LK">Sri Lanka                                       </option>
		      		<option value="SH">St. Helena                                      </option>
		      		<option value="PM">St. Pierre And Miquelon                         </option>
		      		<option value="SR">Suriname                                        </option>
		      		<option value="SJ">Svalbard And Jan Mayen Islands                  </option>
		      		<option value="SZ">Swaziland                                       </option>
		      		<option value="SE">Sweden                                          </option>
		      		<option value="CH">Switzerland                                     </option>
		      		<option value="SY">Syrian Arab Republic                            </option>
		      		<option value="TW">Taiwan                                          </option>
		      		<option value="TJ">Tajikistan                                      </option>
		      		<option value="TZ">Tanzania, United Republic Of                 </option>
		      		<option value="TH">Thailand                                        </option>
		      		<option value="TG">Togo                                            </option>
		      		<option value="TK">Tokelau                                         </option>
		      		<option value="TO">Tonga                                           </option>
		      		<option value="TT">Trinidad And Tobago                             </option>
		      		<option value="TN">Tunisia                                         </option>
		      		<option value="TR">Turkey                                          </option>
		      		<option value="TM">Turkmenistan                                    </option>
		      		<option value="TC">Turks And Caicos Islands                        </option>
		      		<option value="TV">Tuvalu                                          </option>
		      		<option value="UG">Uganda                                          </option>
		      		<option value="UA">Ukraine                                         </option>
		      		<option value="AE">United Arab Emirates                            </option>
		      		<option value="UK" selected>United Kingdom                         </option>
		      		<option value="UM">United States Minor Outlying Islands            </option>
		      		<option value="UY">Uruguay                                         </option>
		      		<option value="SU">Ussr                                            </option>
		      		<option value="UZ">Uzbekistan                                      </option>
		      		<option value="VU">Vanuatu                                         </option>
		      		<option value="VA">Vatican City State                              </option>
		      		<option value="VE">Venezuela                                       </option>
		      		<option value="VN">Viet Nam                                        </option>
		      		<option value="VG">Virgin Islands (British)                        </option>
		      		<option value="VI">Virgin Islands (U.S.)                           </option>
		      		<option value="WF">Wallis And Futuna Islands                       </option>
		      		<option value="EH">Western Sahara                                  </option>
		      		<option value="YE">Yemen, Republic Of</option>
		      		<option value="YU">Yugoslavia                                      </option>
		      		<option value="ZR">Zaire                                           </option>
		      		<option value="ZM">Zambia                                          </option>
		      		<option value="ZW">Zimbabwe                                        </option>
		</select><br></td>
	</tr>
    <tr>
    	<td class="cellBg"colspan="2"> &nbsp;</td>
    </tr>
 </table>
 <br>
 <table align=center>
    <tr>
        <td colspan=2 align="center">
            <input type=submit name=Submit value="Proceed">
            <input type=hidden name=action value="updatePaymentInfo">
        </td>
    </tr>
</table>
</form>
