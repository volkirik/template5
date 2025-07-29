<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>{$title|default:"Online NIC :: Default Theme"}</title>
	<link href="{$RELA_DIR}/themes/{$CURRENT_THEME}/style.css" rel="stylesheet" type="text/css">
</head>

<body  BGCOLOR=#CCC3A6 LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
	<table width="726"  border="0" cellspacing="0" cellpadding="0" align=center >
		<tr>
			<td colspan="7" align=center>
                 {include file="$CURRENT_THEME/banner.tpl"}
            </td>
		</tr>
		<tr>
			<td  valign="top" align=left width=30 style="background-color: #CAE299;">{include file="$CURRENT_THEME/left.menu.tpl"}</td>
			<td class="mainTd" align="center" valign="top" width="75%">
			    {include file="$CURRENT_THEME/content.body.tpl"}
			</td>
            
		</tr>
		<tr>
			<td colspan="2"> {include file="$CURRENT_THEME/footer.tpl"} </td>
		</tr>
	</table>
</body>
</html>
