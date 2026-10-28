@echo off
cd /d "%~dp0"
echo Reset database dan isi data demo...
php artisan migrate:fresh --seed
pause
