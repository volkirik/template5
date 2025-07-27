<script language="javascript">
    function renewDomain(myForm)
    {$smarty.ldelim}
        myYear = prompt("Bu alan adını kaç yıl yenilemek istersiniz?", '1');
        myForm.year.value = myYear;
        myForm.action.value = "renewDomain";
        myForm.submit();
    {$smarty.rdelim}

    function deleteDomain(myForm)
    {$smarty.ldelim}
        myForm.action.value = "deleteDomain";
        myForm.submit();
    {$smarty.rdelim}
</script>
<br>
<form method="post" action={$php_self}>
<table width="98%" class="border1" style="padding: 1px" cellspacing="1" cellpadding="2" align="center">
    <tr>
        <td class=cellBg align="center">
           <span style="display:{$show_query}"> Üye: <input type="text" name="member_name">&nbsp; &nbsp;</span>
            DNS: <input type="text" name="dns_name">&nbsp; &nbsp; &nbsp;
            <input type="submit" name="Submit" value="Sorgula">
            <input type="hidden" name="action" value="listDns">
        </td>
    </tr>
</table>
</form>

<form method="post" action="{$php_self}" name="dnsManage" >
    <table width="98%" class="border1" style="padding: 0px" cellspacing="1" cellpadding="2" align="center">
        <tr class="fieldName"> 
            <td height="20" align="center"><b><font color="#FFFFFF">DNS</font></b></td>
            <td height="20" align="center"><b><font color="#FFFFFF">IP</font></b></td>
            <td height="20" align="center"><b><font color="#FFFFFF">Kayıt Tarihi</font></b></td>
        </tr>
        {section name=i loop=$rs}
        <tr> 
            <td height="20" class="p8"{$rs[i][1]} align="center">
                <a href="{$php_self}?action=modifyDnsForm&dns={$rs[i][0][2]}&ip={$rs[i][0][3]}&dns_id={$rs[i][0][0]}"> 
                    {$rs[i][0][2]}
                </a>
            </td>
            <td height="20" class="p8"{$rs[i][1]} align="center">  {$rs[i][0][3]}  </td>
            <td height="20" class="p8"{$rs[i][1]} align="center">  {$rs[i][0][4]}  </td>
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
            <td colspan="4"> 
                <!--<input type="submit" name="Submit" value="Yeni DNS Ekle" onClick = "renewDomain(this.form);"> -->
                <input type="submit" name="Submit" value="Yeni DNS Ekle"> 
                <input type="hidden" name="action" value="registerDnsForm">
            </td>
        </tr>
    </table>
    <input type="hidden" name="transation" value="{$transation}">
</form>

