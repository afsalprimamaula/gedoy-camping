<?php

// ── DEBUG ENVIRONMENT ────────────────────────────────────────────────────────
if (isset($_GET['debug_env'])) {
    header('Content-Type: text/plain');
    echo "=== ENVIRONMENT VARIABLES ===\n";
    foreach (array_merge($_ENV, getenv()) as $key => $value) {
        // Obfuscate sensitive credentials
        if (stripos($key, 'password') !== false || stripos($key, 'key') !== false) {
            $value = substr($value, 0, 3) . '...';
        }
        echo "$key: $value\n";
    }
    
    echo "\n=== DATABASE CONNECTION TEST ===\n";
    try {
        $host = getenv('DB_HOST') ?: $_ENV['DB_HOST'] ?? null;
        $port = getenv('DB_PORT') ?: $_ENV['DB_PORT'] ?? null;
        $db   = getenv('DB_DATABASE') ?: $_ENV['DB_DATABASE'] ?? null;
        $user = getenv('DB_USERNAME') ?: $_ENV['DB_USERNAME'] ?? null;
        $pass = getenv('DB_PASSWORD') ?: $_ENV['DB_PASSWORD'] ?? null;
        $ssl  = getenv('DB_SSLMODE') ?: $_ENV['DB_SSLMODE'] ?? null;
        
        echo "Host: $host\n";
        echo "Port: $port\n";
        echo "Database: $db\n";
        echo "Username: $user\n";
        echo "SSL Mode: $ssl\n";
        
        $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=$ssl";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        echo "CONNECTION SUCCESSFUL!\n";
    } catch (Exception $e) {
        echo "CONNECTION FAILED: " . $e->getMessage() . "\n";
    }
    exit;
}

/**
 * Vercel Serverless Entry Point for Laravel (Gedoy Camping Park)
 *
 * CRITICAL: Vercel runs on a READ-ONLY filesystem. The only writable
 * directory is /tmp. We MUST redirect all Laravel cache, view compilation,
 * and bootstrap files there BEFORE the framework boots up.
 *
 * Without this, Laravel will crash with a 500 error trying to write
 * to storage/ or bootstrap/cache/ which are read-only on Vercel.
 */

// ── 1. REDIRECT ALL LARAVEL CACHES TO /tmp ───────────────────────────────────
// These MUST be set before Laravel bootstraps — order matters!

putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');

// ── 2. REDIRECT BLADE VIEW COMPILATION TO /tmp ───────────────────────────────
// Blade compiles .blade.php files into plain PHP. On Vercel, it cannot
// write to storage/framework/views/ — redirect to /tmp instead.
putenv('VIEW_COMPILED_PATH=/tmp');

// ── 3. FORCE SAFE DRIVERS FOR SERVERLESS ─────────────────────────────────────
// 'cookie' session driver stores data client-side — no server filesystem needed.
// 'array' cache driver stores in-memory — no Redis or database writes needed.
// 'stderr' log channel writes to Vercel's built-in log stream.
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');
putenv('LOG_CHANNEL=stderr');

// ── 4. PRODUCTION SAFETY FLAGS ────────────────────────────────────────────────
putenv('APP_ENV=production');
putenv('APP_DEBUG=false');

// ── 5. HAND OFF TO LARAVEL ────────────────────────────────────────────────────
// Now that the environment is configured for the read-only filesystem,
// we can safely boot the Laravel application.
require __DIR__ . '/../public/index.php';
