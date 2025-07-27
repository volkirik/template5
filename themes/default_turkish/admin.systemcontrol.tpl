<p>&nbsp;</p>
<form action="{$content_action}" method="post">
  <table width="80%"  cellspacing="1" cellpadding="2" align="center"  style=" border-width: 1px; padding: 5px">
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Web Sitesi Teması</td>
      <td width="68%" height="25" bgcolor="#F2F8FD"> 
        <select name="current_skin">
		{section name=ent loop=$entry}
		 {if $entry[ent] == $current_skin}
          <option value="{$entry[ent]}" selected> 
          {$entry[ent]}
          </option>
	    {else}
          <option value="{$entry[ent]}"> 
          {$entry[ent]}
          </option>
        {/if}
    	{/section}
        </select>
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Web Sitesi Dili</td>
      <td width="68%" height="25" bgcolor="#F2F8FD"> 
        <select name="website_language">
          
{if $website_language == 1}

          <option value="1" selected>İngilizce</option>
          <option value="2">Türkçe</option>
          <?php
{else}

          <option value="1">İngilizce</option>
          <option value="2" selected>Türkçe</option>
{/if}
        </select>
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Başlık</td>
      <td width="68%" height="25" bgcolor="#F2F8FD"> 
        <input type="text" name="title" value="{$title}" size="40">
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Telif Hakkı</td>
      <td width="68%" height="25" bgcolor="#F2F8FD"> 
        <input type="text" name="copyright" value="{$copyright}" size="40">
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Sayfa Boyutu</td>
      <td width="68%" height="25" bgcolor="#F2F8FD"> 
        <input type="text" name="pagesize" value="{$pagesize}">
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Sistem Durumu</td>
      <td width="68%" height="25" bgcolor="#F2F8FD"> 
        <select name="status">
          
{if $system_status == 0}

          <option value="0" selected>Başlat</option>
          <option value="1">Durdur</option>
{else}

          <option value="0">Başlat</option>
          <option value="1" selected>Durdur</option>
{/if}
        </select>
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Bayi Kimliği</td>
      <td width="68%" height="25" bgcolor="#F2F8FD">
        <input type="text" name="customer_id" value="{$customer_id}">
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Bayi Şifresi</td>
      <td width="68%" height="25" bgcolor="#F2F8FD">
        <input type="password" name="customer_password" value="{$customer_password}">
      </td>
    </tr>
    <tr> 
      <td width="32%" height="25" bgcolor="#E1ECFB">Sunucu Adresi</td>
      <td width="68%" height="25" bgcolor="#F2F8FD">
        <input type="text" name="server_host" value="{$server_host}">
      </td>
    </tr>
    <tr>
      <td width="32%" height="25" bgcolor="#E1ECFB">Sunucu Portu</td>
      <td width="68%" height="25" bgcolor="#F2F8FD">
        <input type="text" name="server_port" value="{$server_port}">
      </td>
    </tr>
	<tr>
      <td width="32%" height="25" bgcolor="#E1ECFB">Mevcut Tema</td>
      <td width="68%" height="25" bgcolor="#F2F8FD">
        <select name="current_theme">
			{section name=ent loop=$themes}
				{if $themes[ent] == $current_theme}
					<option value="{$themes[ent]}" selected> 
				    	{$themes[ent]}
					</option>
				{else}
					<option value="{$themes[ent]}"> 
				    	{$themes[ent]}
					</option>
				{/if}
			{/section}
        </select>
      </td>
    </tr>
	<tr>
	    <td class=cellBg>Alan Adı Kilidini Etkinleştir</td>
	    <td class=cellBg2>
		    <input type="checkbox" name="domain_lock" value="Enabled" {$domain_lock}>
		</td>
	</tr>
    <tr>
	    <td class=cellBg>Alan Adı Otomatik Yenilemeyi Etkinleştir</td>
	    <td class=cellBg2>
		    <input type="checkbox" name="domain_renew" value="Enabled" {$domain_renew}>
		</td>
	</tr>
  </table>
  <br>
  <br>
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td width="32%">&nbsp;</td>
      <td width="68%"> 
        <input type="submit" name="Submit" value="Sistemi Güncelle">
      </td>
    </tr>
    <tr> 
      <td width="32%">&nbsp;</td>
      <td width="68%">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2">Not: "Sunucu Adresi" satırında, şablonu gerçek zamanlı ortamda çalıştırmak istiyorsanız "www.onlinenic.com" yazın. Şablonu önce test etmek isterseniz "218.5.65.6" yazın.</td>
    </tr>
  </table>
  <br>
  <input type="hidden" name="action" value="setStatus">
</form>
<p>&nbsp;</p>

