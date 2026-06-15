<?php

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
