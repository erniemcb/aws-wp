#Various tools and scripts for cloud computing class
Set the environment variables at the top of ths script to use setupwp.sh script.

flaskui
=========
UI for rest client written in python.

Set your Project ID and Bucket Name in restapi.php. Install composer, and run `composer install`.
Use curl to send GET, PUT, POST, DELETE requests.
Example:
```
curl localhost/restapi.php/awolde/Aman -X POST
curl localhost/restapi.php/awolde/Amanu -X PUT
curl localhost/restapi.php/awolde -X GET
curl localhost/restapi.php/awolde -X DELETE
```

restdb.php
=============
You need to install php-mysql library and create a databse with tablename tbl_users in Mysql. Populate the mysql details towards the end of the code.
