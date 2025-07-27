<table border=0 cellspacing=0 cellpadding=0 width=80%>
<FORM name="theForm" method="post" action="{$form_action}">
   <tr>
      <td class="head">ID</td>
      <td class="head">Name</td>
      <td class="head">Password</td>
      <td class="head">E-Mail</td>
      <td class="head" colspan=2>&nbsp;</td>
   </tr>
{section name=ulist loop=$users}
{strip}
   <tr class="{cycle values="row1,row2"}">
      <td class="row">{$users[ulist].id}</td>
      <td class="row">{$users[ulist].name}</td>
      <td class="row">{$users[ulist].password}</td>
      <td class="row">{$users[ulist].email}</td>
      <td class="row"><input type=checkbox name="form[todel][]" value="{$users[ulist].id}"></td>
      <td class="row">{$users[ulist].options}</td>
   </tr>
{/strip}
{/section}
	<tr>
	<td class="fom" colspan=4>
	<table width="100%" border=0 cellspacing=0 cellpadding=0><tr>
	<td>{html_image file="images/back.png" align=right}</td>
	<td width=80% class=pgr> 1 2 3 4 5 6 </td>
	<td>{html_image file="images/forward.png"}</td>
	</tr></table>
	</td>
	<td class="fom"><input type=checkbox></td>
	<td class="fom" colspan=2><input class="tbx" type=submit name="form[do]" value=" DELETE "></td>
	</tr>
</form>
</table>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=80%>
	<FORM name="theForm" method="post" action="{$form_action}?do=add">
	<INPUT type="hidden" name="form[is_sent]" value="true">
	<tr>
	<td class="fom">&nbsp;</td>
	<td class="fom"><input class="tbx" type=text name="form[name]" size=15 value="{$name}"></td>
	<td class="fom"><input class="tbx" type=text name="form[pass]" size=15 value="{$pass}"></td>
	<td class="fom"><input class="tbx" type=text name="form[email]" size=15 value="{$email}"></td>
	<td class="fom"><input class="tbx" type=submit name="form[submit]" value="++ADD++"></td>
	</tr>
	</form>
</table>
