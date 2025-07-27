<table cellspacing=0 cellpadding=0 border=0 class="bannerBg">
    <tr>
        <TD width="7"><IMG SRC="images/design2_02.gif" WIDTH=7 HEIGHT=66 ALT=""></TD>
		<TD width="177"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/design2_03.gif" width=177 height=66 alt=""></TD>
		<TD colspan="2" class="topMenuRight" align="right">
            <TABLE  BORDER=0 CELLPADDING=0 CELLSPACING=0 align="right">
                <TR>
                  {*  <TD><a href="#"><IMG SRC="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/topmenu_01.gif" ALT="" WIDTH=36 HEIGHT=35 border="0"></a></TD>
                    <TD class="topMenuRight"><a href="#" class="topMenuRight" align="center">Home</a></TD>
                    <TD><a href="#"><IMG SRC="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/topmenu_03.gif" ALT="" WIDTH=30 HEIGHT=35 border="0"></a></TD>
                    <TD class="topMenuRight"><a href="#" class="topMenuRight">My Account</a> </TD>
                    <TD><a href="#"><IMG SRC="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/topmenu_05.gif" ALT="" WIDTH=15 HEIGHT=35 border="0"></a></TD>
                    <TD><a href="#" class="topMenuRight">Help</a></TD>
                    *}
                    {section name=links loop=$banner_links}
                       <TD class="topMenuRight"> <a href={$banner_links[links][0]} class="topMenuRight">{$banner_links[links][1]}</a>&nbsp;&nbsp;
                        {if !$smarty.section.links.last}
                        : :&nbsp;&nbsp;</TD>
                        {/if}
                    {/section}
		  </TD>
                </TR>
            </TABLE>
        </TD>
    </tr>
 	<TR>
		<TD><IMG SRC="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/design2_07.gif" WIDTH=7 HEIGHT=61 ALT=""></TD>
		<TD class="greenRightLine">&nbsp;</TD>
		<TD class="green2">&nbsp;</TD>
	    <TD class="rightTop"><img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/righttop.gif" alt="" width="7" height="61"></TD>
	</TR>
 </table>
