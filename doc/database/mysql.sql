/*==============================================================*/
/* Database name:  templates		                        */
/* DBMS name:      Mysql		                        */
/* Created on:     2002-6-12 10:25:27                           */
/*==============================================================*/;
drop table if exists members;
drop table if exists country;
drop table if exists sessions;
drop table if exists orders;
drop table if exists products;
drop table if exists ordermode;
drop table if exists member_price;
drop table if exists admins;
drop table if exists tasks;
drop table if exists admintask;
drop table if exists default_dns;
drop table if exists web_config;
drop table if exists domains;
drop table if exists contacts;
drop table if exists dns;
drop table if exists domain_autorenew;
drop table if exists domain_lock;
drop table if exists domains_list;
drop table if exists gateway_info;
drop table if exists mail_data;
drop table if exists payment_info;
drop table if exists paypal_ipns;
drop table if exists pp_test;
drop table if exists worldpay_info;
drop table if exists worldpay_trans;

/*==============================================================*/
/* Table: members                                             */
/*==============================================================*/
CREATE TABLE if not exists members (
	member_id int(11) NOT NULL auto_increment,
	member_name varchar(50) NOT NULL default '',
	member_password varchar(50) NOT NULL default '',
	flag int(11) NOT NULL default '0',
	member_level int(11) NOT NULL default '0',
	reg_time datetime NOT NULL default '0000-00-00 00:00:00',
	account float(8,2) NOT NULL default '0.00',
	message varchar(254) NOT NULL default '',
	r_name varchar(100) default NULL,
	r_org varchar(100) default NULL,
	r_address1 varchar(100) default NULL,
	r_address2 varchar(100) default NULL,
	r_address3 varchar(100) default NULL,
	r_city varchar(100) default NULL,
	r_province varchar(100) default NULL,
	r_country varchar(100) default NULL,
	r_postalcode varchar(20) default NULL,
	r_telephone varchar(50) default NULL,
	r_telephone_ext varchar(10) default NULL,
	r_fax varchar(50) default NULL,
	r_fax_ext varchar(10) default NULL,
	r_email varchar(100) default NULL,
	PRIMARY KEY  (member_id,member_name)
);

/*==============================================================*/
/* Table: country                                               */
/*==============================================================*/

create table if not exists country (
	country_name		varchar(50)		not null,
	country_code		varchar(3)		not null
);

/*==============================================================*/
/* Table: sessions                                              */
/*==============================================================*/
create table if not exists sessions (
	session_id		int		not null AUTO_INCREMENT,
	login_type		int		not null,
	member_id		int		not null,
	remote_addr		varchar(20)	not null,
	last_access_time	datetime	not null,
	primary key (session_id)
);

/*==============================================================*/
/* Table: orders                                                */
/*==============================================================*/
create table if not exists orders (
	order_id		int		not null AUTO_INCREMENT,
	member_id		int		not null,
	order_date		datetime	not null,
	order_type		int		not null,
	mode_id			int		not null,
	order_amount		float(8, 2)	not null,
	amount			float(8, 2)	not null,
	admin_id		int		not null,
	note			varchar(254),
	primary key(order_id)
);

/*==============================================================*/
/* Table: products                                              */
/*==============================================================*/
create table if not exists  products (
	id			int		not null AUTO_INCREMENT,
	product_id		int		not null,
	domain_type		int		not null,
	product_name		varchar(50)	not null,
	product_type		int		not null,
	flag			int		not null,
	primary key (id)
);

/*==============================================================*/
/* Table: ordermode                                             */
/*==============================================================*/
create table if not exists ordermode (
	ordermode_id		int		not null AUTO_INCREMENT,
	mode_id			int		not null,
	mode_lan		int		not null,
	mode_name		varchar(254)	not null,
	product_id		int		not null,
	mode_type		int		not null,
	primary key (ordermode_id)
);

/*==============================================================*/
/* Table: member_price                                          */
/*==============================================================*/
create table if not exists member_price (
	member_price_id		int		not null AUTO_INCREMENT,
	product_id		int		not null,
	member_level		int		not null,
	type			int		not null,
	i_year			int		not null,
	price			float(8, 2)	not null,
	add_time		datetime	not null,
	mod_time		datetime,
	primary key (member_price_id)
);

