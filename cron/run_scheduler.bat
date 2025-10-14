@echo off
REM Lima Waktu Logistic - Database Cleanup Scheduler
REM Windows Batch File to run the scheduler
REM
REM Usage:
REM 1. Edit the PHP_PATH and SCRIPT_PATH variables below
REM 2. Double-click this file to run manually, or
REM 3. Use Windows Task Scheduler to run automatically

REM Configuration - UPDATE THESE PATHS
SET PHP_PATH=C:\php\php.exe
SET SCRIPT_PATH=C:\Users\MyBook Hype AMD\Herd\5waktu\cron\scheduler.php

REM Run the scheduler
echo Running Lima Waktu Database Cleanup Scheduler...
echo.

%PHP_PATH% %SCRIPT_PATH%

echo.
echo Scheduler completed. Check scheduler.log for details.
pause
