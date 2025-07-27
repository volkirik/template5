
	<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
        <td ><br>
            {if $content_header != ""}
		     {include file="$content_header"}
		    {else}
			    &nbsp;
			{/if}
		</td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td >
 			{if $content_body != ""}
				{include file="$content_body"}
			{/if}
	</td>
      </tr>
    </table> 
