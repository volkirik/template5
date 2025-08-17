DROP TABLE IF EXISTS web_config;
CREATE TABLE  web_config (
  current_skin varchar(50) default 'template_generic',
  website_language int(11) default '1',
  title varchar(200) default NULL,
  copyright varchar(200) default NULL,
  pagesize int(11) default NULL,
  system_status int(11) default NULL,
  order_id int(11) default NULL,
  customer_id int(11) default NULL,
  password varchar(33) default NULL,
  reg_host varchar(50) default '218.5.81.149',
  reg_port int(11) default '20001',
  rela_dir varchar(50) default NULL,
  dom_upg_host varchar(50) default 'www.onlinenic.com',
  dom_upg_port int(11) default '80',
  dom_upg_url varchar(50) default '/english/template3/',
  support_email varchar(100) default NULL,
  current_theme varchar(50) default 'default',
  domain_lock int(2) default '1',
  domain_renewal int(2) default '1'
);

CREATE TABLE dns (
  id mediumint(9) NOT NULL auto_increment,
  member_id int(11) default NULL,
  dns varchar(50) default NULL,
  ip varchar(16) default NULL,
  regtime datetime default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `domain_autorenew`
--

CREATE TABLE domain_autorenew (
  id mediumint(9) NOT NULL auto_increment,
  domain_id int(11) default NULL,
  renew_status varchar(10) default 'disabled',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `domain_lock`
--

CREATE TABLE domain_lock (
  id mediumint(9) NOT NULL auto_increment,
  domain_id int(11) default NULL,
  domain_name varchar(255) default NULL,
  status varchar(10) default 'unlocked',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `domains_list`
--

CREATE TABLE domains_list (
  id int(1) default '1',
  list text,
  total float(8,2) default NULL,
  status text,
  UNIQUE KEY id (id)
) TYPE=MyISAM;

--
-- Table structure for table `gateway_info`
--

CREATE TABLE gateway_info (
  id mediumint(9) NOT NULL auto_increment,
  pp_email varchar(128) default NULL,
  instId int(10) default NULL,
  callbackPW varchar(255) default NULL,
  wptestmode varchar(15) default 'enabled',
  pptestmode varchar(15) default 'enabled',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `mail_data`
--

CREATE TABLE mail_data (
  id mediumint(9) NOT NULL auto_increment,
  type varchar(15) default NULL,
  subject varchar(100) default NULL,
  body text,
  macros varchar(50) default NULL,
  day1 mediumint(3) default NULL,
  day2 mediumint(3) default NULL,
  day3 mediumint(3) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;
--
-- Dumping data for table `mail_data`
--

INSERT INTO mail_data VALUES (1,'register','Domain registration %domain%.','%domain% has been registered, Please check.','%domains%,%user%',0,0,0);
INSERT INTO mail_data VALUES (2,'renew','Domain renewal request.','The following domains should be renewed, Please check from your end.\r\n%domains%','',15,30,45);
INSERT INTO mail_data VALUES (3,'password','Password for %user%','Password for the user has been reset as\r\n%password%','%user%,%password%',0,0,0);
--
-- Table structure for table `mail_settings`
--

CREATE TABLE mail_settings (
  id mediumint(9) NOT NULL auto_increment,
  name varchar(30) default NULL,
  email varchar(30) default NULL,
  register_notify int(2) default NULL,
  renew_notify int(2) default NULL,
  reset_pass int(2) default NULL,
  mta varchar(30) default NULL,
  smtp_auth int(2) default NULL,
  server varchar(30) default NULL,
  user varchar(30) default NULL,
  pass varchar(32) default NULL,
  port int(5) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;
--
-- Table structure for table `payment_info`
--

CREATE TABLE payment_info (
  id mediumint(9) NOT NULL auto_increment,
  member_id int(11) NOT NULL default '0',
  type varchar(15) default NULL,
  pp_email varchar(128) default NULL,
  cc_name varchar(50) default NULL,
  cc_num smallint(16) default NULL,
  exp_date smallint(2) default NULL,
  exp_year smallint(4) default NULL,
  cc_user varchar(128) default NULL,
  cc_id smallint(4) default NULL,
  cc_email varchar(128) default NULL,
  cc_addr varchar(41) default NULL,
  cc_city varchar(30) default NULL,
  cc_state varchar(40) default NULL,
  cc_zip smallint(15) default NULL,
  cc_country varchar(50) default NULL,
  cc_tel varchar(25) default NULL,
  cc_fax varchar(25) default NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY member_id (member_id)
) TYPE=MyISAM;
--
-- Table structure for table `paypal_ipns`
--

CREATE TABLE paypal_ipns (
  id int(11) NOT NULL auto_increment,
  payment_date varchar(50) default NULL,
  txn_id varchar(50) default NULL,
  first_name varchar(50) default NULL,
  last_name varchar(50) default NULL,
  payer_email varchar(75) default NULL,
  payer_status varchar(50) default NULL,
  payment_type varchar(50) default NULL,
  item_name varchar(127) default NULL,
  quantity int(11) NOT NULL default '0',
  mc_gross decimal(9,2) default NULL,
  mc_currency char(3) default NULL,
  address_name varchar(255) NOT NULL default '',
  address_street varchar(255) NOT NULL default '',
  address_city varchar(255) NOT NULL default '',
  address_state varchar(255) NOT NULL default '',
  address_zip varchar(255) NOT NULL default '',
  address_country varchar(255) NOT NULL default '',
  address_status varchar(255) NOT NULL default '',
  payment_status varchar(255) NOT NULL default '',
  pending_reason varchar(255) NOT NULL default '',
  reason_code varchar(255) NOT NULL default '',
  txn_type varchar(255) NOT NULL default '',
  PRIMARY KEY  (id),
  UNIQUE KEY txn_id (txn_id)
) TYPE=MyISAM COMMENT='Paypal IPNs received from paypal';
--
-- Table structure for table `worldpay_info`
--

CREATE TABLE worldpay_info (
  instId int(10) default NULL,
  callbackPW varchar(255) default NULL
) TYPE=MyISAM;
