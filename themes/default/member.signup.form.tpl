                  <form action="{$content_action}" method="post">
                  <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="25%" height="25" colspan="2"><font color="#FF0000" class="p8">Asterisk* is mandatory</font></td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Username</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="member_name" size="20" maxlength="20" value="{$member_name}">
                        <font color="#FF0000">*</font> </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Password</td>
                      <td width="75%" height="25"> 
                        <input type="password" name="member_password1" size="20" maxlength="20" value="{$member_password1}">
                        <font color="#FF0000">*</font> </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Confirm Password</td>
                      <td width="75%" height="25"> 
                        <input type="password" name="member_password2" size="20" maxlength="20" value="{$member_password2}">
                        <font color="#FF0000">*</font> </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">&nbsp;</td>
                      <td width="75%" height="25">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Registrant</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_name" size="20" maxlength="20" value="{$r_name}">
                        <font color="#FF0000">*</font> </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Organization</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_org" value="{$r_org}">
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Street 1</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_address1" size="30" maxlength="60" value="{$r_address1}">
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Street 2</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_address2" size="30" maxlength="60" value="{$r_address2}">
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Street 3</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_address3" size="30" maxlength="60" value="{$r_address3}">
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">City</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_city" maxlength="60" value="{$r_city}">
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Province</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_province" maxlength="60" value="{$r_province}">
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Country</td>
                      <td width="75%" height="25">
                        <select name="r_country">
                            {foreach key=key item=item from=$countries}
                                <option value={$key}
								    {if $key==$r_country}selected{/if}>{$item}
								</option>
                            {/foreach}
                        </select>
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Postal Code</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_postalcode" maxlength="60" value="{$r_postalcode}">
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Telephone (eg: +1.4156657168)</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_telephone" maxlength="60" value="{$r_telephone}">
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">Fax (eg: +1.4156657168)</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_fax" maxlength="60" value="{$r_fax}">
                        <font color="#FF0000">*</font> 
                      </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">E-mail</td>
                      <td width="75%" height="25"> 
                        <input type="text" name="r_email" maxlength="60" value="{$r_email}">
                        <font color="#FF0000">*</font> </td>
                    </tr>
                    <tr> 
                      <td width="25%" height="25">&nbsp;</td>
                      <td width="75%" height="25">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="25%" height="25">&nbsp;</td>
                      <td width="75%" height="25"> 
                        <input type="submit" value="Become a member" name="Submit">
                      </td>
                    </tr>
                  </table>
                  </form>
