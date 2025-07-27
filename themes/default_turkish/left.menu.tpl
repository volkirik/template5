<table width=156 border=0 cellpadding=0 cellspacing=0 align=center>
	<TR>
		<TD>
			<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_01.gif" width=15 height=14 alt=""></TD>
		<TD>
			<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_02.gif" width=134 height=14 alt=""></TD>
		<TD>
			<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_03.gif" width=7 height=14 alt=""></TD>
	</TR>
	
		<TR>
			<TD>
				<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_04.gif" width=15 height=22 alt=""></TD>
			<TD class="sidemenuGreen">
			{if $left_menu[0][1]  == "title"}
			    {$left_menu[0][0]} 
			{/if}
			</TD>
			<TD>
				<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_06.gif" width=7 height=22 alt=""></TD>
		</TR>

        {if $left_menu[0][1]  == "link"}
		    <TR>
				<TD class="sidemenuWhiteLeft"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/null.gif" width="8" height="8"></TD>
				<TD class="sidemenuWhiteBg">
				    <ul class="bulletStyle"> <li>{$left_menu[0][0]}</li> </ul>
				</TD>
				<TD class="sidemenuWhiteright"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/null.gif" width="1" height="1"> </TD>
			</TR>
		{/if}
			
	{section name=side start=1 loop=$left_menu}
		{if $left_menu[side][1] != "title"}
			<TR>
				<TD class="sidemenuWhiteLeft"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/null.gif" width="8" height="8"></TD>
				<TD class="sidemenuWhiteBg">
				<ul class="bulletStyle">
				<li>	{$left_menu[side][0]}</li>
				</ul></TD>
				<TD class="sidemenuWhiteright"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/null.gif" width="1" height="1"> </TD>
			</TR>
		{else}
			<TR>
				<TD class="sidemenuLeftlinegreen"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/greenmenu_leftimage.gif" width="15" height="24"></TD>
				<TD class="sidemenuGreen2">	{$left_menu[side][0]}</TD>
				<TD class="sidemenuRightline"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_12.gif" width=7 height=24 alt=""></TD>
			</TR>
		{/if}

    {/section}
	<TR>
	  <TD class="sidemenuLeftlinegreen"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/greenmenu_leftimage.gif" width="15" height="24"></TD>
	  <TD class="sidemenuGreen2">&nbsp;</TD>
      <TD class="sidemenuRightline"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_12.gif" width=7 height=24 alt=""></TD>
  </TR>
	<TR>
	  <TD class="sideMenuGreyLeft">&nbsp;</TD>
      <TD class="sideMenuMid">&nbsp;</TD>
      <TD class="sideMenuGreyRight">&nbsp;</TD>
  </TR>
	<TR>
		<TD class="sideMenuGreyLeft"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/null.gif" width="1" height="1"> </TD>
		<TD class="sideMenuMid"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/null.gif" width="1" height="1"> </TD>
		<TD class="sideMenuGreyRight"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/null.gif" width="1" height="1"> </TD>
	</TR>
	<TR>
		<TD>
			<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_16.gif" width=15 height=8 alt=""></TD>
		<TD>
			<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_17.gif" width=134 height=8 alt=""></TD>
		<TD>
			<img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/sidemenu_18.gif" width=7 height=8 alt=""></TD>
	</TR>
</table>
