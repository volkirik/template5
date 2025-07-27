<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td > 
      <p><font color="#FF0000"><b><i><font size="3">Başarıyla kayıt oldunuz</font></i></b><br>
        <br>
        </font>Kullanıcı adınız: {$member_name}<br>
        Şifreniz: {$member_password1}<br>
        <br>
        Lütfen bunları güvenli bir yerde saklayın ve şifrenizi kimseyle paylaşmayın.<br>
        <br>
        {if $signup_return == "newmember"}
            Lütfen devam etmek için <a href="{$RELA_DIR}/domain/domainsearch.php?action=selectMember">buraya</a>
             tıklayın
        {else}
            Sistemi kullanmaya devam etmek için lütfen <a href="{$member_login}">giriş yapın</a> 
        şimdi.
        {/if} </p>
      </td>
  </tr>
</table>
<p>&nbsp;</p>

