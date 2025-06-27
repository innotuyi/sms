@echo off
cd /d %~dp0
:loop
php artisan schedule:run
timeout /t 60 /nobreak
goto loop 