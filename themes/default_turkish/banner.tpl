
<table width=1000 border=0 align="center" cellspacing=0 >
	<tr>
		<td class="headLeftWidth"><img src="{$RELA_DIR}themes/{$CURRENT_THEME}/images/header1_01.gif" width=14 height=26 alt=""></td>
		<td colspan="4" class="headBg1">&nbsp;	</td>
		<td class="headRight"><img src="{$RELA_DIR}themes/{$CURRENT_THEME}/images/header1_06.gif" width=14 height=26 alt=""></td>
	</tr>
	<tr>
		<td class="headLeftWidth"><img src="{$RELA_DIR}themes/{$CURRENT_THEME}/images/header1_07.gif" width=14 height=72 alt=""></td>
		<td class="logo"><a href="{$RELA_DIR}"><img src="{$logo}" alt="onlineNIC" width=134 height=72 border="0"></a></td>
		<td class="headBg2"></td>
		<td class="headMid"><img src="{$RELA_DIR}themes/{$CURRENT_THEME}/images/header1_10.gif" width=37 height=72 alt=""></td>
		<td class="headBg3"></td>
		<td class="headRight">
			<img src="{$RELA_DIR}themes/{$CURRENT_THEME}/images/header1_12.gif" alt="" width=14 height=72 ></td>
	</tr>
	<tr>
		<td class="headLeftWidth"><img src="{$RELA_DIR}themes/{$CURRENT_THEME}/images/header1_13.gif" width=14 height=34 alt=""></td>
		<td colspan="2" class="headBg4"></td>
		<td class="headMid">			<img src="{$RELA_DIR}themes/{$CURRENT_THEME}/images/header1_16.gif" width=37 height=34 alt=""></td>
		<td class="meadMenu">
			{section name=links loop=$banner_links}
				<a href={$banner_links[links][0]} class="meadMenu" style="color: #FFFFFF;" >{$banner_links[links][1]}</a>&nbsp;&nbsp;
                {if !$smarty.section.links.last}
    			: :&nbsp;&nbsp;
				{/if}
			{/section}
		</td>
	    <td class="meadMenu">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6" class="headBase"></td>
	</tr>
</table>
