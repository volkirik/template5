/*==============================================================*/
/* Database name:  templates		                        */
/* DBMS name:      Microsoft SQL Server 7                       */
/* Created on:     2002-6-12 10:25:27                           */
/*==============================================================*/

if exists (	select 1
            	from 	sysobjects
           	where	id = object_id('country')
            		and type = 'U')
		drop table country;

if exists (	select 1
            	from	sysobjects
           	where	id = object_id('members')
            		and type = 'U')
   		drop table members;

if exists (	select 1
            	from	sysobjects
           	where	id = object_id('sessions')
            		and type = 'U')
   		drop table sessions;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('orders')
            		and type = 'U')
   		drop table orders;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('products')
            		and type = 'U')
   		drop table products;
   		
if exists (select 1
            	from	sysobjects
           	where	id = object_id('ordermode')
            		and type = 'U')
   		drop table ordermode;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('member_price')
            		and type = 'U')
   		drop table member_price;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('admins')
            		and type = 'U')
   		drop table admins;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('tasks')
            		and type = 'U')
   		drop table tasks;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('admintask')
            		and type = 'U')
   		drop table admintask;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('default_dns')
            		and type = 'U')
   		drop table default_dns;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('web_config')
            		and type = 'U')
   		drop table web_config;
   		
if exists (select 1
            	from	sysobjects
           	where	id = object_id('domains')
            		and type = 'U')
   		drop table domains;

if exists (select 1
            	from	sysobjects
           	where	id = object_id('contacts')
            		and type = 'U')
   		drop table contacts;

/*==============================================================*/
/* Table: country                                               */
/*==============================================================*/
create table country (
	country_name         varchar(50)          not null,
	country_code         varchar(3)           not null,
	primary key (country_name)
);

/*==============================================================*/
/* Table: members                                               */
/*==============================================================*/
create table members (
	member_id            int                  identity,
	member_name          varchar(50)          not null,
	member_password      varchar(50)          not null,
	flag                 int                  not null,
	member_level         int                  not null,
	reg_time             datetime             not null,
	account              money		  not null,
	message              varchar(254)         null,
	r_name               varchar(100)         null,
	r_org                varchar(100)         null,
	r_address1           varchar(100)         null,
	r_address2           varchar(100)         null,
	r_address3           varchar(100)         null,
	r_city               varchar(100)         null,
	r_province           varchar(100)         null,
	r_country            varchar(100)         null,
	r_postalcode         varchar(20)          null,
	r_telephone          varchar(50)          null,
	r_telephone_ext      varchar(10)          null,
	r_fax                varchar(50)          null,
	r_fax_ext            varchar(10)          null,
	r_email              varchar(100)         null,
	primary key  (member_id, member_name)
);

/*==============================================================*/
/* Table: sessions                                              */
/*==============================================================*/
create table sessions (
	session_id		int		identity,
	login_type		int		not null,
	member_id		int		not null,
	remote_addr		varchar(20)	not null,
	last_access_time	datetime	not null
	primary key (session_id)
);

/*==============================================================*/
/* Table: orders                                                */
/*==============================================================*/
create table orders (
	order_id		int		not null IDENTITY,
	member_id		int		not null,
	order_date		datetime	not null,
	order_type		int		not null,
	mode_id			int		not null,
	order_amount		money		not null,
	amount			money		not null,
	admin_id		int		not null,
	note			varchar(254),
	primary key(order_id)
);

