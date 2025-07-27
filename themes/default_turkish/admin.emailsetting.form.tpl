<script language="javascript" type="text/javascript">
// Bu fonksiyon bir katmanı göstermek veya gizlemek için kullanılır.
	
	function show_smtp(index) 
	{$smarty.ldelim} 
	    var selected_values = document.notification.mta.options[index].value;
	    if (selected_values == 'smtp'){$smarty.ldelim}
		    document.getElementById('test').style.display='';
		{$smarty.rdelim}else{ $smarty.ldelim}
		    document.getElementById('test').style.display='none';
       {$smarty.rdelim }
	{$smarty.rdelim}
</script>

<form action="" method="POST" name="notification">
<table align=center width="100%" >
    <tr>
		<td align=center>
			<table class=border1 bgcolor=white cellpadding=4 cellspacing=1 width=100%>
			  <tr>
					<td align=right bgcolor=#E1ECFB>
						"From" Adı: <font color=red>* </font>
						<input class="formStyle" type=text name="from_name" value="{$from_name}" size="25" >&nbsp;
					</td>
					
					<td bgcolor=#E1ECFB align=left>
						<input type=checkbox name=reg_domain value=reg_domain {$register_status}> 
							Domain kayıt e-postası gönderir <br>&nbsp; &nbsp;
							<a href="{$RELA_DIR}admin/emailsetting.php?show=register">[özelleştir]</a>
					</td>
			  </tr>
			  <tr>
					<td align=right bgcolor=#E1ECFB>
						"From" Adresi: <font color=red>* </font>
						<input class="formStyle" type=text name="from_email" value="{$from_email}" size="25">&nbsp;
					</td>
					
					<td bgcolor=#E1ECFB align=left>
						<input type=checkbox name=renew_domain value=renew_domain {$renew_status}> 
							Domain yenileme e-postası gönderir <br>&nbsp; &nbsp;
							<a href="{$RELA_DIR}admin/emailsetting.php?show=renew">[özelleştir]</a>
					</td>
			  </tr>
              <tr>
					<td align=right bgcolor=#E1ECFB>
						Mail Transfer Agent &nbsp; &nbsp; &nbsp;
						<select name="mta" onChange="show_smtp(this.selectedIndex)">
							<option value="smtp" {$smtp_status}>SMTP</option>
							<option value="sendmail" {$sendmail_status}>Sendmail</option>
						</select>&nbsp;
					</td>
					
					<td bgcolor=#E1ECFB align=left>
						<input type=checkbox name=reset_pass value=reset_pass {$password_status}> 
							Şifre kurtarma e-postası gönderir <br>&nbsp; &nbsp;
							<a href="{$RELA_DIR}admin/emailsetting.php?show=password">[özelleştir]</a>
					</td>
			  </tr>  
		      <tr>
				<td colspan="3" cellpadding=0 cellspacing=1>
					<div id=test style="display:{$display}; left:5px; top:250px; z-index:1" >
					<table width="100%" cellpadding=4 cellspacing=1 >
						<tr><td colspan="3"><hr  size="1"> </td></tr><tr> <td></td></tr>
						<tr>
							<td align=right bgcolor=#E1ECFB>
								SMTP sunucusu: <font color=red>* </font>&nbsp;
								<input class="formStyle" type=text name=smtp_server value="{$smtp_server}" size="25">&nbsp;
							</td>
							
							<td bgcolor=#E1ECFB>
								SMTP portu: <font color=red>* </font>&nbsp;
								<input class="formStyle" type=text name=smtp_port value="{$smtp_port}" style="width: 30px;">
							</td> 
						</tr>
						<tr>
							<td align=right bgcolor=#E1ECFB> SMTP Kimlik Doğrulaması Kullan &nbsp; &nbsp;  &nbsp; &nbsp;
								<input type=checkbox value=smtp_auth name=smtp_auth {$smtp_auth}>&nbsp;
							</td>
							<td bgcolor=#E1ECFB> &nbsp; </td>
						</tr>                
						<tr>
							<td align=right bgcolor=#E1ECFB>
								SMTP kullanıcı adı: <font color=red>* </font>&nbsp;
								<input class="formStyle" type=text name=smtp_user value="{$smtp_user}" size=25>&nbsp;
							</td>
							
							<td bgcolor=#E1ECFB>
								SMTP şifresi: &nbsp;
								<input class="formStyle" type=password name=smtp_pass size="25">    
							</td>
						</tr>
					</table>
					</div>
				</td>
			  </tr>
			 
			</table>
		</td>
	</tr>
	
	<tr>
		<td align="right" colspan=2 style="font-size: 11px;"> <font color=red>*</font> zorunlu alanı belirtir </td>
	</tr>
	<tr>
		<td colspan=3 align=center>
			<input type="submit" name="Submit" value="Kaydet">
			<input type="hidden" name="action" value="saveSettings">
			<input type="button" value="İptal"  onClick="history.back()">
		</td>
    </tr>
    </tr>
</table>
	</form>

