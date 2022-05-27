# menetrend - railway schedule
railway schedule database project (HU)

● Technologies, tools: PHP7, PL/SQL, HTML&CSS
 Docker, XAMPP, Oracle SQL Developer, Notepad++,
 To connect: [Oracle OCI8](https://www.php.net/manual/en/book.oci8.php)
 
● Description: The application manages railway schedule, purchases and
the data of employees. The functions of each role (e.g. customer, ticket
inspector, maintainer) can be accessed after logging in. For example,
ticket control is accessed by ticket inspector users.
All of the CRUD operations are accessible for almost all tables from the
application. There is a few complex query (e.g. how many tickets were
sold this month by ticket type). The relational database schemas are
satisfying 3.NF. Beside that the application has some logging
functionality using triggers , for example logins, logging of previous
ticket prices.

Here is what you need to start the project
1. In the sql_file directory there is example_start.sql file. It contains instructions for creating a database(Oracle) and it uploads the database with example datas.
(You can run the pl/sql code by using Oracle SQL Developer, what is free to download from oracle.com)
2. To connect the database and the php application, you have to change the code in the fuggvenyek.php 5. row.
Example: $conn = oci_connect('TEST3',       '123',          'Localhost/XE', 'AL32UTF8');  -> 
         $conn = oci_connect('MY_DB_USER',  'MY_PASSWORD',  'MY_CONNECTION', 'AL32UTF8');
3. Do the same change in the 9. row of the login.php file.
4. Now you can start the application. You can use Docker for run Oracle database and XAMPP for run the php.
