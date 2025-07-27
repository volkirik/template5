<form action="{$php_self}" method="post">
<table width="100%" cellspacing="1" cellpadding="2" align="center" class=border1 style="border-width: 1px; padding: 1px">
    <tr class="fieldName"> 
        <td align="center"> <font color="#FFFFFF"> Sorgular</font></td>
    </tr>
    <tr><td> &nbsp; </td></tr>
    <tr>   
        <td bgcolor="#F2F8FD" align="center"><input type="text" name="sql_products" style="width: 500px;"> </td>
    </tr>
    <tr> 
        <td align="center"><font style="font-size: 11px;">{$sql_products}</td>
    </tr>
    <tr><td> &nbsp; </td></tr>
    
    <tr>   
        <td bgcolor="#F2F8FD" align="center"> <input type="text" name="sql_ordermode1" style="width: 500px;"> </td>
    </tr>
    <tr> 
        <td align="center"><font style="font-size: 11px;">{$sql_ordermode1}</td>
    </tr>
    <tr><td> &nbsp; </td></tr>
    
    <tr>   
        <td bgcolor="#F2F8FD" align="center"> <input type="text" name="sql_ordermode2" style="width: 500px;"> </td>
    </tr>
    <tr>
        <td align="center"><font style="font-size: 11px;">{$sql_ordermode2}</td>
    </tr>
    <tr><td> &nbsp; </td></tr>
    
    <tr>   
        <td bgcolor="#F2F8FD" align="center"> <input type="text" name="sql_ordermode3" style="width: 500px;"> </td>
    </tr>
    <tr>
        <td align="center"><font style="font-size: 11px;">{$sql_ordermode3}</td>
    </tr>
    <tr><td> &nbsp; </td></tr>
    
    <tr>   
        <td bgcolor="#F2F8FD" align="center"> <input type="text" name="sql_ordermode4" style="width: 500px;"> </td>
    </tr>
    <tr>
        <td align="center"><font style="font-size: 11px;">{$sql_ordermode4}</td>
    </tr>
    <tr><td> &nbsp; </td></tr>
    
    <tr>   
        <td bgcolor="#F2F8FD" align="center"> <input type="text" name="sql_ordermode5" style="width: 500px;"> </td>
    </tr>
    <tr>
        <td align="center"><font style="font-size: 11px;">{$sql_ordermode5}</td>
    </tr>
</table>    
<table>
    <tr><td> &nbsp; </td></tr>
    <tr> 
      <td align="center" style="width: 550px;"> 
        <input type="submit" name="Submit" value="Ekle">&nbsp;
        <input type="reset" name="Reset" value="Sıfırla">
      </td>
    </tr>
</table>
<input type="hidden" name="action" value="upgradeDomain">
</form>

