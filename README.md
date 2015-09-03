# _{Shoe Store}_

##### _{find some shoes}, {September 3, 2015}_

#### By _**{Mitch Rivet}**_

## Description

_{A web application that allows users to catalogue shoe stores and shoe brands.}_

## Setup

1. clone this repository from github: https://github.com/MitchRivet/shoe_store
2. Create the database from the mysql commands below, or import the shoes.sql.zip file
MYSQL COMMANDS
mysql> CREATE DATABASE shoes;
Query OK, 1 row affected (0.00 sec)

mysql> USE shoes;
Database changed
mysql> CREATE TABLE stores (id serial PRIMARY KEY, store_name varchar(500));
Query OK, 0 rows affected (0.01 sec)

mysql> CREATE TABLE brands (id serial PRIMARY KEY, brand_name varchar(500));
Query OK, 0 rows affected (0.01 sec)

mysql> CREATE TABLE brands_stores (id serial PRIMARY KEY, store_id int, brand_id int);
Query OK, 0 rows affected (0.01 sec)

3. navigate to shoe_store/web folder and type this command into your console:
    $ php -S localhost:8000

4. Now go to your web browser and navigate to:
    localhost:8000/

## Technologies Used

PHPUnit, Silex, Twig, MySql

### Legal



Copyright (c) 2015 **_{Mitch Rivet}_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE
