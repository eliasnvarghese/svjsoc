This is for log file generation Edit config.ini
---------------------------------------
; logfilepath=/home/buwlrdjjq1jo/public_html/cmsapp/logs
logfilepath=/Users/e0n00rh/Elias_Docs/git_workspace/svjsoc/cmsapp/logs


edit databaseconnection_class.php


import database values to local mysql
--------------------------------
mysql -u root ststephenchurchdb < ~/Downloads/ststephenchurchdb.sql


this seems ot be having some issues to run the application
--------------------------------------------------
docker run -d -p 80:80 --name my-apache-php-app -v "$PWD":/var/www/html php:7.2-apache

this seems to
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli php index.php