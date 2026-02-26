@echo off
echo Starting Backend Server...
echo Backend API: http://localhost:8000
echo.
cd backend\public
php -S localhost:8000 router.php
