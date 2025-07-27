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
          <td height="22" width="8%" bgcolor="#FFFFFF">&nbsp;</td>
          <td height="22" width="92%" bgcolor="#FFFFFF"><b><font color="#EDB903">Database 
            Setting</font></b></td>
        </tr>
        <tr> 
          <td height="22" width="8%">&nbsp;</td>
          <td height="22" width="92%"><b><font color="#FFFFFF">Data Initialization</font></b></td>
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
              <p><b><font size="2">Database setting</font></b><font size="2"><br>
              At this setp, please input database host, database name, username 
              and password. Please be sure that full permission is given to file server.inc.php and  directory common/Smarty/smarty/templates_c. <br>
                <br>
                </font></p>
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" style="margin:0px">
		<input type="hidden" name="action" value="step2">
              <table width="80%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#000000">
                <tr> 
                  <td height="22" width="32%" bgcolor="#FFCC00" align="center"><b><font size="2">Database 
                    Type </font></b></td>
                  <td height="22" width="68%" bgcolor="#DBD9C7"> 
                    <select name="database_type">
                      <option value="1" selected>MySQL</option>
					</select>
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="32%" bgcolor="#FFCC00" align="center"><b><font size="2">Host</font></b></td>
                  <td height="22" width="78%" bgcolor="#DBD9C7"> 
                    <input type="text" name="database_host" value="<?php echo $database_host ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="32%" bgcolor="#FFCC00" align="center"><b><font size="2">Database Name</font></b></td>
                  <td height="22" width="78%" bgcolor="#DBD9C7"> 
                    <input type="text" name="database_name" value="<?php echo $database_name ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="32%" bgcolor="#FFCC00" align="center"><b><font size="2">Username</font></b></td>
                  <td height="22" width="78%" bgcolor="#DBD9C7"> 
                    <input type="text" name="database_username" value="<?php echo $database_username ?>">
                  </td>
                </tr>
                <tr> 
                  <td height="22" width="32%" bgcolor="#FFCC00" align="center"><b><font size="2">Password</font></b></td>
                  <td height="22" width="78%" bgcolor="#DBD9C7"> 
                    <input type="password" name="database_password" value="<?php echo $database_password ?>">
                  </td>
                </tr>
              </table>
              <p align="center">
                <input type="submit" name="Submit" value="Next &gt;&gt;">
              </p>
			  </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
