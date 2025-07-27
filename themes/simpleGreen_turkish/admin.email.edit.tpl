<br>
<form action={$php_self}>
<table align="center" cellpadding="4" cellspacing="2">
	<tr>
		<td bgcolor="#E1ECFB" colspan="3">Konu: &nbsp; 
			<input class="formStyle" type="text" name="email_subject" value="{$email_subject}" style="width: 375px;">
		</td>
	</tr>
	 
	<tr>
		<td align="center" bgcolor="#E1ECFB" colspan="3">
		    <textarea name="email_body" rows="15" cols="60" class="color">{$email_body}</textarea>
		</td>
	</tr>
	<tr>
	    <td bgcolor="#E1ECFB" align="center"> <font style="font-size: 12px;">
		    E-posta şablonunda aşağıdaki makroları kullanabilirsiniz.<br>{$email_macros}</font>
		</td>
	</tr>
	
	{if $days == 'show'}
		<tr> 
			<td bgcolor="#E1ECFB" align="center"> Bildirim göndermek için &nbsp; 
				<input class="formStyle" type="text" name="days_count1" value="{$day1}" style="width: 25px;"> &nbsp; , &nbsp; 
				<input class="formStyle" type="text" name="days_count2" value="{$day2}" style="width: 25px;"> &nbsp; ve &nbsp; 
				<input class="formStyle" type="text" name="days_count3" value="{$day3}" style="width: 25px;"> &nbsp; gün önce.
			</td>
		</tr>
	{/if}
	<tr>
	    <td align="center" colspan="3">
		    <input type="submit" name="submit" value="Kaydet"> &nbsp;
			&nbsp; &nbsp;
			<input type="button" value="İptal" onClick="history.back()">
			<input type="hidden" name="type" value="{$type}">
		</td>
	</tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="center" colspan="3">
            Test E-postası: <input type="text" name="admin_email"> &nbsp; &nbsp;
            <input type="submit" name="test_email" value="Ayarları Test Et">
        </td>
    </tr>
</table>
</form>

