<br>
<script type="text/javascript">
function showDomains(){$smarty.ldelim}
    if (document.getElementById('rec').style.display == '')
        document.getElementById('rec').style.display = 'none';
    else 
        document.getElementById('rec').style.display = '';
{$smarty.rdelim}
</script>
<form method=POST action={$php_self}>
<table class="searchForm" align="center" width="100%" cellpadding=10 cellspacing=10>
    <tr><td>
        {section name=i loop=$search_res}
            {if $search_res[i][1] == 0}
                <div>
                    <br><input type=checkbox name=domains[] value="{$search_res[i][0]}" checked>
                         {$search_res[i][0]} is available
                </div>
            {/if}
        {/section}
        <div></div>
        {section name=i loop=$failed_domains}
            {if $failed_domains[i][1] == 1}
                <div><br>&nbsp; {$failed_domains[i][0]} is already registered</div>
            {else}
                <div><br>&nbsp; {$failed_domains[i][0]} checking domain is not available now.</div>
            {/if}
        {/section}
        
      </td></tr>
      <tr><td > 
          <br><br><a href="#" onClick=showDomains()>See all recommended domains</a>
      </td></tr>
      <tr><td id='rec' style="display:none"> 
         {section name=i loop=$search_res}
            {if $search_res[i][1] == 1}
                <div>
                    <br><input type=checkbox name=domains[] value="{$search_res[i][0]}" >
                         {$search_res[i][0]} is available
                </div>
            {/if}
        {/section}
    </td></tr>
    <tr><td >
        <input type=submit name=Submit value="Continue">
        <input type=hidden name=action value="selectMember">
    </td></tr>
</table>
</form>
<br>
{include file="$CURRENT_THEME/domain.searchdomains.form.tpl"}
