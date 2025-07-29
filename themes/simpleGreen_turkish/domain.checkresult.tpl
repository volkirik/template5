<br>

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
   <tr>
     
    <td width="25%" height="25" colspan="2"><b>

{if $result == 1}
	Bu alan adları mevcut değil
{else}
	Bu alan adları mevcut
{/if}
    </b><br>
      <br>
      <form action="{$php_self}" method="post" style="margin:0px">
      <input type="hidden" name="action" value="showRegisterForm">
      <input type="hidden" name="domain" value="{$domain}">
      <input type="hidden" name="gtld" value="{$gtld}">
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="30" bgcolor="#EFEFEF" align="center">

{if $result == 1}
    {$real_domain}
{else}
	{$real_domain}
	</td><td bgcolor="#EFEFEF"><input type="submit" name="Submit" value="Kayıt Ol >>">
{/if}
          </td>
        </tr>
      </table>
      </form>
      <br>
      <br>
      Daha fazla alan adı kontrol etmek istiyorsanız, lütfen aşağıya alan adını girin 
      ve alan adını kontrol etmek için "Kontrol Et"e tıklayın.<br>
      <br>
    </td>
  </tr>
  <tr> 
    <td >
	  <form action="{$php_self}" method="post" style="margin:0px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td align="right" width="26%">www.</td>
            <td width="38%"> 
              <input type="text" name="domain">
              <select name="gtld">
         {section name=r loop=$rs}
            <option value={$rs[r][0]}> {$rs[r][1]} </option>
		{/section}
              </select>
            </td>
            <td width="36%"> 
              <input type="submit" name="Submit" value="Kontrol Et">
              <input type="hidden" name="action" value="checkDomain">
            </td>
          </tr>
        </table>
	  </form>
      <p><br>
        <br>
        <b>Alan Adı Formatı: </b><br>
        Bir alan adı, büyük/küçük harfe duyarsız İngilizce harfler, sayılar ve 
        kısa çizgiden oluşan rastgele bir birleşimdir. Dize uzunluğu 67 karakteri 
        geçemez. Kısa çizgi ('-') karakter dizisinin başında veya sonunda yer 
        alamaz. Örneğin, 'eat-at-joes.com' geçerli bir alan adıdır, '-eatatjoes.com' 
        geçerli değildir.</p>
      </td>
  </tr>
</table>
<p>&nbsp;</p>

