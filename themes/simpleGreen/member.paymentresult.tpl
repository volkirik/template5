 <br>
 
    <table align=center cellpadding=2 cellspacing=1>
        <tr><td><b>
            {if $paid_status == 'paid'} 
                Payment completed successfully !</b><br> Click Continue to finish processing. 
                </td> </tr><tr><td>&nbsp;</td> </tr>
        
                <form action={$php_self} method=POST>
                    <tr><td align="center">
                        <input type=submit name=submit value="Continue">
                        <input type="hidden" name="action" value="initDomainRegistration">
                    </td></tr>

                </form>
            {else}
                Payment failed! </b><br><br> Status: {$paid_status}
                </td> </tr><tr><td>&nbsp;</td> </tr>
        
                <form action={$php_self} method=POST>
                    <tr><td align="center">
                        <input type=submit name=submit value="Continue">
                    </td></tr>

                </form>
            {/if}
       

    </table>    
