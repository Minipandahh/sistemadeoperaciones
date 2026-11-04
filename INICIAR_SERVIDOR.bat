@echo off
cd /d "%~dp0"
where php >nul 2>&1
if errorlevel 1 (
  echo PHP no esta instalado o no aparece en PATH.
  echo Instala PHP o XAMPP y consulta INSTRUCCIONES_WINDOWS.txt
  pause
  exit /b 1
)
echo Iniciando TransferOps en http://localhost:8000/vuelos.html
start "" "http://localhost:8000/vuelos.html"
php -S 127.0.0.1:8000
pause
