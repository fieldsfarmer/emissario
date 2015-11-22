CREATE DATABASE IF NOT EXISTS emissari_cs411
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE emissari_cs411;

CREATE TABLE IF NOT EXISTS User (
	ID BIGINT NOT NULL AUTO_INCREMENT,
    First_Name VARCHAR(100) NOT NULL,
    Last_Name VARCHAR(100) NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    `Password` CHAR(255) NOT NULL,
    City VARCHAR(100) NULL,
    State VARCHAR(100) NULL,
    Country VARCHAR(2) NULL,
    Phone VARCHAR(100) NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (ID)
) ENGINE=InnoDB;

/* Originally Country length was 100. Change this to 2 characters. */
ALTER TABLE User
CHANGE Country Country VARCHAR(2) NULL;

CREATE TABLE IF NOT EXISTS Travel (
	ID BIGINT NOT NULL AUTO_INCREMENT,
    User_ID BIGINT NOT NULL,
    Origin_City VARCHAR(100) NULL,
    Origin_Country VARCHAR(2) NULL,
    Destination_City VARCHAR(100) NULL,
    Destination_Country VARCHAR(2) NULL,
    Travel_Date DATE NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (User_ID) REFERENCES User (ID)
) ENGINE=InnoDB;

/* Originally Origin Country length was 100. Change this to 2 characters. */
ALTER TABLE Travel
CHANGE Origin_Country Origin_Country VARCHAR(2) NULL;

/* Originally Destination Country length was 100. Change this to 2 characters. */
ALTER TABLE Travel
CHANGE Destination_Country Destination_Country VARCHAR(2) NULL;

/* Originally Travel was named Travel_Plan. Drop this old table if exists. */
DROP TABLE IF EXISTS Travel_Plan;

