<table width="95%" border="0" align="center">
  <tr> 
    <td>
      <form action="{$content_action}" method="post" style="margin:0px">
      <table width="100%" border="0">
        <tr> 
            <td align="right" width="40%">Kullanıcı Adı:</td>
          <td width="60%"> 
              <input type="text" name="username" value="{$content_user}">
          </td>
        </tr>
        <tr> 
            <td align="right" width="40%">E-posta:</td>
          <td width="60%"> 
              <input type="text" name="email" value="{$content_email}">
          </td>
        </tr>
        {if isset($CAPTCHA_ENABLE) && $CAPTCHA_ENABLE===1 }
        <tr> 
          <td align="right" width="40%"><img src="{$RELA_DIR}common/Captcha/displayCaptcha.php"></td>
          <td width="60%"> Captcha giriniz;<br>
              <input type="text" name="keystring">
          </td>
        </tr>
        {/if}
        <tr> 
          <td align="right" width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" width="40%">&nbsp;</td>
          <td width="60%">
              <input type="submit" name="Submit" value="Şifreyi Al">
          </td>
        </tr>
      </table>
	  </form>
      <p align="center"><br>
        <br>
        <br>
        Henüz üye değil misiniz? <a href="{$content_signup}">kayıt olmak için buraya tıklayın</a>!</p>
      </td>
  </tr>
</table>

