 
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  {if $content_title != ""}

		  <tr>
            <td class="greyHeadRight">
			    <img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/greyhead_left.gif" width="6" height="22">
			</td>
            <td class="greyHead">{$content_title} </td>
            <td class="greyHeadRight">
			    <img src="{$RELA_DIR}/themes/{$CURRENT_THEME}/images/greyhead_right.gif" width="6" height="22">
			</td>
          </tr>
	  {/if} 
	</table><br>
	
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  {if $content_tip != ""}
	    
		<tr><td ><i>{$content_tip}</i></td></tr>
	    <tr><td ><hr></td></tr>
	  
	  {/if}
	  {if $content_warning != ""}
	  
	    <tr><td ><b><i>{$content_warning}</i></b></td></tr>
	    <tr><td ><hr></td></tr>
	  
	  {/if}
	</table>