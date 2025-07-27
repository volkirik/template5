
<script language="javascript"  type="text/javascript">
	function selectDomains(theElement) {$smarty.ldelim}
		var theForm = theElement.form, z = 0;
		while (theForm[z].type == 'checkbox' && theForm[z].name != 'checkall') {$smarty.ldelim}
			theForm[z].checked = theElement.checked;
			z++;
		{$smarty.rdelim}
    {$smarty.rdelim}
</script>
                  <br>
<form method="post" action={$php_self}>
<table width="98%"class="border1" style="padding: 1px" cellspacing="1" cellpadding="2" align="center">
    <caption><b>Query Domain Lock Status</b></caption>
    <tr>
	    <td class=cellBg align="center">
		    Domain Extension:
			<select name="gtld">
			    <option value=""></option>
				{section name=r loop=$tld}
					<option value={$tld[r][0]} >{$tld[r][1]}</option>
				{/section}
            </select>&nbsp; &nbsp;
			<span style="display:{$show_query}">User: <input type="text" name="member_name">&nbsp; &nbsp; &nbsp;</span>
		</td>
	</tr>
	<tr>
	    <td class=cellBg align="center">
	        Domain Lock Status: &nbsp; &nbsp; &nbsp;
			<input type="radio" name=lock_status value="locked">Locked &nbsp; 
			<input type="radio" name=lock_status value="unlocked">Unlocked &nbsp; 
			<input type="radio" name=lock_status value="all">All
		</td>
	</tr>
	<tr>
	    <td class=cellBg align="center">	
		    Domain:  <input type="text" name="domain">&nbsp; &nbsp;
			<input type="submit" name="Submit" value="Search">
			<input type="hidden" name="action" value="listDomains">
		</td>
	</tr>
</table>
</form>
				  
				  
    <form method="post" action="{$php_self}" name="domainLock" >
    <table width="98%"  class="border1" style="padding: 0px" cellspacing="1" cellpadding="2" align="center">
        <tr class="fieldName"> 
          <td height="20"><input type="checkbox" name="selectdomain" onClick="selectDomains(this)"></td>
          <td height="20" align="center"><b><font color="#FFFFFF">Domain</font></b></td>
	<td height="20" align="center"><b><font color="#FFFFFF">User name</font></b></td>
          <td height="20" align="center"><b><font color="#FFFFFF">Registrar Transfer Lock status</font></b></td>
        </tr>
      {section name=i loop=$rs}
        <tr> 
          <td height="20" class="p8" {$rs[i][1]} >
	        <input type="checkbox" name="lock_domains[]" value="{$rs[i][0][1]}">
		  </td>
		  <td height="20" class="p8" {$rs[i][1]} align="center"> {$rs[i][0][1]} </td>
		  <td height="20" class="p8" {$rs[i][1]} align="center"> {$rs[i][0][3]} </td>
          <td height="20" class="p8" {$rs[i][1]} align="center">  {$rs[i][0][2]}  </td>
       </tr>
      {/section}
		
        <tr bgcolor="#CCCCCC"> 
          <td height="20" colspan="4"> 
            {$pagebutton}
          </td>
        </tr>
  </table>
  <table width="98%">
		  <tr><td>&nbsp;</td></tr>
          <tr align="center"> 
            <td  colspan="4"> 
				<input type="submit" name="Submit" value="Lock"> &nbsp; &nbsp;
				<input type="submit" name="Submit" value="Unlock">
				<input type="hidden" name="action" value="lockDomains">
            </td>
          </tr>

   </table>
   <input type="hidden" name="transation" value="{$transation}">
   </form>
      
