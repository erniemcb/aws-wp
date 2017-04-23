php-gcp
==========

Set your Project ID and Bucket Name in restapi.php. Install composer, and run `composer install`.
Use curl to send GET, PUT, POST, DELETE requests.

Example:
```
curl localhost/restapi.php/awolde/Aman -X POST
curl localhost/restapi.php/awolde/Amanu -X PUT
curl localhost/restapi.php/awolde -X GET
curl localhost/restapi.php/awolde -X DELETE
```

This will create a file inside a bucket you specified with the username.
