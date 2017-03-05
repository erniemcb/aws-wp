#Various tools and scripts for cloud computing class
Set the environment variables at the top of ths script to use setupwp.sh script.

Set your Project ID and Bucket Name in restapi.php. Install composer, and run `composer install`.
Use curl to send GET, PUT, POST, DELETE requests.
Example:
```
curl localhost/restapi.php/awolde/Aman -X POST
curl localhost/restapi.php/awolde/Amanu -X PUT
curl localhost/restapi.php/awolde -X GET
curl localhost/restapi.php/awolde -X DELETE
```
