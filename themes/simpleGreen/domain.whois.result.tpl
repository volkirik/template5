{$whois_result_availability}
{if isset($whois_result_server) && $whois_result_server!=""}
<b>{$whois_result_server}</b>
{/if}
<p><a href="{$PHP_SELF}">{WHOIS_0006}</a></p>
{if isset($whois_result) && $whois_result!=""}
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr> 
    <td>
	  <pre>{$whois_result}</pre>
    </td>
  </tr>
</table>
{/if}