/*==============================================================*/
/* Table: admins	                                        */
/*==============================================================*/
create table if not exists admins (
	admin_id		int		not null AUTO_INCREMENT,
	name			varchar(50)	not null,
	dept			varchar(50)	not null,
	password		varchar(20)	not null,
	add_time		datetime	not null,
	flag			int		not null,
	primary key (admin_id)
);

/*==============================================================*/
/* Table: tasks							*/
/*==============================================================*/
create table if not exists tasks (
	task_id			int		not null AUTO_INCREMENT,
	task_name		varchar(20)	not null,
	primary key (task_id)
);

/*==============================================================*/
/* Table: admintask						*/
/*==============================================================*/
create table if not exists admintask (
	admintask_id		int		not null AUTO_INCREMENT,
	admin_id		int		not null,
	task_id			int		not null,
	primary key (admintask_id)
);

/*==============================================================*/
/* Table: default_dns						*/
/*==============================================================*/
create table if not exists default_dns (
	default_dns_id		int		not null AUTO_INCREMENT,
	product_id		int		not null,
	dns_name		varchar(100)	not null,
	primary key (default_dns_id)
);

/*==============================================================*/
/* Table: pp_test						*/
/*==============================================================*/

CREATE TABLE pp_test (
  time text
);


/*==============================================================*/
/* Table: web_config						*/
/*==============================================================*/
CREATE TABLE if not exists web_config (
 current_skin varchar(50) default 'template_english',
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
  domain_renewal int(2) default '1',
  captcha_enable int(2) default '1'
);
/*==============================================================*/
/* Table: domains                                               */
/*==============================================================*/
create table if not exists domains (
	domain_id		int		not null AUTO_INCREMENT,
	member_id		int		not null,
	domain_name		varchar(254)	not null,
	domain_type		int		not null,
	product_type		int		not null,
	domain_password		varchar(50)	not null,
	add_date		datetime	not null,
	domain_year		int		not null,
	domain_dns1		varchar(100)	not null,
	domain_dns2		varchar(100)	not null,
	registrant		int		not null,
	admin			int		not null,
	tech			int		not null,
	billing			int		not null,
	state			int		not null,
	amount			float(8, 2)	not null,
	primary key (domain_id)
);

/*==============================================================*/
/* Table: contacts                                             */
/*==============================================================*/
create table if not exists contacts (
	contact_id		int		not null AUTO_INCREMENT,
	password		varchar(50),
	reg_name		varchar(100),
	org			varchar(100),
	address1		varchar(100),
	address2		varchar(100),
	address3		varchar(100),
	city			varchar(100),
	province		varchar(100),
	country			varchar(50),
	postalcode		varchar(20),
	telephone		varchar(20),
	fax			varchar(20),
	email			varchar(100),
	primary key (contact_id)
);
/*==============================================================*/
/* Table structure for table `dns`                              */              	     
/*==============================================================*/

CREATE TABLE if not exists dns (
  id mediumint(9) NOT NULL auto_increment,
  member_id int(11) default NULL,
  dns varchar(50) default NULL,
  ip varchar(16) default NULL,
  regtime datetime default NULL,
  PRIMARY KEY  (id)
);
/*==============================================================*/
/* Table structure for table `domain_autorenew`                 */              	     
/*==============================================================*/
CREATE TABLE if not exists domain_autorenew (
  id mediumint(9) NOT NULL auto_increment,
  domain_id int(11) default NULL,
  renew_status varchar(10) default 'disabled',
  PRIMARY KEY  (id)
);
/*==============================================================*/
/* Table structure for table `domain_lock`                      */              	     
/*==============================================================*/
CREATE TABLE if not exists domain_lock (
  id mediumint(9) NOT NULL auto_increment,
  domain_id int(11) default NULL,
  domain_name varchar(255) default NULL,
  status varchar(10) default 'unlocked',
  PRIMARY KEY  (id)
);
/*==============================================================*/
/* Table structure for table `domains_list`                     */              	     
/*==============================================================*/
CREATE TABLE if not exists domains_list (
  id int(1) default '1',
  list text,
  total float(8,2) default NULL,
  status text,
  UNIQUE KEY id (id)
);
/*==============================================================*/
/* Table structure for table `gateway_info`                     */              	     
/*==============================================================*/
CREATE TABLE if not exists gateway_info (
  id mediumint(9) NOT NULL auto_increment,
  pp_email varchar(128) default NULL,
  instId int(10) default NULL,
  callbackPW varchar(255) default NULL,
  wptestmode varchar(15) default 'enabled',
  pptestmode varchar(15) default 'enabled',
  PRIMARY KEY  (id)
);
/*==============================================================*/
/* Table structure for table `mail_data`                              */              	     
/*==============================================================*/
CREATE TABLE if not exists mail_data (
  id mediumint(9) NOT NULL auto_increment,
  type varchar(15) default NULL,
  subject varchar(100) default NULL,
  body text,
  macros varchar(50) default NULL,
  day1 mediumint(3) default NULL,
  day2 mediumint(3) default NULL,
  day3 mediumint(3) default NULL,
  PRIMARY KEY  (id)
);
/*==============================================================*/
/* Table structure for table `mail_settings`                    */              	     
/*==============================================================*/
CREATE TABLE if not exists mail_settings (
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
) ;
/*==============================================================*/
/* Table structure for table `payment_info`                     */              	     
/*==============================================================*/
CREATE TABLE if not exists payment_info (
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
);
/*==============================================================*/
/* Table structure for table `paypal_ipns`                              */              	     
/*==============================================================*/

