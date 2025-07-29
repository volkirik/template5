
<script language="javascript">
	function renewDomain(myForm)
	{$smarty.ldelim}
		myYear = prompt("For how many years would you like to renew this domain?", '1');
		myForm.year.value = myYear;
		myForm.action.value = "renewDomain";
		myForm.submit();
	{$smarty.rdelim}
 function deleteDomain(myForm)
        {$smarty.ldelim}
        if(confirm("Are you sure to delete this domain?"))
                myForm.action.value = "deleteDomain";
        myForm.submit();
        {$smarty.rdelim}

</script>
                  <br>

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> <b><br>
      </b> <br>
      <form action="{$php_self}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#E1ECFB" class="border1">
          <tr>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
                <tr> 
                  <td align=center> Time: 
                    <select name="startYear">
                      <option>Year</option>
  


		    	{section name=yr loop=$iyr}
				{if $startYear == $iyr[yr]}
					<option value= {$iyr[yr]} selected>{$iyr[yr]}
				{else}
					<option value= {$iyr[yr]} >  {$iyr[yr]}
				{/if}
				{/section}
					</select>
                    <select name="startMonth">
                      <option>Mon</option>

				{section name=month loop=$imonth}
				{if $startMonth == $imonth[month]}
								<option value={$imonth[month]} selected>{$imonth[month]}
				{else}
					<option value= {$imonth[month]}> {$imonth[month]}
				{/if}
				{/section}
                    </select>
                    <select name="startDay">
                      <option>Day</option>
				{section name=day loop=$iday}
				{if $startDay == $iday[day]}

					<option value= {$iday[day]}  selected>{$iday[day]}
				{else}
					<option value={$iday[day]} >{$iday[day]}
				{/if}
				{/section}

                    </select>
                    to 
                    <select name="toYear">
                      <option>Year</option>
                 
					  
			
	        {section name=yr loop=$iyr}
				{if $toYear == $iyr[yr]}
					<option value= {$iyr[yr]} selected>{$iyr[yr]}
				{else}
					<option value= {$iyr[yr]} >  {$iyr[yr]}
				{/if}
			{/section}				  
    

                    </select>
                    <select name="toMonth">
                      <option>Mon</option>
					{section name=month loop=$imonth}
					{if $toMonth  == $imonth[month]}
						<option value={$imonth[month]} selected>{$imonth[month]}
					{else}
						<option value= {$imonth[month]}> {$imonth[month]}
					{/if}
					{/section}  
                    </select>
                    <select name="toDay">
                      <option>Day</option>
					  
                {section name=day loop=$iday}
				{if $toDay == $iday[day]}

					<option value= {$iday[day]}  selected>{$iday[day]}
				{else}
					<option value={$iday[day]} >{$iday[day]}
				{/if}
				{/section}  
				    
                    </select>
                  </td>
                </tr>
              </table>
              <br>
              <table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
                <tr> 
                  <td width="7%">Type: </td>
                  <td width="12%"> 
                    <select name="product_id">
                      <option value="">All</option>
                      

					{section name=rs loop=$rs2}
					{if $rs2[0] == $product_id}

						<option value= {$rs2[rs][1]} selected> {$rs2[rs][1]}</option>
					{else}
						<option value= {$rs2[rs][1]} >{$rs2[rs][1]} </option>
					{/if}
					{/section}
								</select>
                  </td>
                  <td width="7%">Member:</td>
                  <td width="10%"> 
                    <input type="text" name="member_name" size="10" value="{$member_name}">
                  </td>
                  <td width="10%">Domain:</td>
                  <td width="7%"> 
                    <input type="text" name="domain_name" size="10" value="{$domain_name}">
                  </td>
                  <td width="47%"> 
                    <input type="submit" name="Submit" value="Query">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <br>
      </form>
      <form method="post" action="{$php_self}" name="domainManage" style="margin:0px">
        <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center">
          <tr class="fieldName"> 
            <td width="4%" height="20"><b><font color="#FFFFFF">&nbsp;</font></b></td>
            <td width="26%" height="20"><b><font color="#FFFFFF">Domain(User Name)</font></b></td>
            <td width="20%" height="20"><b><font color="#FFFFFF">Dns1</font></b></td>
            <td width="20%" height="20"><b><font color="#FFFFFF">Dns2</font></b></td>
            <td width="20%" height="20"><b><font color="#FFFFFF">Reg. Date </font></b></td>
            <td width="16%" height="20"><b><font color="#FFFFFF"> Reg. Year</font></b></td>
          </tr>

     {section name=i loop=$rs}
          <tr> 
            <td height="20" class="p8"{$rs[i][1]} width="4%"> 
              <input type="radio" name="domain_id" value="{$rs[i][0][0]}">
            </td>
            <td height="20" class="p8"{$rs[i][1]} width="27%"> <a href="{$php_self}?action=showContact&domain_id={$rs[i][0][0]}" class="menu2"> 
              {$rs[i][0][1]}({$rs[i][0][8]}) 
              </a> </td>
            <td height="20" class="p8"{$rs[i][1]} width="15%"> <a href="{$php_self}?action=showNS&domain_id={$rs[i][0][0]}" class="menu2"> 
             {$rs[i][0][6]}
              </a> </td>
            <td height="20" class="p8"{$rs[i][1]} width="17%"> 
              {$rs[i][0][7]}
            </td>
            <td height="20" class="p8"{$rs[i][1]} width="25%"> 
             {$rs[i][0][4]}
            </td>
            <td height="20" class="p8"{$rs[i][1]} width="16%"> 
             {$rs[i][0][5]}
            </td>
          </tr>
	    {/section}
		
          <tr bgcolor="#CCCCCC"> 
            <td height="20" colspan="6"> 
              {$pagebutton}
            </td>
          </tr>
          <tr align="center"> 
            <td height="20" colspan="6"> 
              <p>&nbsp;</p>
              <p> 
                <input type="button" name="renew" value="Renew domain" onClick = "renewDomain(this.form);">
                <input type="button" name="delete" value="Delete domain" onClick="deleteDomain(this.form);">
              </p>
            </td>
          </tr>
          <?php
}
?>
        </table>
      <input type="hidden" name="transation" value="{$transation}">
	  <input type="hidden" name="action" value="">
	  <input type="hidden" name="year" value="">
      </form>
      
    </td>
  </tr>
</table>
                  <p>&nbsp;</p>
