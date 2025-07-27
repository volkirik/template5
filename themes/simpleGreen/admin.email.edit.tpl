<br>
<form action={$php_self}>
<table align=center cellpadding=4 cellspacing=2 >
	<tr>
		<td bgcolor=#E1ECFB colspan=3>Subject: &nbsp; 
			<input class="formStyle" type=text name=email_subject value="{$email_subject}" style="width: 375px;">
		</td>
	</tr>
	 
	<tr>
		<td align=center bgcolor=#E1ECFB colspan=3>
		    <textarea name=email_body rows=15 cols=60 class="color">{$email_body}</textarea>
		</td>
	</tr>
	<tr>
	    <td bgcolor=#E1ECFB align=center> <font style="font-size: 12px;">
		    You can use the following macros inside the email template.<br>{$email_macros}</font>
		</td>
	</tr>
	
	{if $days == 'show'}
		<tr> 
			<td bgcolor=#E1ECFB align=center> Send notification before &nbsp; 
				<input class="formStyle" type=text name=days_count1 value="{$day1}" style="width: 25px;"> &nbsp; , &nbsp; 
				<input class="formStyle" type=text name=days_count2 value="{$day2}" style="width: 25px;"> &nbsp; and &nbsp; 
				<input class="formStyle" type=text name=days_count3 value="{$day3}" style="width: 25px;"> &nbsp; days.
			</td>
		</tr>
	{/if}
	<tr>
	    <td align=center colspan=3>
		    <input type=submit name=submit value=Save> &nbsp;
			&nbsp; &nbsp;
			<input type=button value=Cancel onClick="history.back()">
			<input type=hidden name=type value="{$type}">
		</td>
	</tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align=center colspan=3>
            Test Email: <input type="text" name="admin_email"> &nbsp; &nbsp;
            <input type=submit name=test_email value="Test Settings">
        </td>
    </tr>
</table>
</form>
