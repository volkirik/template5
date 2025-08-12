<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td><form action={$content_action} method="post" style="margin:0px">
	   <table cellspacing="5" cellpadding="0" align=center >
		<tr> 
          <td align="center" width="40%">Username:</td>
          <td width="60%"> 
              <input type="text" name="username">
          </td>
        </tr>
        <tr> 
          <td align="center" width="40%">Password:</td>
          <td width="60%"> 
              <input type="password" name="password">
          </td>
        </tr>
        <tr> 
          <td align="center" width="40%"><img src="{$RELA_DIR}common/Captcha/displayCaptcha.php"></td>
          <td width="60%"> Enter Captcha;<br>
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
            <input type="submit" name="Submit" value="Login">
          </td>
        </tr>
      </table>
	  </form>
      <p align="center"><br>
        Forgot your password? <a href="{$getpassword}">Click here</a>.<br>
        <br>
        If you are not yet a member, <a href="{$signup}">click here</a> 
        to signup!</p>
      </td>
  </tr>
</table>
