 
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  {if $content_title != ""}

		  <tr>
            <TD colspan="2" class="pageInfo">
               <b>{$content_title}</b>
            </TD>
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