/*==============================================================*/
/* Table: products                                              */
/*==============================================================*/
create table products (
	id			int		not null IDENTITY,
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
create table ordermode (
	ordermode_id		int		not null IDENTITY,
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
create table member_price (
	member_price_id		int		not null IDENTITY,
	product_id		int		not null,
	member_level		int		not null,
	type			int		not null,
	i_year			int		not null,
	price			money		not null,
	add_time		datetime	not null,
	mod_time		datetime,
	primary key (member_price_id)
);

/*==============================================================*/
/* Table: admins	                                        */
/*==============================================================*/
create table admins (
	admin_id		int		not null IDENTITY(100, 1),
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
create table tasks (
	task_id			int		not null IDENTITY,
	task_name		varchar(20)	not null,
	primary key (task_id)
);

/*==============================================================*/
/* Table: admintask						*/
/*==============================================================*/
create table admintask (
	admintask_id		int		not null IDENTITY,
	admin_id		int		not null,
	task_id			int		not null,
	primary key (admintask_id)
);

/*==============================================================*/
/* Table: default_dns						*/
/*==============================================================*/
create table default_dns (
	default_dns_id		int		not null IDENTITY,
	product_id		int		not null,
	dns_name		varchar(100)	not null,
	primary key (default_dns_id)
);

/*==============================================================*/
/* Table: web_config						*/
/*==============================================================*/
create table web_config (
	current_skin		varchar(50),
	website_language	int,
	title			varchar(200),
	copyright		varchar(200),
	pagesize		int,
	system_status		int,
	order_id		int,
	customer_id		int,
	password		varchar(33),
	reg_host		varchar(50),
	reg_port		int,
	rela_dir		varchar(50),
	dom_upg_host		varchar(50),
	dom_upg_port		int,
	dom_upg_url		varchar(50),
	support_email		varchar(100),
	current_theme 		varchar(50),
	domain_lock 		int,
	domain_renewal 		int,
	captcha_enable 		int
);

/*==============================================================*/
/* Table: domains                                               */
/*==============================================================*/
create table domains (
	domain_id		int		not null IDENTITY,
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
	amount			money		not null,
	primary key (domain_id)
);

/*==============================================================*/
/* Table: contactor                                             */
/*==============================================================*/
create table contacts (
	contact_id		int		not null IDENTITY,
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
insert into country(country_name, country_code) values ("RéUNION", "RE");
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

insert into products(product_id, domain_type, product_name, product_type, flag) values (1000, 0, '.com', 1, 1);
insert into products(product_id, domain_type, product_name, product_type, flag) values (2000, 0, '.net', 1, 1);
insert into products(product_id, domain_type, product_name, product_type, flag) values (3000, 0, '.org', 1, 1);
insert into products(product_id, domain_type, product_name, product_type, flag) values (4000, 800, '.biz', 1, 1);
insert into products(product_id, domain_type, product_name, product_type, flag) values (5000, 805, '.info', 1, 1);
insert into products(product_id, domain_type, product_name, product_type, flag) values (6000, 806, '.us', 1, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1, 1, 'Funds added', 0, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1, 2, '添加资金', 0, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2, 1, 'Funds subtracted', 0, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2, 2, '扣款', 0, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1001, 1, '.com registration fee', 1000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1001, 2, '.com域名注册费', 1000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1002, 1, '.com deletion fee', 1000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1002, 2, '.com域名删除费', 1000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1003, 1, '.com renewal fee', 1000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1003, 2, '.com域名续费费用', 1000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1004, 1, 'refund fee for .com deletion', 1000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (1004, 2, '.com域名删除退款', 1000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2001, 1, '.net registration fee', 2000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2001, 2, '.net域名注册费', 2000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2002, 1, '.net deletion fee', 2000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2002, 2, '.net域名删除费', 2000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2003, 1, '.net renewal fee', 2000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2003, 2, '.net域名续费费用', 2000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2004, 1, 'refund fee for .net deletion', 2000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (2004, 2, '.net域名删除退款', 2000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3001, 1, '.org registration fee', 3000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3001, 2, '.org域名注册费', 3000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3002, 1, '.org deletion fee', 3000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3002, 2, '.org域名删除费', 3000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3003, 1, '.org renewal fee', 3000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3003, 2, '.org域名续费费用', 3000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3004, 1, 'refund fee for .org deletion', 3000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (3004, 2, '.org域名删除退款', 3000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4001, 1, '.biz registration fee', 4000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4001, 2, '.biz域名注册费', 4000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4002, 1, '.biz deletion fee', 4000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4002, 2, '.biz域名删除费', 4000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4003, 1, '.biz renewal fee', 4000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4003, 2, '.biz域名续费费用', 4000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4004, 1, 'refund fee for .biz deletion', 4000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (4004, 2, '.biz域名删除退款', 4000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5001, 1, '.info registration fee', 5000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5001, 2, '.info域名注册费', 5000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5002, 1, '.info deletion fee', 5000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5002, 2, '.info域名删除费', 5000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5003, 1, '.info renewal fee', 5000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5003, 2, '.info域名续费费用', 5000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5004, 1, 'refund fee for .info deletion', 5000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (5004, 2, '.info域名删除退款', 5000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6001, 1, '.us registration fee', 6000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6001, 2, '.us域名注册费', 6000, 1);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6002, 1, '.us deletion fee', 6000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6002, 2, '.us域名删除费', 6000, 2);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6003, 1, '.us renewal fee', 6000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6003, 2, '.us域名续费费用', 6000, 3);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6004, 1, 'refund fee for .us deletion', 6000, 4);
insert into ordermode(mode_id, mode_lan, mode_name, product_id, mode_type) values (6004, 2, '.us域名删除退款', 6000, 4);

insert into tasks (task_name) values ('Domain Setting');
insert into tasks (task_name) values ('Domain Upgrade');
insert into tasks (task_name) values ('Manage Domain');
insert into tasks (task_name) values ('Check Domain');
insert into tasks (task_name) values ('Member List');
insert into tasks (task_name) values ('Funds Management');
insert into tasks (task_name) values ('Query Transaction');
insert into tasks (task_name) values ('Whois Search');
