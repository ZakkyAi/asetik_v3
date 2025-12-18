@echo off
echo ========================================
echo Laravel Performance Optimization Script
echo ========================================
echo.

echo [1/5] Clearing all caches...
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear
echo ✓ Caches cleared
echo.

echo [2/5] Caching configuration...
php artisan config:cache
echo ✓ Configuration cached
echo.

echo [3/5] Caching routes...
php artisan route:cache
echo ✓ Routes cached
echo.

echo [4/5] Optimizing autoloader...
composer dump-autoload -o
echo ✓ Autoloader optimized
echo.

echo [5/5] Running general optimization...
php artisan optimize
echo ✓ Optimization complete
echo.

echo ========================================
echo All optimizations completed successfully!
echo ========================================
echo.
echo Your Laravel application should now run faster.
echo.
echo Note: If you make changes to .env, routes, or config files,
echo you'll need to run this script again.
echo.
pause
