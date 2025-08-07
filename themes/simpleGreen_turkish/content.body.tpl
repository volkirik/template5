<br>
	<table  border="0" align="center" cellpadding="0" cellspacing="0"  style="width: 775px;">
	  <tr >
        <td>
            {if $content_header != ""}
		     {include file="$content_header"}
		    {else}
			    &nbsp;
			{/if}
		</td>
      </tr>
	  <tr>
        <td>&nbsp; </td>
      </tr>
	  <tr>
        <td> &nbsp;
 			{if $content_body != ""}
				{include file="$content_body"}
			{/if}
	    </td>
      </tr>
    </table> 
