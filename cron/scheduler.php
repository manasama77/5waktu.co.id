<?php

/**
 * Lima Waktu Logistic - Database Cleanup Scheduler
 * 
 * This script runs as a cron job to automatically delete old records from:
 * 1. tbl_pengiriman - Records older than 2 years
 * 2. temp_produk - Orphaned records with no relation to tbl_pengiriman
 * 
 * PHP Version: 7.4
 * 
 * Usage: php scheduler.php
 * Cron (runs on the 1st day of every month at 02:00 AM):
 * 0 2 1 * * /usr/bin/php /path/to/scheduler.php
 ```
 */

// Configuration
define('LOG_FILE', __DIR__ . '/scheduler.log');
define('YEARS_TO_KEEP', 2); // Keep records from last 2 years

/**
 * Write log entry with timestamp
 */
function writeLog($message)
{
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$message}\n";
    file_put_contents(LOG_FILE, $logMessage, FILE_APPEND);
    echo $logMessage; // Also output to console
}

/**
 * Calculate cutoff date based on current year
 * Example: If current year is 2025, cutoff is 2023-01-01
 */
function getCutoffDate()
{
    $currentYear = (int)date('Y');
    $cutoffYear = $currentYear - YEARS_TO_KEEP;
    return $cutoffYear . '-01-01';
}

/**
 * Delete old records from tbl_pengiriman
 */
function deleteOldShipments($con)
{
    $cutoffDate = getCutoffDate();

    writeLog("Starting deletion of old shipments (before {$cutoffDate})...");

    try {
        // Count records to be deleted
        $countSql = "SELECT COUNT(*) as total FROM tbl_pengiriman WHERE do_print_date < '{$cutoffDate}'";
        $countResult = mysqli_query($con, $countSql);

        if (!$countResult) {
            throw new Exception("Count query failed: " . mysqli_error($con));
        }

        $countRow = mysqli_fetch_assoc($countResult);
        $totalToDelete = $countRow['total'];

        if ($totalToDelete == 0) {
            writeLog("No old shipment records found to delete.");
            return 0;
        }

        // Delete old records
        $deleteSql = "DELETE FROM tbl_pengiriman WHERE do_print_date < '{$cutoffDate}'";
        $deleteResult = mysqli_query($con, $deleteSql);

        if (!$deleteResult) {
            throw new Exception("Delete query failed: " . mysqli_error($con));
        }

        $deletedRows = mysqli_affected_rows($con);
        writeLog("Successfully deleted {$deletedRows} old shipment records.");

        return $deletedRows;
    } catch (Exception $e) {
        writeLog("ERROR in deleteOldShipments: " . $e->getMessage());
        return 0;
    }
}

/**
 * Delete orphaned records from temp_produk
 * (Records where random_id doesn't exist in tbl_pengiriman)
 */
function deleteOrphanedProducts($con)
{
    writeLog("Starting deletion of orphaned product records...");

    try {
        // Count orphaned records
        $countSql = "SELECT COUNT(*) as total 
                     FROM temp_produk tp
                     LEFT JOIN tbl_pengiriman p ON tp.random_id = p.random_id
                     WHERE p.random_id IS NULL";
        $countResult = mysqli_query($con, $countSql);

        if (!$countResult) {
            throw new Exception("Count query failed: " . mysqli_error($con));
        }

        $countRow = mysqli_fetch_assoc($countResult);
        $totalToDelete = $countRow['total'];

        if ($totalToDelete == 0) {
            writeLog("No orphaned product records found to delete.");
            return 0;
        }

        // Delete orphaned records using LEFT JOIN (faster than NOT IN)
        $deleteSql = "DELETE tp
                      FROM temp_produk tp
                      LEFT JOIN tbl_pengiriman p ON tp.random_id = p.random_id
                      WHERE p.random_id IS NULL";
        $deleteResult = mysqli_query($con, $deleteSql);

        if (!$deleteResult) {
            throw new Exception("Delete query failed: " . mysqli_error($con));
        }

        $deletedRows = mysqli_affected_rows($con);
        writeLog("Successfully deleted {$deletedRows} orphaned product records.");

        return $deletedRows;
    } catch (Exception $e) {
        writeLog("ERROR in deleteOrphanedProducts: " . $e->getMessage());
        return 0;
    }
}

/**
 * Main execution
 */
function main()
{
    writeLog("=== Scheduler Started ===");

    // Include database configuration
    $configPath = dirname(__DIR__) . '/config.php';

    if (!file_exists($configPath)) {
        writeLog("FATAL ERROR: config.php not found at {$configPath}");
        exit(1);
    }

    require_once $configPath;

    // Check database connection
    if (!$con || mysqli_connect_errno()) {
        writeLog("FATAL ERROR: Database connection failed - " . mysqli_connect_error());
        exit(1);
    }

    writeLog("Database connection established successfully.");

    // Task 1: Delete old shipments
    $shipmentsDeleted = deleteOldShipments($con);

    // Task 2: Delete orphaned products
    $productsDeleted = deleteOrphanedProducts($con);

    // Summary
    writeLog("=== Scheduler Completed ===");
    writeLog("Summary: Deleted {$shipmentsDeleted} shipments and {$productsDeleted} orphaned products.");

    // Close database connection
    mysqli_close($con);

    writeLog("Database connection closed.");
    writeLog("");
}

// Run the scheduler
main();
