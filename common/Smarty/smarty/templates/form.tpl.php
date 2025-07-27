<HTML>
 <HEAD>
  <TITLE>#tryout.val_form</TITLE>
  <META name="author"      content="Maarten Wierda, norecess.com">
  <META name="keywords"    content="">
  <META name="description" content="">
  {literal}
  <STYLE type="text/css"><!--
	
	BODY, TABLE, TD
	{
		font-family:	Courier New, monospace;
		font-size:		10pt;
		color:			#222222;
	}
	
	INPUT.fld
	{	
		font-family:	Courier New, monospace;
		font-size:		10pt;
		color:			#222222;
		border:			1px solid #000000;
	}
	
	INPUT.fld_small
	{	
		font-family:	Courier New, monospace;
		font-size:		10pt;
		color:			#222222;
		border:			1px solid #000000;
		width:			45px;
	}	
	
	.not_filled_in
	{
		color:	#ff0000;
	}
	
  --></STYLE>
  {/literal} 
 </HEAD>
 
 <BODY bgcolor="#ffffff" marginwidth="20" marginheight="20" leftmargin="20" topmargin="20">
 
<FORM name="theForm" method="post" action="{$form_action}">
 <INPUT type="hidden" name="is_sent" value="true">
 
<TABLE border="0" cellspacing="2" cellpadding="2">
 <TR valign="middle">
  <TD>username</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD><INPUT class="fld" type="text" name="username" value="{$username}"></TD>
  <TD>*</TD>
 </TR>
 <TR valign="middle">
  <TD>zipcode</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD><INPUT class="fld" type="text" name="zipcode" value="{$zipcode}"></TD>
  <TD>*</TD>
 </TR>
 <TR valign="middle">
  <TD>e-mail</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD><INPUT  class="fld"type="text" name="email" value="{$email}"></TD>
  <TD>*</TD>
 </TR>  
 <TR valign="middle">
  <TD>website</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD><INPUT class="fld" type="text" name="website" value="{$website}"></TD>
  <TD>*</TD>
 </TR>
 <TR valign="middle">
  <TD>birthdate</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD><INPUT class="fld" type="text" name="birthdate" value="{$birthdate}"></TD>
  <TD>*</TD>
 </TR> 
 <TR valign="middle">
  <TD>date_01</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD>
  <INPUT class="fld_small" type="text" name="date_01_01" value="{$date_01_01}">
  <INPUT class="fld_small" type="text" name="date_01_02" value="{$date_01_02}">
  <INPUT class="fld_small" type="text" name="date_01_03" value="{$date_01_03}">
  </TD>
  <TD>*</TD>
 </TR>
 <TR valign="middle">
  <TD>gendert</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD>
<INPUT type="radio" name="gender" value="m" {if $gender eq m} checked {/if}>&nbsp;m
<INPUT type="radio" name="gender" value="v" {if $gender eq v} checked {/if}>&nbsp;v
  </TD>
  <TD>*</TD>
 </TR>
 <TR valign="middle">
  <TD>books</TD>
  <TD>&nbsp;:&nbsp;</TD>
  <TD> 
<INPUT type="checkbox" name="books[]" value="boek_01" {foreach from=$books item=the_book}{if $the_book eq "boek_01"} checked {/if}{/foreach}>&nbsp;0
<INPUT type="checkbox" name="books[]" value="boek_02" {foreach from=$books item=the_book}{if $the_book eq "boek_02"} checked {/if}{/foreach}>&nbsp;1
  </TD>
  <TD>*</TD>
 </TR>  
 <TR valign="middle">
  <TD colspan="3" align="right"><INPUT type="submit" value="sent"></TD>
 </TR>  
</TABLE>
</FORM>
 
 </BODY>
</HTML>
