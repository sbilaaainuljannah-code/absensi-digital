@echo off
cd /d "%~dp0"
echo ============================================
echo  ABSENSI DIGITAL - CHECK PROJECT
 echo ============================================
php -v
php artisan route:list
if exist mobile\absensi_mobile\pubspec.yaml (
  cd mobile\absensi_mobile
  where flutter >nul 2>nul
  if errorlevel 1 (
    echo Flutter belum ada di PATH. Backend check tetap bisa dipakai.
  ) else (
    flutter pub get
    flutter analyze
  )
)
pause