CREATE TABLE IF NOT EXISTS Friend (
	User_ID1 BIGINT NOT NULL,
    User_ID2 BIGINT NOT NULL,
    Pending BIT NOT NULL DEFAULT 1,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (User_ID1, User_ID2),
    FOREIGN KEY (User_ID1) REFERENCES User (ID),
    FOREIGN KEY (User_ID2) REFERENCES User (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Wish (
	ID BIGINT NOT NULL AUTO_INCREMENT,
    User_ID BIGINT NOT NULL,
    Description VARCHAR(1000) NOT NULL,
    Image BLOB NULL,
    Weight VARCHAR(50) NULL,
    Destination_City VARCHAR(100) NULL,
    Destination_Country VARCHAR(2) NULL,
    Max_Date DATE NULL,
    Compensation VARCHAR(100) NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (User_ID) REFERENCES User (ID)
) ENGINE=InnoDB;

/* Originally Destination Country length was 100. Change this to 2 characters. */
ALTER TABLE Wish
CHANGE Destination_Country Destination_Country VARCHAR(2) NULL;

CREATE TABLE IF NOT EXISTS Message (
	ID BIGINT NOT NULL AUTO_INCREMENT,
    Sender_ID BIGINT NOT NULL,
    Recipient_ID BIGINT NOT NULL,
    Title VARCHAR(255) NULL,
    Content VARCHAR(10000) NOT NULL,
    Unread BIT NOT NULL DEFAULT 1,
    Wish_ID BIGINT NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Sender_ID) REFERENCES User (ID),
    FOREIGN KEY (Recipient_ID) REFERENCES User (ID),
    FOREIGN KEY (Wish_ID) REFERENCES Wish (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Help` (
	ID BIGINT NOT NULL AUTO_INCREMENT,
    Wish_ID BIGINT NOT NULL,
    User_ID BIGINT NOT NULL,
    Requested BIT NOT NULL DEFAULT 0,
    Offered BIT NOT NULL DEFAULT 0,
    Created_By BIGINT NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Wish_ID) REFERENCES Wish (ID),
    FOREIGN KEY (User_ID) REFERENCES User (ID),
    FOREIGN KEY (Created_By) REFERENCES User (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Review (
	ID BIGINT NOT NULL AUTO_INCREMENT,
    User_ID BIGINT NOT NULL,
    Help_ID BIGINT NOT NULL,
    Recommended BIT NOT NULL,
    Comments VARCHAR(1000) NULL,
    Created_By BIGINT NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (User_ID) REFERENCES User (ID),
    FOREIGN KEY (Help_ID) REFERENCES `Help` (ID),
    FOREIGN KEY (Created_By) REFERENCES User (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Country (
	Country_Code VARCHAR(2) NOT NULL,
    Country_Name VARCHAR(100) NOT NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (Country_Code)
) ENGINE=InnoDB;

/* Insert countries. */
INSERT INTO Country (Country_Code, Country_Name, Created_On, Modified_On)
SELECT Country_Code, Country_Name, NOW() AS Created_On, NOW() AS Modified_On
FROM (
	SELECT 'AF' AS Country_Code, 'Afghanistan' AS Country_Name
	UNION SELECT 'AX', 'Aland Islands'
	UNION SELECT 'AL', 'Albania'
	UNION SELECT 'DZ', 'Algeria'
	UNION SELECT 'AS', 'American Samoa'
	UNION SELECT 'AD', 'Andorra'
	UNION SELECT 'AO', 'Angola'
	UNION SELECT 'AI', 'Anguilla'
	UNION SELECT 'AQ', 'Antarctica'
	UNION SELECT 'AG', 'Antigua and Barbuda'
	UNION SELECT 'AR', 'Argentina'
	UNION SELECT 'AM', 'Armenia'
	UNION SELECT 'AW', 'Aruba'
	UNION SELECT 'AU', 'Australia'
	UNION SELECT 'AT', 'Austria'
	UNION SELECT 'AZ', 'Azerbaijan'
	UNION SELECT 'BS', 'Bahamas'
	UNION SELECT 'BH', 'Bahrain'
	UNION SELECT 'BD', 'Bangladesh'
	UNION SELECT 'BB', 'Barbados'
	UNION SELECT 'BY', 'Belarus'
	UNION SELECT 'BE', 'Belgium'
	UNION SELECT 'BZ', 'Belize'
	UNION SELECT 'BJ', 'Benin'
	UNION SELECT 'BM', 'Bermuda'
	UNION SELECT 'BT', 'Bhutan'
	UNION SELECT 'BO', 'Bolivia'
	UNION SELECT 'BQ', 'Bonaire, Sint Eustatius and Saba'
	UNION SELECT 'BA', 'Bosnia and Herzegovina'
	UNION SELECT 'BW', 'Botswana'
	UNION SELECT 'BR', 'Brazil'
	UNION SELECT 'IO', 'British Indian Ocean Territory'
	UNION SELECT 'BN', 'Brunei Darussalam'
	UNION SELECT 'BG', 'Bulgaria'
	UNION SELECT 'BF', 'Burkina Faso'
	UNION SELECT 'BI', 'Burundi'
	UNION SELECT 'KH', 'Cambodia'
	UNION SELECT 'CM', 'Cameroon'
	UNION SELECT 'CA', 'Canada'
	UNION SELECT 'CV', 'Cape Verde'
	UNION SELECT 'KY', 'Cayman Islands'
	UNION SELECT 'CF', 'Central African Republic'
	UNION SELECT 'TD', 'Chad'
	UNION SELECT 'CL', 'Chile'
	UNION SELECT 'CN', 'China'
	UNION SELECT 'CX', 'Christmas Island'
	UNION SELECT 'CC', 'Cocos (Keeling) Islands'
	UNION SELECT 'CO', 'Colombia'
	UNION SELECT 'KM', 'Comoros'
	UNION SELECT 'CG', 'Congo, Republic of'
	UNION SELECT 'CD', 'Congo, Democratic Republic of'
	UNION SELECT 'CK', 'Cook Islands'
	UNION SELECT 'CR', 'Costa Rica'
	UNION SELECT 'CI', 'Cote d''Ivoire'
	UNION SELECT 'HR', 'Croatia'
	UNION SELECT 'CU', 'Cuba'
	UNION SELECT 'CW', 'Curacao'
	UNION SELECT 'CY', 'Cyprus'
	UNION SELECT 'CZ', 'Czech Republic'
	UNION SELECT 'DK', 'Denmark'
	UNION SELECT 'DJ', 'Djibouti'
	UNION SELECT 'DM', 'Dominica'
	UNION SELECT 'DO', 'Dominican Republic'
	UNION SELECT 'EC', 'Ecuador'
	UNION SELECT 'EG', 'Egypt'
	UNION SELECT 'SV', 'El Salvador'
	UNION SELECT 'GQ', 'Equatorial Guinea'
	UNION SELECT 'ER', 'Eritrea'
	UNION SELECT 'EE', 'Estonia'
	UNION SELECT 'ET', 'Ethiopia'
	UNION SELECT 'FK', 'Falkland Islands (Malvinas)'
	UNION SELECT 'FO', 'Faroe Islands'
	UNION SELECT 'FJ', 'Fiji'
	UNION SELECT 'FI', 'Finland'
	UNION SELECT 'FR', 'France'
	UNION SELECT 'GF', 'French Guiana'
	UNION SELECT 'PF', 'French Polynesia'
	UNION SELECT 'TF', 'French Southern Territories'
	UNION SELECT 'GA', 'Gabon'
	UNION SELECT 'GM', 'Gambia'
	UNION SELECT 'GE', 'Georgia'
	UNION SELECT 'DE', 'Germany'
	UNION SELECT 'GH', 'Ghana'
	UNION SELECT 'GI', 'Gibraltar'
	UNION SELECT 'GR', 'Greece'
	UNION SELECT 'GL', 'Greenland'
	UNION SELECT 'GD', 'Grenada'
	UNION SELECT 'GP', 'Guadeloupe'
	UNION SELECT 'GU', 'Guam'
	UNION SELECT 'GT', 'Guatemala'
	UNION SELECT 'GG', 'Guernsey'
	UNION SELECT 'GN', 'Guinea'
	UNION SELECT 'GW', 'Guinea-Bissau'
	UNION SELECT 'GY', 'Guyana'
	UNION SELECT 'HT', 'Haiti'
	UNION SELECT 'HM', 'Heard Island and McDonald Islands'
	UNION SELECT 'VA', 'Vatican City (Holy See)'
	UNION SELECT 'HN', 'Honduras'
	UNION SELECT 'HK', 'Hong Kong'
	UNION SELECT 'HU', 'Hungary'
	UNION SELECT 'IS', 'Iceland'
	UNION SELECT 'IN', 'India'
	UNION SELECT 'ID', 'Indonesia'
	UNION SELECT 'IR', 'Iran'
	UNION SELECT 'IQ', 'Iraq'
	UNION SELECT 'IE', 'Ireland'
	UNION SELECT 'IM', 'Isle of Man'
	UNION SELECT 'IL', 'Israel'
	UNION SELECT 'IT', 'Italy'
	UNION SELECT 'JM', 'Jamaica'
	UNION SELECT 'JP', 'Japan'
	UNION SELECT 'JE', 'Jersey'
	UNION SELECT 'JO', 'Jordan'
	UNION SELECT 'KZ', 'Kazakhstan'
	UNION SELECT 'KE', 'Kenya'
	UNION SELECT 'KI', 'Kiribati'
	UNION SELECT 'KP', 'Korea, Democratic People''s Republic of'
	UNION SELECT 'KR', 'Korea, Republic of'
	UNION SELECT 'KW', 'Kuwait'
	UNION SELECT 'KG', 'Kyrgyzstan'
	UNION SELECT 'LA', 'Laos'
	UNION SELECT 'LV', 'Latvia'
	UNION SELECT 'LB', 'Lebanon'
	UNION SELECT 'LS', 'Lesotho'
	UNION SELECT 'LR', 'Liberia'
	UNION SELECT 'LY', 'Libya'
	UNION SELECT 'LI', 'Liechtenstein'
	UNION SELECT 'LT', 'Lithuania'
	UNION SELECT 'LU', 'Luxembourg'
	UNION SELECT 'MO', 'Macao'
	UNION SELECT 'MK', 'Macedonia'
	UNION SELECT 'MG', 'Madagascar'
	UNION SELECT 'MW', 'Malawi'
	UNION SELECT 'MY', 'Malaysia'
	UNION SELECT 'MV', 'Maldives'
	UNION SELECT 'ML', 'Mali'
	UNION SELECT 'MT', 'Malta'
	UNION SELECT 'MH', 'Marshall Islands'
	UNION SELECT 'MQ', 'Martinique'
	UNION SELECT 'MR', 'Mauritania'
	UNION SELECT 'MU', 'Mauritius'
	UNION SELECT 'YT', 'Mayotte'
	UNION SELECT 'MX', 'Mexico'
	UNION SELECT 'FM', 'Micronesia'
	UNION SELECT 'MD', 'Moldova'
	UNION SELECT 'MC', 'Monaco'
	UNION SELECT 'MN', 'Mongolia'
	UNION SELECT 'ME', 'Montenegro'
	UNION SELECT 'MS', 'Montserrat'
	UNION SELECT 'MA', 'Morocco'
	UNION SELECT 'MZ', 'Mozambique'
	UNION SELECT 'MM', 'Myanmar'
	UNION SELECT 'NA', 'Namibia'
	UNION SELECT 'NR', 'Nauru'
	UNION SELECT 'NP', 'Nepal'
	UNION SELECT 'NL', 'Netherlands'
	UNION SELECT 'NC', 'New Caledonia'
	UNION SELECT 'NZ', 'New Zealand'
	UNION SELECT 'NI', 'Nicaragua'
	UNION SELECT 'NE', 'Niger'
	UNION SELECT 'NG', 'Nigeria'
	UNION SELECT 'NU', 'Niue'
	UNION SELECT 'NF', 'Norfolk Island'
	UNION SELECT 'MP', 'Northern Mariana Islands'
	UNION SELECT 'NO', 'Norway'
	UNION SELECT 'OM', 'Oman'
	UNION SELECT 'PK', 'Pakistan'
	UNION SELECT 'PW', 'Palau'
	UNION SELECT 'PS', 'Palestine'
	UNION SELECT 'PA', 'Panama'
	UNION SELECT 'PG', 'Papua New Guinea'
	UNION SELECT 'PY', 'Paraguay'
	UNION SELECT 'PE', 'Peru'
	UNION SELECT 'PH', 'Philippines'
	UNION SELECT 'PN', 'Pitcairn'
	UNION SELECT 'PL', 'Poland'
	UNION SELECT 'PT', 'Portugal'
	UNION SELECT 'PR', 'Puerto Rico'
	UNION SELECT 'QA', 'Qatar'
	UNION SELECT 'RE', 'Reunion'
	UNION SELECT 'RO', 'Romania'
	UNION SELECT 'RU', 'Russian Federation'
	UNION SELECT 'RW', 'Rwanda'
	UNION SELECT 'BL', 'Saint Barthelemy'
	UNION SELECT 'SH', 'Saint Helena, Ascension and Tristan Da Cunha'
	UNION SELECT 'KN', 'Saint Kitts and Nevis'
	UNION SELECT 'LC', 'Saint Lucia'
	UNION SELECT 'MF', 'Saint Martin (French)'
	UNION SELECT 'PM', 'Saint Pierre and Miquelon'
	UNION SELECT 'VC', 'Saint Vincent and the Grenadines'
	UNION SELECT 'WS', 'Samoa'
	UNION SELECT 'SM', 'San Marino'
	UNION SELECT 'ST', 'Sao Tome and Principe'
	UNION SELECT 'SA', 'Saudi Arabia'
	UNION SELECT 'SN', 'Senegal'
	UNION SELECT 'RS', 'Serbia'
	UNION SELECT 'SC', 'Seychelles'
	UNION SELECT 'SL', 'Sierra Leone'
	UNION SELECT 'SG', 'Singapore'
	UNION SELECT 'SX', 'Sint Maarten (Dutch)'
	UNION SELECT 'SK', 'Slovakia'
	UNION SELECT 'SI', 'Slovenia'
	UNION SELECT 'SB', 'Solomon Islands'
	UNION SELECT 'SO', 'Somalia'
	UNION SELECT 'ZA', 'South Africa'
	UNION SELECT 'GS', 'South Georgia and the South Sandwich Islands'
	UNION SELECT 'SS', 'South Sudan'
	UNION SELECT 'ES', 'Spain'
	UNION SELECT 'LK', 'Sri Lanka'
	UNION SELECT 'SD', 'Sudan'
	UNION SELECT 'SR', 'Suriname'
	UNION SELECT 'SJ', 'Svalbard and Jan Mayen'
	UNION SELECT 'SZ', 'Swaziland'
	UNION SELECT 'SE', 'Sweden'
	UNION SELECT 'CH', 'Switzerland'
	UNION SELECT 'SY', 'Syrian Arab Republic'
	UNION SELECT 'TW', 'Taiwan'
	UNION SELECT 'TJ', 'Tajikistan'
	UNION SELECT 'TZ', 'Tanzania'
	UNION SELECT 'TH', 'Thailand'
	UNION SELECT 'TL', 'Timor-Leste'
	UNION SELECT 'TG', 'Togo'
	UNION SELECT 'TK', 'Tokelau'
	UNION SELECT 'TO', 'Tonga'
	UNION SELECT 'TT', 'Trinidad and Tobago'
	UNION SELECT 'TN', 'Tunisia'
	UNION SELECT 'TR', 'Turkey'
	UNION SELECT 'TM', 'Turkmenistan'
	UNION SELECT 'TC', 'Turks and Caicos Islands'
	UNION SELECT 'TV', 'Tuvalu'
	UNION SELECT 'UG', 'Uganda'
	UNION SELECT 'UA', 'Ukraine'
	UNION SELECT 'AE', 'United Arab Emirates'
	UNION SELECT 'GB', 'United Kingdom'
	UNION SELECT 'US', 'United States'
	UNION SELECT 'UM', 'United States Minor Outlying Islands'
	UNION SELECT 'UY', 'Uruguay'
	UNION SELECT 'UZ', 'Uzbekistan'
	UNION SELECT 'VU', 'Vanuatu'
	UNION SELECT 'VE', 'Venezuela'
	UNION SELECT 'VN', 'Vietnam'
	UNION SELECT 'VG', 'Virgin Islands (British)'
	UNION SELECT 'VI', 'Virgin Islands (US)'
	UNION SELECT 'WF', 'Wallis and Futuna'
	UNION SELECT 'EH', 'Western Sahara'
	UNION SELECT 'YE', 'Yemen'
	UNION SELECT 'ZM', 'Zambia'
	UNION SELECT 'ZW', 'Zimbabwe'
) Tmp
WHERE NOT EXISTS (
	SELECT C.Country_Code
    FROM Country C
    WHERE C.Country_Code = Tmp.Country_Code);

CREATE TABLE IF NOT EXISTS State (
	Country_Code VARCHAR(2) NOT NULL,
	State_Code VARCHAR(100) NOT NULL,
    State_Name VARCHAR(100) NOT NULL,
    Created_On DATETIME NULL,
    Modified_On DATETIME NULL,
    PRIMARY KEY (Country_Code, State_Code),
    FOREIGN KEY (Country_Code) REFERENCES Country (Country_Code)
) ENGINE=InnoDB;

/* Insert states for USA. */
INSERT INTO State (Country_Code, State_Code, State_Name, Created_On, Modified_On)
SELECT Country_Code, State_Code, State_Name, NOW() AS Created_On, NOW() AS Modified_On
FROM (
	SELECT 'US' AS Country_Code, 'AL' AS State_Code, 'Alabama' AS State_Name
	UNION SELECT 'US', 'AK', 'Alaska'
	UNION SELECT 'US', 'AZ', 'Arizona'
	UNION SELECT 'US', 'AR', 'Arkansas'
	UNION SELECT 'US', 'CA', 'California'
	UNION SELECT 'US', 'CO', 'Colorado'
	UNION SELECT 'US', 'CT', 'Connecticut'
	UNION SELECT 'US', 'DE', 'Delaware'
	UNION SELECT 'US', 'DC', 'District of Columbia'
	UNION SELECT 'US', 'FL', 'Florida'
	UNION SELECT 'US', 'GA', 'Georgia'
	UNION SELECT 'US', 'HI', 'Hawaii'
	UNION SELECT 'US', 'ID', 'Idaho'
	UNION SELECT 'US', 'IL', 'Illinois'
	UNION SELECT 'US', 'IN', 'Indiana'
	UNION SELECT 'US', 'IA', 'Iowa'
	UNION SELECT 'US', 'KS', 'Kansas'
	UNION SELECT 'US', 'KY', 'Kentucky'
	UNION SELECT 'US', 'LA', 'Louisiana'
	UNION SELECT 'US', 'ME', 'Maine'
	UNION SELECT 'US', 'MD', 'Maryland'
	UNION SELECT 'US', 'MA', 'Massachusetts'
	UNION SELECT 'US', 'MI', 'Michigan'
	UNION SELECT 'US', 'MN', 'Minnesota'
	UNION SELECT 'US', 'MS', 'Mississippi'
	UNION SELECT 'US', 'MO', 'Missouri'
	UNION SELECT 'US', 'MT', 'Montana'
	UNION SELECT 'US', 'NE', 'Nebraska'
	UNION SELECT 'US', 'NV', 'Nevada'
	UNION SELECT 'US', 'NH', 'New Hampshire'
	UNION SELECT 'US', 'NJ', 'New Jersey'
	UNION SELECT 'US', 'NM', 'New Mexico'
	UNION SELECT 'US', 'NY', 'New York'
	UNION SELECT 'US', 'NC', 'North Carolina'
	UNION SELECT 'US', 'ND', 'North Dakota'
	UNION SELECT 'US', 'OH', 'Ohio'
	UNION SELECT 'US', 'OK', 'Oklahoma'
	UNION SELECT 'US', 'OR', 'Oregon'
	UNION SELECT 'US', 'PA', 'Pennsylvania'
	UNION SELECT 'US', 'RI', 'Rhode Island'
	UNION SELECT 'US', 'SC', 'South Carolina'
	UNION SELECT 'US', 'SD', 'South Dakota'
	UNION SELECT 'US', 'TN', 'Tennessee'
	UNION SELECT 'US', 'TX', 'Texas'
	UNION SELECT 'US', 'UT', 'Utah'
	UNION SELECT 'US', 'VT', 'Vermont'
	UNION SELECT 'US', 'VA', 'Virginia'
	UNION SELECT 'US', 'WA', 'Washington'
	UNION SELECT 'US', 'WV', 'West Virginia'
	UNION SELECT 'US', 'WI', 'Wisconsin'
	UNION SELECT 'US', 'WY', 'Wyoming'
) Tmp
WHERE NOT EXISTS (
	SELECT S.State_Code
    FROM State S
    WHERE S.Country_Code = Tmp.Country_Code
		AND S.State_Code = Tmp.State_Code);

ALTER TABLE Friend
MODIFY Pending TINYINT(1) NOT NULL DEFAULT 1;

ALTER TABLE Message
MODIFY Unread TINYINT(1) NOT NULL DEFAULT 1;

ALTER TABLE `Help`
MODIFY Requested TINYINT(1) NOT NULL DEFAULT 0,
MODIFY Offered TINYINT(1) NOT NULL DEFAULT 0;

ALTER TABLE Review
MODIFY Recommended TINYINT(1) NOT NULL;