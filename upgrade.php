<?php
$dir_path = $argv[1];
$cur_dir = getcwd();
include("ClassFileManipulation.php");
if(!$dir_path){ 
	echo "please Provide old template system path while running this script .....\n";
}else{
	
	echo "old template system directory.....".$dir_path."\n";
	echo "current working directory.....".$cur_dir, "\n";
	$file_upgrade= new FileMan();
	$serv_file_path = $dir_path."/server.inc.php";
	$file_upgrade->setFile($serv_file_path);
	echo "server ini file path ....".$serv_file_path."\n";
	$line = $file_upgrade->searchInLine("DB_HOST");
    	if(is_array($line)){ 
		foreach ($line as $key => $value) {
			echo $value."\n";
			$pieces = explode("\"", $value);
			$database_host = $pieces[3];
			echo "db host ....".$database_host."\n";
		}
		
    	}
	$line = $file_upgrade->searchInLine("DB_USER");
        if(is_array($line)){
		foreach ($line as $key => $value) {
			$pieces = explode("\"", $value);
			$database_username = $pieces[3];
			echo "db user....".$database_username."\n";
		}
		
       }
       $line = $file_upgrade->searchInLine("DB_PASSWORD");
       if(is_array($line)){
	       foreach ($line as $key => $value) {
        	   	$pieces = explode("\"", $value);
			$database_password = $pieces[3];
        		echo "db password....".$database_password."\n";
		}
		
    	}
	$line = $file_upgrade->searchInLine("DB_DATABASE");
    	if(is_array($line)){
       		 foreach ($line as $key => $value) {
           	$pieces = explode("\"", $value);
			$database_name = $pieces[3];
        	echo "db name....".$database_name."\n";
		}
		
   	}
	$db_type="mysql";
    	$line = $file_upgrade->searchInLine("DB_TYPE");
    	if(is_array($line)){
       		 foreach ($line as $key => $value) {
           	$pieces = explode("\"", $value);
			$db_type = $pieces[3];
        	echo "db type....".$db_type."\n";
		}
		
   	}
	
	if($db_type=="mysql"){
		$output = shell_exec("mysqldump --add-drop-table -h $database_host -u $database_username -p$database_password $database_name > backups/$database_name.sql");
		echo $output;
		$output = shell_exec("mysqldump -h $database_host -u $database_username -p$database_password  $database_name web_config >  backups/web_config.sql");
		echo $output;
			
		$web_confipath = "backups/web_config.sql";
		if (!copy($web_confipath, 'web_config.sql.bkp')) {
			echo "failed to copy $file...\n";
		}
		$db_path = dirname ("backups/$database_name.sql");
		$output = shell_exec("tar -zcf $database_name.tgz -C $db_path $database_name.sql");
	        echo $output;
		$output = shell_exec("mv $database_name.tgz backups/$database_name.tgz ");
		echo $output;
		$output = shell_exec("rm -rf backups/$database_name.sql");
		echo $output;
		$server_config_path = $dir_path.'/server.inc.php';
		$server_ini_path = "backups/server.inc.php.old";
		if (!copy($server_config_path, $server_ini_path)) {
                       echo "failed to copy server.inc.php...\n";                                                 	    		    }
		if (!copy($server_ini_path,'server.inc.php' )) {
                       echo "failed to copy server.inc.php.old...\n"; 
		}
		$bkp= dirname ($dir_path);
		$fname = basename ($dir_path);
  //              echo $output;
		$output = shell_exec("tar -zcf template3_old_files.tgz -C $bkp $fname ");
                echo $output;
		$output = shell_exec("mv template_old_files.tgz backups/template_old_files.tgz ");
		echo $output;
		$new_files = $cur_dir."/*";
		$old_path = $dir_path."/";
		$output = shell_exec("cp -pr $new_files $old_path ");
		echo $output;
		$old_webconfig = $old_path."web_config.sql.bkp";
		$output = shell_exec("rm -rf $old_webconfig");
		echo $output;
		$file_upgrade= new FileMan();
		$file_upgrade->setFile("web_config.sql.bkp");
		$line = $file_upgrade->searchInLine("CREATE TABLE web_config");
		if(is_array($line)){
			foreach ($line as $key => $value) {
				$str_replace="CREATE TABLE IF NOT EXISTS web_config (";
				$file_upgrade->replaceLine($key,$str_replace);
			}
		}
		$file_upgrade2= new FileMan();
		$file_upgrade2->setFile("web_config.sql.bkp");
		$line1 = $file_upgrade2->searchInLine("INSERT INTO web_config VALUES");
		if(is_array($line1)){
			foreach ($line1 as $key => $value) {
				$str_replace1=str_replace("INSERT INTO web_config VALUES", "INSERT INTO web_config (current_skin,website_language,title,copyright,pagesize,system_status,order_id,customer_id,password,reg_host,reg_port,rela_dir,dom_upg_host,dom_upg_port,dom_upg_url,support_email) VALUES", $value);
				$file_upgrade2->replaceLine($key,$str_replace1);
			}
		}
		$output = shell_exec("mysql -h $database_host -u $database_username -p$database_password  $database_name <  upgrade.sql");
		echo "$output";
		$output = shell_exec("mysql -h $database_host -u $database_username -p$database_password  $database_name <  web_config.sql.bkp");
		echo "$output";
		echo "\nThe system has been upgraded ...The system settings can be changed through system settings link ....\nYou can access the system  at old location  with old login details\n";
								
	}
	else{
		echo "upgrade script is available only for mysql version.\n";
	}
}
?>
