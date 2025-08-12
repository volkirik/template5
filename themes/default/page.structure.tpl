<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>{$title|default:"Online NIC :: Default Theme"}</title>
	<link href="{$RELA_DIR}themes/{$CURRENT_THEME}/style.css" rel="stylesheet" type="text/css">
</head>

<body class="bodystyle" align=center>
	<table width="1000"  border="0" cellspacing="0" cellpadding="0" align=center >
		<tr>
			<td colspan="3" align=center>{include file="$CURRENT_THEME/banner.tpl"} </td>
		</tr>
		<tr>
			<td class="sideGrey" align=center width=30>{include file="$CURRENT_THEME/left.menu.tpl"}</td>
			<td class="mainBody" align=center width=80% border=1>
			    {include file="$CURRENT_THEME/content.body.tpl"}
			</td>
			<td class="rightGreyBorder">
			&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="3" class="footerBg">
			     {include file="$CURRENT_THEME/footer.tpl"} 
			</td>
		</tr>
	</table>
</body>
</html>
