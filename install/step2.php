<html>
<head>
<title>OnlineNIC Template 4.0 Install Wizard</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--
<style>
	body, td, tr, table, p {font-family:Verdana, Arial}
</style>
-->
<link type="text/css"  href="style.css" rel="StyleSheet">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr> 
    <td colspan="2" height="9"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#0B79B5"> 
          <td height="50" width="1%" bgcolor="#0B79B5">&nbsp;</td>
          <td height="50" width="33%" bgcolor="#0B79B5"><img src="images/title.jpg" width="217" height="51"></td>
          <td height="50" width="45%" bgcolor="#0B79B5">&nbsp;</td>
          <td height="50" width="21%" bgcolor="#0B79B5">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="5
	" bgcolor="#FFCC00"></td>
        </tr>
      </table>
</td>
  </tr>
  <tr> 
    <td width="20%" bgcolor="#98BCED" valign="top"> 
      <p>&nbsp;</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="22" width="8%"><font color="#FFCC00"></font></td>
          <td height="22" width="92%"><b><font color="#FFFFFF">Start</font></b></td>
        </tr>
        <tr> 
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%"><b><font color="#FFFFFF">Database Setting</font></b></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%"><b><font color="#EDB903">Data Initialization</font></b></td>
        </tr>
        <tr> 
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%"><b><font color="#FFFFFF">End</font></b></td>
        </tr>
        <tr> 
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%">&nbsp;</td>
        </tr>
        <tr> 
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%">&nbsp;</td>
        </tr>
        <tr> 
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%">&nbsp;</td>
        </tr>
        <tr>
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%"><b><a href="../help/installation.html" target="_blank"><font color="#FFFFFF">Install 
            Help</font></a></b></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </td>
    <td width="80%" valign="top"> <br>
      <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td> 
            <p align="center"><font size="4" face="Arial, Helvetica, sans-serif"><b><font color="#DFB300">OnlineNIC's 
                Reseller Template System (Version 4.0)</font></b></font></p>
              
            <p><b><font size="2">Data initalization</font></b><font size="2"><br>
              At this setp, please set the surface of template and create Super-Administrator.<br>
                <br>
                </font></p>
	      <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" style="margin:0px">
	      <input type="hidden" name="action" value="step3">
              <table width="80%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#000000">
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Super-Administrator 
                    Password * </font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="password" name="admin_password1"  size="100" value="<?php echo isset($admin_password1) ? $admin_password1 : ''; ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Confirm 
                    Password *</font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="password" name="admin_password2" value="<?php echo isset($admin_password2)? $admin_password2 : ''; ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Super-Administrator 
                    Name * </font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="text" name="admin_name" value="<?php echo isset($admin_name) ? $admin_name : '';?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Super-Administrator 
                    Dept. *</font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="text" name="admin_dept" value="<?php echo isset($admin_dept) ? $admin_dept : ''; ?>">
                  </td>
                </tr>
                <tr>
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><font size="2"><b>Super-Administrator 
                    E-mail *</b></font> </td>
                  <td height="22" width="57%" bgcolor="#DBD9C7">
                    <input type="text" name="support_email" value="<?php echo isset($support_email) ? $support_email : ''; ?>">
                  </td>
                </tr>
              </table>
              <br>
              <table width="80%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#000000">
                  <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Website 
                    Language * </font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <select name="website_language">
                      <?php
if($website_language == 1)
{
?>
                      <option value="1" selected>English</option>
                      <option value="2">Turkish</option>
                      <?php
}else if($website_language == 2) {
?>
                      <option value="1">English</option>
                      <option value="2" selected>Turkish</option>
                      <?php
}else {
?>
                      <option value="1" selected>English</option>
                      <option value="2">Turkish</option>
                      <?php
}
?>
                    </select>
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Website 
                    Title *</font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="text" name="website_title" size="30" value="<?php echo isset($website_title) ? $website_title : ''; ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Website 
                    Copyright * </font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="text" name="website_copyright" size="30" value="<?php echo isset($website_copyright) ? $website_copyright : ''; ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="34" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Pagesize *</font></b></td>
                  <td height="34" width="57%" bgcolor="#DBD9C7"> 
                    <input type="text" name="website_pagesize" value="<?php echo isset($website_pagesize) ? $website_pagesize : ''; ?>">
                  </td>
                </tr>
              </table>
              <br>
              <table width="80%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#000000">
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">OnlineNIC 
                    Customer ID *</font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="text" name="customer_id" value="<?php echo isset($customer_id) ? $customer_id : ''; ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="43%" bgcolor="#FFCC00" align="center"><b><font size="2">Customer 
                    Password * </font></b></td>
                  <td height="22" width="57%" bgcolor="#DBD9C7"> 
                    <input type="password" name="customer_password" value="<?php echo isset($customer_password) ? $customer_password : ''; ?>">
                  </td>
                </tr>
              </table>
              <p align="center"> 
                <input type="submit" name="Submit" value="Next &gt;&gt;">
              </p>
              <p align="center">Please be sure that all marked field are filed up&nbsp;</p>
			  </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
