<?php
global $admin_info, $smarty;

	$smarty->assign ('content_title', 'Alanadı Ayarları &gt; Alanadı Fiyatlandırması');
    $smarty->assign ('php_self',  $_SERVER["PHP_SELF"] );
    $smarty->assign ('message', $message);
	$smarty->assign ('product_id', $product_id);
	$smarty->assign ('product_name', $product_name);
	$smarty->assign ('product_type', $product_type);

		$var = "";
for($i = 1; $i < 11; $i ++)
{
	$var .= "<tr>\n";
	$var .= "<td width=\"16%\" height=\"20\">" . $i . " years</td>\n";
	for($j = 0; $j < 5; $j ++)
	{
		$var .= "<td height=\"20\" width=\"16%\">";
		if($i == 1)
		{
			$var .= "<input type=\"text\" name=\"reg_prices" . $i . $j . "\" value=\"" . $reg_prices[$i][$j] . "\" size=\"8\" onChange=\"changePrice(this.form, 1, " . $j . ")\">";
		}else {
			$var .= "<input type=\"text\" name=\"reg_prices" . $i . $j . "\" value=\"" . $reg_prices[$i][$j] . "\" size=\"8\">";
		}
		$var .= "</td>\n";
	}
	$var .= "</tr>\n";
}
 $smarty->assign ('reg_prices', $var);

	 $var2 = "";
	$var2 .= "<td width=\"16%\" height=\"20\">&nbsp;</td>\n";
	for($j = 0; $j < 5; $j ++)
	{
		$var2 .=  "<td height=\"20\" width=\"16%\">";
		$var2 .=  "<input type=\"text\" name=\"del_prices" . $j . "\" value=\"" . $del_prices[$j] . "\" size=\"8\">";
		$var2 .=  "</td>\n";
	}
	 $smarty->assign ('del_prices', $var2);

		  $var3 = "";
for($i = 1; $i < 11; $i ++)
{
	$var3 .= "<tr>\n";
	$var3 .= "<td width=\"16%\" height=\"20\">" . $i . " years</td>\n";
	for($j = 0; $j < 5; $j ++)
	{
		$var3 .= "<td height=\"20\" width=\"16%\">";
		if($i == 1)
		{
			$var3 .= "<input type=\"text\" name=\"rew_prices" . $i . $j . "\" value=\"" . $rew_prices[$i][$j] . "\" size=\"8\" onChange=\"changePrice(this.form, 2, " . $j . ")\">";
		}else {
			$var3 .= "<input type=\"text\" name=\"rew_prices" . $i . $j . "\" value=\"" . $rew_prices[$i][$j] . "\" size=\"8\">";
		}
		//echo "<input type=\"text\" name=\"rew_prices" . $i . $j . "\" value=\"" . $rew_prices[$i][$j] . "\" size=\"8\">";
		$var3 .= "</td>\n";
	}
	$var3 .= "</tr>\n";
}
 $smarty->assign ('new_prices', $var3);
 
 
 	$var4 = "";
	$var4 .= "<td  height=\"20\">&nbsp;</td>\n";

    for($j = 0; $j < 5; $j ++){
		$var4 .=  "<td height=\"20\" align=\"center\">";
		$var4 .=  "<input type=\"text\" name=\"sync_prices" . $j . "\" value=\"" . $sync_prices[$j] . "\" size=\"8\">";
		$var4 .=  "</td>\n";
	}
	$smarty->assign ('sync_prices', $var4);
 
    
 	$smarty->assign ('content_header', CURRENT_THEME.'/content.header.tpl');
	$smarty->assign ('content_body', CURRENT_THEME.'/admin.productsetting.modifyprice.tpl');
?>

