<br>
<table border="0" width="100%"  cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td>
      <form style="margin:0px">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
          <tr class="fieldName"> 
            <td width="15%" height="20"><b><font color="#FFFFFF">&nbsp;Product ID</font></b></td>
            <td width="25%" height="20"><b><font color="#FFFFFF">&nbsp;Product 
              Name</font></b></td>
            <td width="27%" height="20"><b><font color="#FFFFFF">&nbsp;Product 
              Type</font></b></td>
            <td width="12%" height="20"><b><font color="#FFFFFF">&nbsp;Status</font></b></td>
            <td width="25%" height="20"><b><font color="#FFFFFF">&nbsp;Operation</font></b></td>
        </tr>
		{section name=name loop=$rs}	
        <tr>
          <td height="20" class="p8"{$rs[name][1]}>
            &nbsp;{$rs[name][0][1]}
          </td>
          <td height="20" class="p8"{$rs[name][1]}>
            &nbsp;{$rs[name][0][3]}
          </td>
          <td height="20" class="p8"{$rs[name][1]}>

		{if $rs[name][0][4] == 1}
			&nbsp;Domain
		{elseif $rs[name][0][3] == 2}
			&nbsp;Hosting
		{elseif $rs[name][0][3] == 3}
			&nbsp;Postoffice
		{/if}
          </td>
          <td height="20" class="p8" {$rs[name][1]}>

		{if $rs[name][0][5] == 0}
			&nbsp;<font color=\"#0000FF\">Start</font>
		{else}
			&nbsp;<font color=\"#FF0000\">Stop</font>
		{/if}
          </td>
          <td height="20" class="p8" {$rs[name][1]}>
            <a href="{$php_self}?action=showModifyDNS&currentPage={$currentPage}&product_id={$rs[name][0][1]} ">DNS</a>&nbsp;
            <a href="{$php_self}?action=showModifyPrice&currentPage={$currentPage}&product_id={$rs[name][0][1]}">Price</a>&nbsp;

		{if $rs[name][0][5]== 0}

					<a href="{$php_self}?action=stopProduct&currentPage={$currentPage}&product_id={$rs[name][0][1]}">Stop</a>&nbsp;
		{else}
					<a href="{$php_self}?action=startProduct&currentPage={$currentPage}&product_id={$rs[name][0][1]}">Start</a>&nbsp;
		{/if}
          </td>
        </tr>
    {/section}
        <tr> 
          <td height="20" bgcolor="#CCCCCC" colspan="5">
			  {$pagebutton}

          </td>
<!--	  <input type=button value=Back onClick="history.back()">-->
        </tr>

      </table>
      </form>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