CREATE TABLE if not exists paypal_ipns (
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
);
/*==============================================================*/
/* Table structure for table `worldpay_info`                   */              	     
/*==============================================================*/
CREATE TABLE if not exists worldpay_info (
  instId int(10) default NULL,
  callbackPW varchar(255) default NULL
);
/*==============================================================*/
/* Table structure for table `worldpay_trans`                              */              	     
/*==============================================================*/

CREATE TABLE if not exists worldpay_trans (
  id mediumint(9) NOT NULL auto_increment,
  payment_date varchar(50) default NULL,
  amount decimal(9,2) default NULL,
  currency char(3) default NULL,
  item_name varchar(255) default NULL,
  name varchar(50) default NULL,
  address varchar(255) default NULL,
  country varchar(255) default NULL,
  zip varchar(255) default NULL,
  email varchar(75) default NULL,
  fax varchar(25) default NULL,
  tel varchar(25) default NULL,
  transId int(15) default NULL,
  PRIMARY KEY  (id)
);

insert into country(country_name, country_code) values ("AFGHANISTAN", "AF");
insert into country(country_name, country_code) values ("ALBANIA", "AL");
insert into country(country_name, country_code) values ("BOTSWANA", "BW");
insert into country(country_name, country_code) values ("ALGERIA", "DZ");
insert into country(country_name, country_code) values ("AMERICAN SAMOA", "AS");
insert into country(country_name, country_code) values ("ANDORRA", "AD");
insert into country(country_name, country_code) values ("ANGOLA", "AO");
insert into country(country_name, country_code) values ("ANGUILLA", "AI");
insert into country(country_name, country_code) values ("ANTARCTICA", "AQ");
insert into country(country_name, country_code) values ("ANTIGUA AND BARBUDA", "AG");
insert into country(country_name, country_code) values ("ARGENTINA", "AR");
insert into country(country_name, country_code) values ("ARMENIA", "AM");
insert into country(country_name, country_code) values ("ARUBA", "AW");
insert into country(country_name, country_code) values ("AUSTRALIA", "AU");
insert into country(country_name, country_code) values ("AUSTRI", "AT");
insert into country(country_name, country_code) values ("AZERBAIJAN", "AZ");
insert into country(country_name, country_code) values ("BAHAMAS", "BS");
insert into country(country_name, country_code) values ("BAHRAIN", "BH");
insert into country(country_name, country_code) values ("BANGLADESH", "BD");
insert into country(country_name, country_code) values ("BARBADOS", "BB");
insert into country(country_name, country_code) values ("BELARUS", "BY");
insert into country(country_name, country_code) values ("BELGIUM", "BE");
insert into country(country_name, country_code) values ("BELIZE", "BZ");
insert into country(country_name, country_code) values ("BENIN", "BJ");
insert into country(country_name, country_code) values ("BERMUDA", "BM");
insert into country(country_name, country_code) values ("BHUTAN", "BT");
insert into country(country_name, country_code) values ("BOLIVIA", "BO");
insert into country(country_name, country_code) values ("BOSNIA AND HERZEGOVINA", "BA");
insert into country(country_name, country_code) values ("BOUVET ISLAND", "BV");
insert into country(country_name, country_code) values ("BRAZIL", "BR");
insert into country(country_name, country_code) values ("BRITISH INDIAN OCEAN TERRITORY", "IO");
insert into country(country_name, country_code) values ("BRUNEI DARUSSALAM", "BN");
insert into country(country_name, country_code) values ("BULGARIA", "BG");
insert into country(country_name, country_code) values ("BURKINA FASO", "BF");
insert into country(country_name, country_code) values ("BURUNDI", "BI");
insert into country(country_name, country_code) values ("CAMBODIA", "KH");
insert into country(country_name, country_code) values ("CAMEROON", "CM");
insert into country(country_name, country_code) values ("CANADA", "CA");
insert into country(country_name, country_code) values ("CAPE VERDE", "CV");
insert into country(country_name, country_code) values ("CAYMAN ISLANDS", "KY");
insert into country(country_name, country_code) values ("CENTRAL AFRICAN REPUBLIC", "CF");
insert into country(country_name, country_code) values ("CHAD", "TD");
insert into country(country_name, country_code) values ("CHILE", "CL");
insert into country(country_name, country_code) values ("CHINA", "CN");
insert into country(country_name, country_code) values ("CHRISTMAS ISLAND", "CX");
insert into country(country_name, country_code) values ("COCOS (KEELING) ISLANDS", "CC");
insert into country(country_name, country_code) values ("COLOMBIA", "CO");
insert into country(country_name, country_code) values ("COMOROS", "KM");
insert into country(country_name, country_code) values ("CONGO", "CG");
insert into country(country_name, country_code) values ("CONGO, THE DEMOCRATIC REPUBLIC OF THE", "CD");
insert into country(country_name, country_code) values ("COOK ISLANDS", "CK");
insert into country(country_name, country_code) values ("COSTA RICA", "CR");
insert into country(country_name, country_code) values ("C?TE D' IVOIRE", "CI");
insert into country(country_name, country_code) values ("CROATIA", "HR");
insert into country(country_name, country_code) values ("CUBA", "CU");
insert into country(country_name, country_code) values ("CYPRUS", "CY");
insert into country(country_name, country_code) values ("CZECH REPUBLIC", "CZ");
insert into country(country_name, country_code) values ("DENMARK", "DK");
insert into country(country_name, country_code) values ("DJIBOUTI", "DJ");
insert into country(country_name, country_code) values ("DOMINICA", "DM");
insert into country(country_name, country_code) values ("DOMINICAN REPUBLIC", "DO");
insert into country(country_name, country_code) values ("EAST TIMOR", "TP");
insert into country(country_name, country_code) values ("ECUADOR", "EC");
insert into country(country_name, country_code) values ("EGYPT", "EG");
insert into country(country_name, country_code) values ("EL SALVADOR", "SV");
insert into country(country_name, country_code) values ("EQUATORIAL GUINEA", "GQ");
insert into country(country_name, country_code) values ("ERITREA", "ER");
insert into country(country_name, country_code) values ("ESTONIA", "EE");
insert into country(country_name, country_code) values ("ETHIOPIA", "ET");
insert into country(country_name, country_code) values ("FALKLAND ISLANDS (MALVINAS)", "FK");
insert into country(country_name, country_code) values ("FAROE ISLANDS", "FO");
insert into country(country_name, country_code) values ("FIJI", "FJ");
insert into country(country_name, country_code) values ("FINLAND", "FI");
insert into country(country_name, country_code) values ("FRANCE", "FR");
insert into country(country_name, country_code) values ("FRENCH GUIANA", "GF");
insert into country(country_name, country_code) values ("FRENCH POLYNESIA", "PF");
insert into country(country_name, country_code) values ("FRENCH SOUTHERN TERRITORIES", "TF");
insert into country(country_name, country_code) values ("GABON", "GA");
insert into country(country_name, country_code) values ("GAMBIA", "GM");
insert into country(country_name, country_code) values ("GEORGIA", "GE");
insert into country(country_name, country_code) values ("GERMANY", "DE");
insert into country(country_name, country_code) values ("GHANA", "GH");
insert into country(country_name, country_code) values ("GIBRALTAR", "GI");
insert into country(country_name, country_code) values ("GREECE", "GR");
insert into country(country_name, country_code) values ("GREENLAND", "GL");
insert into country(country_name, country_code) values ("GRENADA", "GD");
insert into country(country_name, country_code) values ("GUADELOUPE", "GP");
insert into country(country_name, country_code) values ("GUAM", "GU");
insert into country(country_name, country_code) values ("GUATEMALA", "GT");
insert into country(country_name, country_code) values ("GUINEA", "GN");
insert into country(country_name, country_code) values ("GUINEA-BISSAU", "GW");
insert into country(country_name, country_code) values ("GUYANA", "GY");
insert into country(country_name, country_code) values ("HAITI", "HT");
insert into country(country_name, country_code) values ("HEARD ISLAND AND MCDONALD ISLANDS", "HM");
insert into country(country_name, country_code) values ("HOLY SEE (VATICAN CITY STATE)", "VA");
insert into country(country_name, country_code) values ("HONDURAS", "HN");
insert into country(country_name, country_code) values ("HONG KONG", "HK");
insert into country(country_name, country_code) values ("HUNGARY", "HU");
insert into country(country_name, country_code) values ("ICELAND", "IS");
insert into country(country_name, country_code) values ("INDIA", "IN");
insert into country(country_name, country_code) values ("INDONESIA", "ID");
insert into country(country_name, country_code) values ("IRAN, ISLAMIC REPUBLIC OF", "IR");
insert into country(country_name, country_code) values ("IRAQ", "IQ");
insert into country(country_name, country_code) values ("IRELAND", "IE");
insert into country(country_name, country_code) values ("ISRAEL", "IL");
insert into country(country_name, country_code) values ("ITALY", "IT");
insert into country(country_name, country_code) values ("JAMAICA", "JM");
insert into country(country_name, country_code) values ("JAPAN", "JP");
insert into country(country_name, country_code) values ("JORDAN", "JO");
insert into country(country_name, country_code) values ("KAZAKSTAN", "KZ");
insert into country(country_name, country_code) values ("KENYA", "KE");
insert into country(country_name, country_code) values ("KIRIBATI", "KI");
insert into country(country_name, country_code) values ("KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF", "KP");
insert into country(country_name, country_code) values ("KOREA, REPUBLIC OF", "KR");
insert into country(country_name, country_code) values ("KUWAIT", "KW");
insert into country(country_name, country_code) values ("KYRGYZSTAN", "KG");
insert into country(country_name, country_code) values ("LAO PEOPLE'S DEMOCRATIC REPUBLIC", "LA");
insert into country(country_name, country_code) values ("LATVIA", "LV");
insert into country(country_name, country_code) values ("LEBANON", "LB");
insert into country(country_name, country_code) values ("LESOTHO", "LS");
insert into country(country_name, country_code) values ("LIBERIA", "LR");
insert into country(country_name, country_code) values ("LIBYAN ARAB JAMAHIRIYA", "LY");
insert into country(country_name, country_code) values ("LIECHTENSTEIN", "LI");
insert into country(country_name, country_code) values ("LITHUANIA", "LT");
insert into country(country_name, country_code) values ("LUXEMBOURG", "LU");
insert into country(country_name, country_code) values ("MACAU", "MO");
insert into country(country_name, country_code) values ("MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF", "MK");
insert into country(country_name, country_code) values ("MADAGASCAR", "MG");
insert into country(country_name, country_code) values ("MALAWI", "MW");
insert into country(country_name, country_code) values ("MALAYSIA", "MY");
insert into country(country_name, country_code) values ("MALDIVES", "MV");
insert into country(country_name, country_code) values ("MALI", "ML");
insert into country(country_name, country_code) values ("MALTA", "MT");
insert into country(country_name, country_code) values ("MARSHALL ISLANDS", "MH");
insert into country(country_name, country_code) values ("MARTINIQUE", "MQ");
insert into country(country_name, country_code) values ("MAURITANIA", "MR");
insert into country(country_name, country_code) values ("MAURITIUS", "MU");
insert into country(country_name, country_code) values ("MAYOTTE", "YT");
insert into country(country_name, country_code) values ("MEXICO", "MX");
insert into country(country_name, country_code) values ("MICRONESIA, FEDERATED STATES OF", "FM");
insert into country(country_name, country_code) values ("MOLDOVA, REPUBLIC OF", "MD");
insert into country(country_name, country_code) values ("MONACO", "MC");
insert into country(country_name, country_code) values ("MONGOLIA", "MN");
insert into country(country_name, country_code) values ("MONTSERRAT", "MS");
insert into country(country_name, country_code) values ("MOROCCO", "MA");
insert into country(country_name, country_code) values ("MOZAMBIQUE", "MZ");
insert into country(country_name, country_code) values ("MYANMAR", "MM");
insert into country(country_name, country_code) values ("NAMIBIA", "NA");
insert into country(country_name, country_code) values ("NAURU", "NR");
insert into country(country_name, country_code) values ("NEPAL", "NP");
insert into country(country_name, country_code) values ("NETHERLANDS", "NL");
insert into country(country_name, country_code) values ("NETHERLANDS ANTILLES", "AN");
insert into country(country_name, country_code) values ("NEW CALEDONIA", "NC");
insert into country(country_name, country_code) values ("NEW ZEALAND", "NZ");
insert into country(country_name, country_code) values ("NICARAGUA", "NI");
insert into country(country_name, country_code) values ("NIGER", "NE");
insert into country(country_name, country_code) values ("NIGERIA", "NG");
insert into country(country_name, country_code) values ("NIUE", "NU");
insert into country(country_name, country_code) values ("NORFOLK ISLAND", "NF");
insert into country(country_name, country_code) values ("NORTHERN MARIANA ISLANDS", "MP");
insert into country(country_name, country_code) values ("NORWAY", "NO");
insert into country(country_name, country_code) values ("OMAN", "OM");
insert into country(country_name, country_code) values ("PAKISTAN", "PK");
insert into country(country_name, country_code) values ("PALAU", "PW");
insert into country(country_name, country_code) values ("PALESTINIAN TERRITORY, OCCUPIED", "PS");
insert into country(country_name, country_code) values ("PANAMA", "PA");
insert into country(country_name, country_code) values ("PAPUA NEW GUINEA", "PG");
insert into country(country_name, country_code) values ("PARAGUAY", "PY");
insert into country(country_name, country_code) values ("PERU", "PE");
insert into country(country_name, country_code) values ("PHILIPPINES", "PH");
insert into country(country_name, country_code) values ("PITCAIRN", "PN");
insert into country(country_name, country_code) values ("POLAND", "PL");
insert into country(country_name, country_code) values ("PORTUGAL", "PT");
insert into country(country_name, country_code) values ("PUERTO RICO", "PR");
insert into country(country_name, country_code) values ("QATAR", "QA");
insert into country(country_name, country_code) values ("RUNION", "RE");
insert into country(country_name, country_code) values ("ROMANIA", "RO");
insert into country(country_name, country_code) values ("RUSSIAN FEDERATION", "RU");
insert into country(country_name, country_code) values ("RWANDA", "RW");
insert into country(country_name, country_code) values ("SAINT HELENA", "SH");
insert into country(country_name, country_code) values ("SAINT KITTS AND NEVIS", "KN");
insert into country(country_name, country_code) values ("SAINT LUCIA", "LC");
insert into country(country_name, country_code) values ("SAINT PIERRE AND MIQUELON", "PM");
insert into country(country_name, country_code) values ("SAINT VINCENT AND THE GRENADINES", "VC");
insert into country(country_name, country_code) values ("SAMOA", "WS");
insert into country(country_name, country_code) values ("SAN MARINO", "SM");
insert into country(country_name, country_code) values ("SAO TOME AND PRINCIPE", "ST");
insert into country(country_name, country_code) values ("SAUDI ARABIA", "SA");
insert into country(country_name, country_code) values ("SENEGAL", "SN");
insert into country(country_name, country_code) values ("SEYCHELLES", "SC");
insert into country(country_name, country_code) values ("SIERRA LEONE", "SL");
insert into country(country_name, country_code) values ("SINGAPORE", "SG");
insert into country(country_name, country_code) values ("SLOVAKIA", "SK");
insert into country(country_name, country_code) values ("SLOVENIA", "SI");
insert into country(country_name, country_code) values ("SOLOMON ISLANDS", "SB");
insert into country(country_name, country_code) values ("SOMALIA", "SO");
insert into country(country_name, country_code) values ("SOUTH AFRICA", "ZA");
insert into country(country_name, country_code) values ("SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS", "GS");
insert into country(country_name, country_code) values ("SPAIN", "ES");
insert into country(country_name, country_code) values ("SRI LANKA", "LK");
insert into country(country_name, country_code) values ("SUDAN", "SD");
insert into country(country_name, country_code) values ("SURINAME", "SR");
insert into country(country_name, country_code) values ("SVALBARD AND JAN MAYEN", "SJ");
insert into country(country_name, country_code) values ("SWAZILAND", "SZ");
insert into country(country_name, country_code) values ("SWEDEN", "SE");
insert into country(country_name, country_code) values ("SWITZERLAND", "CH");
insert into country(country_name, country_code) values ("SYRIAN ARAB REPUBLIC", "SY");
insert into country(country_name, country_code) values ("CHINAESE TAIBEI", "TW");
insert into country(country_name, country_code) values ("TAJIKISTAN", "TJ");
insert into country(country_name, country_code) values ("TANZANIA, UNITED REPUBLIC OF", "TZ");
insert into country(country_name, country_code) values ("THAILAND", "TH");
insert into country(country_name, country_code) values ("TOGO", "TG");
insert into country(country_name, country_code) values ("TOKELAU", "TK");
insert into country(country_name, country_code) values ("TONGA", "TO");
insert into country(country_name, country_code) values ("TRINIDAD AND TOBAGO", "TT");
insert into country(country_name, country_code) values ("TUNISIA", "TN");
insert into country(country_name, country_code) values ("TURKEY", "TR");
insert into country(country_name, country_code) values ("TURKMENISTAN", "TM");
insert into country(country_name, country_code) values ("TURKS AND CAICOS ISLANDS", "TC");
insert into country(country_name, country_code) values ("TUVALU", "TV");
insert into country(country_name, country_code) values ("UGANDA", "UG");
insert into country(country_name, country_code) values ("UKRAINE", "UA");
insert into country(country_name, country_code) values ("UNITED ARAB EMIRATES", "AE");
insert into country(country_name, country_code) values ("UNITED KINGDOM", "GB");
insert into country(country_name, country_code) values ("UNITED STATES", "US");
insert into country(country_name, country_code) values ("UNITED STATES MINOR OUTLYING ISLANDS", "UM");
insert into country(country_name, country_code) values ("URUGUAY", "UY");
insert into country(country_name, country_code) values ("UZBEKISTAN", "UZ");
insert into country(country_name, country_code) values ("VANUATU", "VU");
insert into country(country_name, country_code) values ("VENEZUELA", "VE");
insert into country(country_name, country_code) values ("VIET NAM", "VN");
insert into country(country_name, country_code) values ("VIRGIN ISLANDS, BRITISH", "VG");
insert into country(country_name, country_code) values ("VIRGIN ISLANDS, U.S.", "VI");
insert into country(country_name, country_code) values ("WALLIS AND FUTUNA", "WF");
insert into country(country_name, country_code) values ("WESTERN SAHARA", "EH");
insert into country(country_name, country_code) values ("YEMEN", "YE");
insert into country(country_name, country_code) values ("YUGOSLAVIA", "YU");
insert into country(country_name, country_code) values ("ZAMBIA", "ZM");
insert into country(country_name, country_code) values ("ZIMBABWE", "ZW");

INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (1000,0,'.com',1,0);
INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (2000,0,'.net',1,0);
INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (3000,0,'.org',1,0);
INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (4000,800,'.biz',1,0);
INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (5000,805,'.info',1,0);
INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (6000,806,'.us',1,0);
INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (7000,808,'.in',1,0);
INSERT INTO products (product_id, domain_type, product_name, product_type, flag) VALUES (8000,220,'.cn',1,0);

INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1,1,'Funds added',0,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1,2,'��ʽ',0,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2,1,'Funds subtracted',0,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2,2,'ۿ�',0,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1001,1,'.com registration fee',1000,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1001,2,'.com��ע�',1000,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1002,1,'.com deletion fee',1000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1002,2,'.com��ɾ�',1000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1003,1,'.com renewal fee',1000,3);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1003,2,'.com���ѷ��',1000,3);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1004,1,'refund fee for .com deletion',1000,4);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (1004,2,'.com��ɾ��',1000,4);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2001,1,'.net registration fee',2000,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2001,2,'.net��ע�',2000,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2002,1,'.net deletion fee',2000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2002,2,'.net��ɾ�',2000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2003,1,'.net renewal fee',2000,3);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2003,2,'.net���ѷ��',2000,3);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2004,1,'refund fee for .net deletion',2000,4);													      
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (2004,2,'.net��ɾ��',2000,4);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3001,1,'.org registration fee',3000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3001,2,'.org��ע�',3000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3002,1,'.org deletion fee',3000,2);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3002,2,'.org��ɾ�',3000,2);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3003,1,'.org renewal fee',3000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3003,2,'.org���ѷ��',3000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3004,1,'refund fee for .org deletion',3000,4);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (3004,2,'.org��ɾ��',3000,4);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4001,1,'.biz registration fee',4000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4001,2,'.biz��ע�',4000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4002,1,'.biz deletion fee',4000,2);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4002,2,'.biz��ɾ�',4000,2);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4003,1,'.biz renewal fee',4000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4003,2,'.biz���ѷ��',4000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4004,1,'refund fee for .biz deletion',4000,4);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (4004,2,'.biz��ɾ��',4000,4);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (5001,1,'.info registration fee',5000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (5001,2,'.info��ע�',5000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (5002,1,'.info deletion fee',5000,2);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (5002,2,'.info��ɾ�',5000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type)  VALUES (5003,1,'.info renewal fee',5000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (5003,2,'.info���ѷ��',5000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (5004,1,'refund fee for .info deletion',5000,4);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (5004,2,'.info��ɾ��',5000,4);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6001,1,'.us registration fee',6000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6001,2,'.us��ע�',6000,1);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6002,1,'.us deletion fee',6000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6002,2,'.us��ɾ�',6000,2);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6003,1,'.us renewal fee',6000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6003,2,'.us���ѷ��',6000,3);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6004,1,'refund fee for .us deletion',6000,4);
INSERT INTO ordermode (mode_id, mode_lan, mode_name, product_id, mode_type) VALUES (6004,2,'.us��ɾ��',6000,4);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (7001,1,'.in registration fee',7000,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (7002,1,'.in deletion fee',7000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (7003,1,'.in renewal fee',7000,3);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (7004,1,'.in domain refund fee',7000,4);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (8001,1,'.cn registration fee',8000,1);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (8002,1,'.cn deletion fee',8000,2);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (8003,1,'.cn renewal fee',8000,3);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (8004,1,'.cn domain refund  fee',8000,4);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (3005,1,'.org domain sync fee',3000,5);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (2005,1,'.net domain sync fee',2000,5);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (1005,1,'.com domain sync fee',1000,5);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (4005,1,'.biz domain sync fee',4000,5);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (5005,1,'.info domain sync fee',5000,5);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (6005,1,'.us domain sync fee',6000,5);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (7005,1,'.in domain sync fee',7000,5);
INSERT INTO ordermode  (mode_id, mode_lan, mode_name, product_id, mode_type) values (8005,1,'.cn domain sync fee',8000,5);

INSERT INTO mail_data (type, subject,body, macros, day1, day2, day3) VALUES ('register','Domain registration %domains%.','%domains% has been registered','%domains%,%user%,%adddate%,%years%',0,0,0);
INSERT INTO mail_data (type, subject,body, macros, day1, day2, day3) VALUES  ('renew','Domain renewal request.','The following domains should be renewed, Please check from your end.\r\n%domains%   %expdate%','%domains%,%expdate%',15,30,45);
INSERT INTO mail_data (type, subject,body, macros, day1, day2, day3) VALUES ('password','Password for %user%','Password for the user has been reset as\r\n%password%','%user%,%password%',0,0,0);

insert into tasks (task_name) values ('Domain Setting');
insert into tasks (task_name) values ('Domain Upgrade');
insert into tasks (task_name) values ('Manage Domain');
insert into tasks (task_name) values ('Register Domain');
insert into tasks (task_name) values ('Member List');
insert into tasks (task_name) values ('Funds Management');
insert into tasks (task_name) values ('Query Transaction');
insert into tasks (task_name) values ('Whois Search');
insert into tasks (task_name) values ('Domain Sync');
insert into tasks (task_name) values ('Email settings');
insert into tasks (task_name) values ('Dns Manage');
insert into tasks (task_name) values ('Configure Gateway');
insert into tasks (task_name) values ('Domain Lock');
insert into tasks (task_name) values ('Domain Renewal')


