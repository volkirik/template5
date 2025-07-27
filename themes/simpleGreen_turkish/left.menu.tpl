
<table width="100%" cellspacing=0 cellpadding=0 style="width: 183px;">
    <TR>
        <TD  class="lightGreen2">
            {if $left_menu[0][1]  == "title"}
			    {$left_menu[0][0]} 
			{/if}
        </TD>
    </tr>
    
    {if $left_menu[0][1]  == "link"}
        <tr>
            <TD  class="lightGreen1">
              {*  <ul class="bulletStyle"> <li>*}
                    {$left_menu[0][0]}
              {*  </li> </ul>*}
            </TD>
        </tr>
    {/if}
    
    {section name=side start=1 loop=$left_menu}
		{if $left_menu[side][1] != "title"}
            <tr>
                <TD  class="lightGreen1">
                  {*  <ul class="bulletStyle"> <li>*}
                        {$left_menu[side][0]}
                   {*  </li> </ul>*}
                </TD>
            </tr>
        {else}
            <TR>
                <TD  class="lightGreen2">
                    {$left_menu[side][0]}
                </TD>
            </tr>
        {/if}
    {/section}
    
    <TR><TD  class="lightGreen2">&nbsp;</TD></TR>
    <TR><TD  class="lightGreen1"><br><br><br></TD></TR>
</table>
