@echo off

cd C:\AppServ\www\cozto
git init
git reset --hard
git remote add master https://github.com/aericknunez/system.cozto.git
git pull https://github.com/aericknunez/system.cozto.git


exit