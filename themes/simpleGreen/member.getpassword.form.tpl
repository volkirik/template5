<table width="95%" border="0"  align="center">
  <tr> 
    <td >
      <form action="{$content_action}" method="post" style="margin:0px">
      <table width="100%" border="0" >
        <tr> 
            <td align="right" width="40%">Username:</td>
          <td width="60%"> 
              <input type="text" name="username" value="{$content_user}">
          </td>
        </tr>
        <tr> 
            <td align="right" width="40%">E-mail:</td>
          <td width="60%"> 
              <input type="text" name="email" value="{$content_email}">
          </td>
        </tr>
        <tr> 
          <td align="right" width="40%"><img src="{$RELA_DIR}common/Captcha/displayCaptcha.php"></td>
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
          <td width="60%" >
              <input type="submit" name="Submit" value="Get password">
          </td>
        </tr>
      </table>
	  </form>
      <p align="center"><br>
        <br>
        <br>
        If you are not yet a member, <a href="{$content_signup}">click here</a> 
        to signup!</p>
      </td>
  </tr>
</table>
          
