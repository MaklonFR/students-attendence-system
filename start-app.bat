@echo off
echo ========================================
echo   Aplikasi Absensi SMP
echo ========================================
echo.
echo Starting servers...
echo.
echo Backend API: http://localhost:8000
echo Frontend: http://localhost:3000
echo.
echo Press Ctrl+C to stop servers
echo ========================================
echo.

start "Backend Server" cmd /k "cd backend\public && php -S localhost:8000 router.php"
timeout /t 2 /nobreak >nul
start "Frontend Server" cmd /k "cd frontend && php -S localhost:3000"

echo.
echo Servers started!
echo Open browser: http://localhost:3000
echo.
pause
