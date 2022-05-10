<?php
/*
need to find better and more elegant way of making sql statements
for now I have to input this in my sql panel in localhost.

CREATE TABLE "users" (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  "name" varchar(30) NOT NULL,
  "email" varchar(100) NOT NULL,
  "password" varchar(250) NOT NULL,
  "status" int(11) NOT NULL DEFAULT "0",
  "email_verification_link" varchar(255) NOT NULL,
  "email_verified_at" TIMESTAMP NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "email" ("email")
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

$servername='localhost';
$username='root';
$password='';
$dbname = "my_db";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
    if(!$conn){
        die('Could not Connect MySql Server:' .mysql_error());
    }