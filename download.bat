@echo off
cd\
cd C:\AppServ\www\cozto
git reset --hard
git pull https://github.com/aericknunez/system.cozto.git

cd\
cd C:\AppServ\www\cozto\sync
call C:\AppServ\www\cozto\sync\sync_json.bat


cd\
cd C:\AppServ\www\cozto\sync\update
call C:\AppServ\www\cozto\sync\update\dbupdate.bat

exit