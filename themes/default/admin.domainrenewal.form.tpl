
<script language="javascript"  type="text/javascript">
	function selectDomains(theElement) {$smarty.ldelim}
		var theForm = theElement.form, z = 0;
		while (theForm[z].type == 'checkbox' && theForm[z].name != 'checkall') {$smarty.ldelim}
			theForm[z].checked = theElement.checked;
			z++;
		{$smarty.rdelim}
    {$smarty.rdelim}
    
    function acceptAgreement() {$smarty.ldelim}
        
        if (document.domainRenew.agreement.checked) {$smarty.ldelim}
            document.domainRenew.submit1.disabled = false;
            document.domainRenew.submit2.disabled = false;	
            
        {$smarty.rdelim}  else {$smarty.ldelim}
            document.domainRenew.submit1.disabled = true;
            document.domainRenew.submit2.disabled = true;
        {$smarty.rdelim}
        
    {$smarty.rdelim}
    
</script>
                  <br>
<form method="post" action={$php_self}>
<table width="98%"class="border1" style="padding: 1px" cellspacing="1" cellpadding="2" align="center">
    <caption><b>Domain Auto-Renewal Status Query</b></caption>
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
	        Domain Auto-Renewal: &nbsp; &nbsp; &nbsp;
			<input type="radio" name=renew_status value="enabled" >Yes &nbsp; 
			<input type="radio" name=renew_status value="disabled">No &nbsp; 
		</td>
	</tr>
	<tr>
	    <td class=cellBg align="center">	
		    Domain:  <input type="text" name="domain">&nbsp; &nbsp;
			<input type="submit" name="Submit" value="Search">
			<input type="hidden" name="action" value="listDomains">
		</td>
	</tr>
    <tr>
        <td class=cellBg2>
            <font color="#FF0000">Search:</font> Please choose domain extension, domain Auto-Renewal status or 
            enter a domain name, to search for specific domain(s) you would like to enable or disable the 
            Auto-Renewal option.
        </td>
    </tr>
</table>
</form>
			  
				  
    <form method="post" action="{$php_self}" name="domainRenew" >
    <table width="98%"  class="border1" style="padding: 0px" cellspacing="1" cellpadding="2" align="center">
        <tr class="fieldName"> 
          <td ><input type="checkbox" name="selectdomain" onClick="selectDomains(this)"></td>
          <td  align="center"><b><font color="#FFFFFF">Domain</font></b></td>
          <td  align="center"><b><font color="#FFFFFF">Domain Auto-Renewal status</font></b></td>
          <td  align="center"><b><font color="#FFFFFF">Domain Expiration Date</font></b></td>        
        </tr>
      {section name=i loop=$rs}
        <tr> 
          <td  class="p8" {$rs[i][1]} >
	        <input type="checkbox" name="renew_domains[]" value="{$rs[i][0][0]}">
		  </td>
		  <td  class="p8" {$rs[i][1]} align="center"> {$rs[i][0][0]} </td>
          <td  class="p8" {$rs[i][1]} align="center">  {$rs[i][0][1]}  </td>
          <td  class="p8" {$rs[i][1]} align="center">  {$rs[i][0][2]}  </td>
       </tr>
      {/section}
		
        <tr bgcolor="#CCCCCC"> <td  colspan="4">  {$pagebutton} </td></tr>
       
  </table>
  <table width="98%" align=center>
            <tr><td>&nbsp;</td></tr>
         <tr>
            <td align="center"><input type="checkbox" name="agreement" onClick="acceptAgreement()">
                   I have read, understand and accept the <a href={$RELA_DIR}help/domain_auto_renewal_agreement.html target="blank">Domain Auto-Renewal Agreement</a>
            </td>
         </tr>
		  <tr><td><hr></td></tr>
          <tr> 
            <td align="center" colspan="4"> 
				<input type="submit" name="submit1" value="Enable Auto-Renewal" disabled="true"> &nbsp; &nbsp;
				<input type="submit" name="submit2" value="Disable Auto-Renewal" disabled="true">
				<input type="hidden" name="action" value="renewDomains">
            </td>
          </tr>

   </table>
   <input type="hidden" name="transation" value="{$transation}">
   </form>
  <table width="95%" class=border1 align=center>
    <tr><td></td></tr>
    <tr>
        <td> &nbsp; &nbsp; If domain abc.com's expiration date is 10/10/2004, there will be a 10 day grace period for the
         domain renewal.<br>
         &nbsp; &nbsp; The action of renewal will start on  10/1/2004 and stop on 10/10/2004. During the grace period,
         you will have enough time to fund your account.<br><br>
         &nbsp; &nbsp; Note: If you dont't want to make a domain auto-renewable, please make sure you disable autorenewal
         days ahead of domain expiration day.
        </td>
    </tr>
  </table>
