Mitchells-MacBook-Pro:shoe_store Mitch$ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 2
Server version: 5.5.42 Source distribution

Copyright (c) 2000, 2015, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> CREATE DATABASE shoes;
Query OK, 1 row affected (0.00 sec)

mysql> USE shoes;
Database changed
mysql> CREATE TABLE stores (id serial PRIMARY KEY, name varchar(500));
Query OK, 0 rows affected (0.01 sec)

mysql> CREATE TABLE brands (id serial PRIMARY KEY, brand_name varchar(500));
Query OK, 0 rows affected (0.01 sec)

mysql> CREATE TABLE brands_stores (id serial PRIMARY KEY, store_id int, brand_id int);
Query OK, 0 rows affected (0.01 sec)

mysql> 
