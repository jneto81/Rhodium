Rhodium MVC
=============

Installation
-------------

1. git clone https://github.com/EwanValentine/Rhodium.git
2. cd Rhodium
3. composer install
4. sudo chmod -R 777 app/cache
5. sudo chmod -R 777 app/log
6. Open app/Rhodium/Database/DatabaseConfig.php enter your database details

I think that's it...

* * *

Leverage the command line!
-------------

php app/c

Followed by a command:

+   r:c:c BundleName:ControllerName (Create a controller)
+   r:c:m BundleName:Model			(Create a model)
+   r:c:b BundleName:MainClassName  (Create a bundle)
+   r:a:r route_name path/name BundleName ClassName functionName "GET|POST" (Create a route)
+	r:c:v BundleName:view_name		(Create a view)
+	r:c:t TableName title:varchar:225 (Create a database table)
