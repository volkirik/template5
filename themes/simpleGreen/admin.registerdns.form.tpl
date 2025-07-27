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
			<input type="submit" name="Submit" value="Register">&nbsp; &nbsp; &nbsp; &nbsp;
			<input type="reset" name="Reset" value="Reset">
			<input type="hidden" name="action" value="registerDns">
		</td>
	</tr>
</table>
</form>
