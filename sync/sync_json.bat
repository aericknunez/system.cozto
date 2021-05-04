@echo off
cd\
cd C:\AppServ\www\cozto\sync
C:\AppServ\php5\php.exe -f C:\AppServ\www\cozto\sync\get_json.php


cd\
cd C:\AppServ\www\cozto\sync\update
call C:\AppServ\www\cozto\sync\update\dbupdate.bat

exit