CREATE TABLE users (
   id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
   name varchar(100) NOT NULL,
   email varchar(255) NOT NULL UNIQUE,
   telephone varchar(20) NOT NULL,
   password VARCHAR(255) NOT NULL,
   ip_address varchar(45) NOT NULL,
   login_attempts INT UNSIGNED NOT NULL DEFAULT 0,
   created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   UNIQUE KEY idx_users_name (name)
);

CREATE TABLE categories (
   catid INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
   name varchar(100) NOT NULL,
   parent INT NOT NULL DEFAULT 0,
   live ENUM('yes', 'no') DEFAULT 'no',
   image TEXT,
   created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  prodid INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  type ENUM('standard', 'made to order') DEFAULT 'standard',
  live ENUM('yes', 'no') DEFAULT 'no',
  variant_display ENUM('button', 'dropdown') default 'button' NOT NULL
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE options (
    optid INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_options (
 poid INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
 optid INT NOT NULL,
 prodid INT NOT NULL,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_option_values (
     pov INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
     poid INT NOT NULL,
     value VARCHAR(255),
     created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE variants (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  prodid INT UNSIGNED NOT NULL,
  code VARCHAR(80) NOT NULL,
  barcode VARCHAR(80) NOT NULL,
  value1 VARCHAR(255),
  value2 VARCHAR(255),
  value3 VARCHAR(255),
  stock INT DEFAULT 0,
  reserved INT DEFAULT 0,
  stockonorder INT DEFAULT 0,
  vlive ENUM('yes', 'no') DEFAULT 'yes',
  allowbackorder ENUM ('yes', 'no') DEFAULT 'no',
  price decimal(10, 2) NOT NULL DEFAULT 0,
  vat ENUM('standard', 'reduced', 'zero', 'exempt') DEFAULT 'standard',
  width decimal(6, 2),
  depth decimal(6, 2),
  length decimal(6, 2),
  height decimal(6, 2),
  volume decimal(6, 2),
  weight decimal(6, 2),
  leadtime INT,
  stocktext VARCHAR(100),
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (prodid) REFERENCES products(prodid)
);

CREATE TABLE product_images (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    prodid INT UNSIGNED NOT NULL,
    url TEXT NOT NULL,
    alt VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (prodid) REFERENCES products(prodid)
);

/*
get vat total
get amount of vat for the order
take off discount vat
add on postage vat
gets the total vat for the order


check for if the customer is not in GB but does charge vat so local vat applies
 */
