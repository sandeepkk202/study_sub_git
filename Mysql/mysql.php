<?php
/*
# Version 5.5, 5.6, 5.7, 8.0

# What is the difference MySQL and MySQLi?
    MySQLi supports both procedural interfaces and object oriented interfaces while MySQL supports only procedural interfaces. 

# MySQL supported storage engines:
    InnoDB.
    MyISAM.
    Memory.
    CSV.
    Merge.
    Archive.
    Federated.
    Blackhole.

# mysqld --console (start sql)
  c:\mysql\bin\mysql -u root -p (enter) login

    SHOW DATABASES;
    USE database_name;

    CREATE DATABASE bd_name
    ALTER DATABASE bd_name 
    DROP DATABASE bd_name
    CREATE TABLE tb_name
    ALTER TABLE tb_name (CHANGE, ADD, AFTER, MODIFY COLUMN, DROP)
    TRUNCATE TABLE tb_name
    DROP TABLE tb_name

    ON DELETE CASCADE

    CREATE TABLE tb_name {
        column_name type() PRIMARY KEY  // like:- user_name VARCHAR(20)
        column_name type() FIRST  UNIQUE KEY// like:- user_name VARCHAR(20)
        column_name type() LAST  // like:- user_name VARCHAR(20)
        column_name type() AFTER emp_id  // like:- user_name VARCHAR(20)
        column_name type()   // like:- user_name VARCHAR(20)
    }
    
# Datatypes in MySQL are divided into this 3 categories:
1.  Numeric
2.  Strings
3.  Date and Time

# Numbers in MySQL are:
1.  INT
2.  TINYINT
3.  SMALLINT
4.  MEDIUMINT
5.  BIGINT
6.  FLOAT
7.  DOUBLE
8.  DECIMAL

# String in MySQL are:
1.  CHAR
2.  VARCHAR
3.  BLOB (TINYBLOB, MEDIUMBLOB, LONGBLOB)
4.  TEXT (TINYTEXT, MEDIUMTEXT, LONGTEXT)
5.  ENUM

# Date and Time in MySQL are:
1.  DATE
2.  TIME
3.  DATETIME
4.  TIMESTAMP

# TYPE
1.  INT INTEGER (-32,768 / 32,767)
    INT(size)

2.  DEC DECIMAL ()
    DECIMAL(size, p)

3.  CHAR CHARACTER (255)
    CHAR (size)

4.  VARCHAR (255)  // it automatic convert in TEXT if size is greater than 255
    VARCHAR (size)

5.  TEXT (65,535)

6.  DATE (yyyy,mm,dd), 
    DATETIME (yyyy,mm,dd hh:mm:ss), 
    TIMESTAMP (date and time)

7.  NULL
    NOT NULL

8.  UNIQUE KEY  // IT SHOULD BE ONE OR MORE TABLE ALSO CAN CONTAIN NULL VALUE

9.  PRIMARY KEY  // IT SHOULD BE ONLY ONE TABLE

# OPRETORS
    =         :-Equal
    !=, <>    :-Not equal  
    >         :-Greater then
    <         :-Less then
    >=        :-Greater then or equal
    <=        :-Less then or equal
    BETWEEN   :-Between an inclusive range
    LIKE      :-Search for a pattern
    IN        :-To specify multple possible value for a column



#FUNCTIONS
    MIN()
    MAX()
    SUM()
    AVG()
    SQRT()
    ROUND()
    COUNT()
    UPPER()
    UCASE()
    LOWER()
    LCASE()
    MID(city, 1, 3)
    LENGTH()
    CONCAT(name, '', city)
    REVERSE()
    NOW() current date time
    
# clause 
        ( 
            AS, DISTINCT
        )
        ( 
            WHERE, IS NULL, IS NOT NULL, AND, OR, LIMIT, IN, NOT IN, BETWEEN, NOT BETWEEN, LIKE"%_", NOT LIKE"%_",
            ORDER BY"ASC/DESC", GROUP BY, HAVING 
        )
    
# QUERY   
    SELECT MIN(col_name) FROM students;

    SELECT * FROM students WHERE id=10 
    
    SELECT * FROM students WHERE name LIKE "$str%"; // display all name strart with $str (% is wildcards)

    SELECT * FROM students WHERE city IN ('fzr', 'kkp', 'mwx')  // display all student related 'fzr', 'kkp', 'mwx'
    
    SELECT * FROM students WHERE id BETWEEN 5 AND 9;  // display all student between 5 to 9

    SELECT * FROM students WHERE name BETWEEN 'B' AND 'F';  // display all student name from B to E 

    SELECT * FROM students WHERE id NOT BETWEEN 5 AND 9;  // display all student except between 5 to 9

    SELECT * FROM students WHERE name NOT BETWEEN 'B' AND 'F';  // display all student name except from c to F 

    SELECT * FROM students WHERE admission_date BETWEEN 'yyyy/mm/03' AND 'yyyy/mm/22';  // display all student from 03 to 22 
    
    SELECT * FROM students WHERE admission_date NOT BETWEEN 'yyyy/mm/15' AND 'yyyy/mm/22';  // display all student except from 15 to 22 
    
    SELECT * FROM students LIMIT 1, 5;  (limit startfrom, totalrecord)  // display 23456 record

    SELECT * FROM students WHERE name:rahul AND (stu_addr = 'goa' OR leg = "hindi"); 

    SELECT * FROM user WHERE (salary BETWEEN 10000 AND 15000) 
    AND city IN('kkp', 'mwx'); // display data between 10001 to 15000 which are in kkp or mwx city
    AND city NOT IN('kkp', 'mwx'); // display data between 10001 to 15000 which are not in kkp or mwx city

    INSERT INTO students (name,email,marks,city) values (?, ?, ?, ?),(?, ?, ?, ?);

    INSERT INTO students values (?, ?, ?, ?)

    UPDATE students SET name = sandeep, email = sk@g.com WHERE id = 1;

    DELETE FROM students WHERE id = 1;

    --------------------------------- JOINS --------------------------------
    
    SELECT t1.emp_name, t1.hire_date, t2.dept_name FROM employees AS t1 INNER JOIN departments AS t2
    ON t1.dept_id = t2.dept_id ORDER BY emp_id;

    SELECT t1.emp_name, t1.hire_date, t2.dept_name FROM departments AS t2 LEFT JOIN employees AS t1 
    ON t1.dept_id = t2.dept_id ORDER BY emp_id;

    SELECT t1.emp_name, t1.hire_date, t2.dept_name FROM employees AS t1 RIGHT JOIN departments AS t2
    ON t1.dept_id = t2.dept_id ORDER BY dept_name;

    SELECT t1.emp_name, t1.hire_date, t2.dept_name FROM employees AS t1 FULL JOIN departments AS t2
    ON t1.dept_id = t2.dept_id ORDER BY emp_name;

    SELECT t1.emp_name, t1.hire_date, t2.dept_name FROM employees AS t1 CROSS JOIN departments AS t2;

# ADVANCE

    VIEW - It is a virtual table based on a result set of a database query.
    STORED PROCEDURE - It is a procedure stored in database which can be called using CALL statement. Stored procedure does not return a value.
    STORED FUNCTION - It is like function calls which can contain logic. It returns a single value and can be called from another statement.
    TRIGGER - Trigger is program which is associated with a database table which can be invoked before/after insert, delete or update operations.
    EVENT - Event is used to run a program or set of commands at defined schedule.

    CREATE VIEW user_lat_long AS SELECT name, latitude, longitude FROM users WHERE status = 'active';
    
    SELECT * FROM user_lat_long;

    ------------------------

    1. Stored procedure param and return.
    2. Stored procedure IF ELSE, DO WHILE, TRY CATCH, Call another Stored procedure
    1. Event-drive workflows through the sql stored procedure.  

    ------------------------
    - ACID Properties in DBMS
    - What is database sharding?
    

