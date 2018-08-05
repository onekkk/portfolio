CREATE DATABASE spot;
CREATE TABLE spot_items(id int AUTO_INCREMENT PRIMARY KEY, author varchar(240), name varchar(240), body varchar(1500), post_date datetime);
CREATE TABLE items_detail(id int AUTO_INCREMENT PRIMARY KEY, item_id int, name varchar(240), body varchar(1500), lat double, lng double);
CREATE TABLE items_detail(id int AUTO_INCREMENT PRIMARY KEY, name varchar(240), password varchar(1000), body varchar(1500));
