@echo off
cd\
cd C:\AppServ\www\cozto
git reset --hard
git pull https://github.com/aericknunez/cozto_encrypt.git

cd\
cd C:\AppServ\www\cozto\sync
call C:\AppServ\www\cozto\sync\sync_json.bat
exit