@echo off
cd /d "%~dp0"
echo ================================================
echo   ABSENSI DIGITAL - Laravel 10
echo ================================================
echo.
echo Pastikan XAMPP MySQL sudah ON.
echo.
php artisan serve --host=0.0.0.0
pause
