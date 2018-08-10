CREATE DATABASE spot;
CREATE TABLE spot_items(id int AUTO_INCREMENT PRIMARY KEY, author varchar(240), name varchar(240), body varchar(1500), post_date datetime);
CREATE TABLE items_detail(id int AUTO_INCREMENT PRIMARY KEY, item_id int, name varchar(240), body varchar(1500), lat double, lng double);
CREATE TABLE user(id int AUTO_INCREMENT PRIMARY KEY, username varchar(240), password varchar(1000), body varchar(1500));
CREATE TABLE follow(id int AUTO_INCREMENT PRIMARY KEY, follow varchar(240), follower varchar(240));
CREATE TABLE bookmark(id int AUTO_INCREMENT PRIMARY KEY, user varchar(240), follower int);
