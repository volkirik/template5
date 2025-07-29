<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> <b><br>
      </b> 
      <table width="50%" border="0" cellspacing="1" cellpadding="2" class="border1" align="center">
        <tr> 
          <td height="20" width="30%" bgcolor="#E1ECFB"><b>Hesap</b></td>
          <td height="20" width="70%" bgcolor="#F2F8FD"> <b>
            {$member_info[1]}
            </b></td>
        </tr>
        <tr> 
          <td height="20" width="30%" bgcolor="#E1ECFB"><b>Seviye</b></td>
          <td height="20" width="70%" bgcolor="#F2F8FD"> <b>
            {$member_info[4]}
            </b></td>
        </tr>
        <tr> 
          <td height="20" width="30%" bgcolor="#E1ECFB"><b>Bakiye</b></td>
          <td height="20" width="70%" bgcolor="#F2F8FD"> <font color="#000000">$ 
         {$member_info[6]}
            </font></td>
        </tr>
      </table>
      <b><br>
      <br>
      Sipariş geçmişim</b><br>
      <hr size="1">
      <br>
      <form action="{$php_self}" method="post" style="margin:0px">
        <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#E1ECFB" class="border1">
          <tr>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td> Zaman: 
                    <select name="startYear">
                      <option>Yıl</option>
		        {section name=yr loop=$iyr}
					{if $startYear == $iyr[yr]}
						<option value={$iyr[yr]} selected>{$iyr[yr]}
					{else}
						<option value={$iyr[yr]}>{$iyr[yr]}
					{/if}
				{/section}
                    </select>
                    <select name="startMonth">
                      <option>Ay</option>
                {section name=month loop=$imonth}
					{if $startMonth == $imonth[month]}
						<option value={$imonth[month]} selected>{$imonth[month]}
					{else}
						<option value={$imonth[month]}>{$imonth[month]}
					{/if}
			    {/section}
                    </select>
                    <select name="startDay">
                      <option>Gün</option>

			{section name=day loop=$iday}
				{if $startDay == $iday[day]}

					<option value={$iday[day]} selected>{$iday[day]}
				{else}
					<option value={$iday[day]}>{$iday[day]}
				{/if}
			{/section}
                    </select>
                    ile 
                    <select name="toYear">
                      <option>Yıl</option>

    		  {section name=yr loop=$iyr}
				{if $toYear == $iyr[yr]}
					<option value={$iyr[yr]} selected>{$iyr[yr]}
				{else}
					<option value={$iyr[yr]}>{$iyr[yr]}
				{/if}
			{/section}
                    </select>
                    <select name="toMonth">
                      <option>Ay</option>
           		{section name=month loop=$imonth}
					{if $toMonth == $imonth[month]}
						<option value={$imonth[month]} selected>{$imonth[month]}
					{else}
						<option value={$imonth[month]}>{$imonth[month]}
					{/if}
				{/section}
                    </select>
                    <select name="toDay">
                      <option>Gün</option>

           {section name=day loop=$iday}
				{if $toDay == $iday[day]}
					<option value={$iday[day]} selected>{$iday[day]}
				{else}
					<option value={$iday[day]}>{$iday[day]}
				{/if}
			{/section} 
                    </select>
                  </td>
                </tr>
              </table>
              <br>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td width="10%">Ürün: </td>
                  <td width="18%"> 
                    <select name="product_id">
                      <option>Tümü</option>

       		{section name=rs loop=$rs2}
					{if $rs2[0] == $product_id}
						<option value={$rs2[rs][0]} selected> {$rs2[rs][1]}</option>
					{else}
						<option value={$rs2[rs][0]}> {$rs2[rs][1]}</option>
					{/if}
			{/section}

                    </select>
                  </td>
                  <td width="14%">İşlem: </td>
                  <td width="18%"> 
                    <select name="transation">
                      
{if $transation == "1,2"}
                      <option value="1,2" selected>Tümü</option>
                      <option value="1">Para Yatırma</option>
                      <option value="2">Ödeme</option>
{elseif $transation == "1"}
                      <option value="1,2">Tümü</option>
                      <option value="1" selected>Para Yatırma</option>
                      <option value="2">Ödeme</option>
{else}
                      <option value="1,2">Tümü</option>
                      <option value="1">Para Yatırma</option>
                      <option value="2" selected>Ödeme</option>
{/if}
                    </select>
                  </td>
                  <td width="40%"> 
                    <input type="submit" name="Submit" value="Sorgula">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <br>
      </form>
      <form style="margin:0px">
        <table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
          <tr class="fieldName"> 
            <td width="18%" height="20"><b><font color="#FFFFFF">&nbsp;İşlem</font></b></td>
            <td width="26%" height="20"><b><font color="#FFFFFF">&nbsp;Zaman</font></b></td>
            <td width="14%" height="20"><b><font color="#FFFFFF">&nbsp;Tutar</font></b></td>
            <td width="22%" height="20"><b><font color="#FFFFFF">&nbsp;Yöntem</font></b></td>
            <td width="20%" height="20"><b><font color="#FFFFFF">&nbsp;Not</font></b></td>
        </tr>
  {if $rs}
    {section  name=i loop=$rs}
        <tr>
          <td height="20" class="p8" {$rs[i][1]}>

		{if $rs[i][0][3] == 1}
			para yatırma
		{else}
			ödeme
		{/if}

          </td>
          <td height="20" class="p8" {$rs[i][1]}>
            {$rs[i][0][2]}
          </td>
          <td height="20" class="p8" {$rs[i][1]}>
            {$rs[i][0][5]}
          </td>
          <td height="20" class="p8" {$rs[i][1]}>
    		{*$rs[i][0][3]*}	{$rs1[i]}
          </td>
          <td height="20" class="p8" {$rs[i][1]}>
            {$rs[i][0][8]}
          </td>
        </tr>
	{/section}
        <tr> 
          <td height="20" bgcolor="#CCCCCC" colspan="5">
	 {$pagebutton}
          </td>
        </tr>
{/if}
      </table>
      <input type="hidden" name="transation" value="{$transation}">
      </form>
      
    </td>
  </tr>
</table>
<p>&nbsp;</p>

