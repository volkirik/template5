<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td><form action={$content_action} method="post" style="margin:0px">
	   <table cellspacing="5" cellpadding="0" align=center >
		<tr> 
          <td align="center" width="40%">Kullanıcı Adı:</td>
          <td width="60%"> 
              <input type="text" name="username">
          </td>
        </tr>
        <tr> 
          <td align="center" width="40%">Şifre:</td>
          <td width="60%"> 
              <input type="password" name="password">
          </td>
        </tr>
        <tr> 
          <td align="center" width="40%"><img src="{$RELA_DIR}common/Captcha/displayCaptcha.php"></td>
          <td width="60%"> Captcha giriniz;<br>
              <input type="text" name="keystring">
          </td>
        </tr>
        <tr> 
          <td align="right" width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" width="40%">&nbsp;</td>
          <td width="60%" align=center>
            <input type="submit" name="Submit" value="Giriş Yap">
            <input type="hidden" name="action" value="Login">
          </td>
        </tr>
      </table>
	  </form>
      <p align="center"><br>
        Şifrenizi mi unuttunuz? <a href="{$getpassword}" target=blank>Buraya tıklayın</a>.<br>
        <br>
        Henüz üye değil misiniz? <a href="{$signup}" >kayıt olmak için buraya tıklayın</a>!</p>
      </td>
  </tr>
</table>

