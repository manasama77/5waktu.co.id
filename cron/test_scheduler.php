<?php

/**
 * Lima Waktu Logistic - Scheduler Test Script
 * 
 * This script simulates the scheduler without actually deleting records.
 * Use this to test what would be deleted before running the actual scheduler.
 * 
 * Usage: php test_scheduler.php
 */

// Configuration
define('YEARS_TO_KEEP', 2);

function getCutoffDate()
{
    $currentYear = (int)date('Y');
    $cutoffYear = $currentYear - YEARS_TO_KEEP;
    return $cutoffYear . '-01-01';
}

// Include database configuration
$configPath = dirname(__DIR__) . '/config.php';

if (!file_exists($configPath)) {
    die("ERROR: config.php not found at {$configPath}\n");
}

require_once $configPath;

// Check database connection
if (!$con || mysqli_connect_errno()) {
    die("ERROR: Database connection failed - " . mysqli_connect_error() . "\n");
}

echo "=== SCHEDULER TEST MODE (NO DELETIONS WILL OCCUR) ===\n\n";
echo "Database: Connected successfully\n";
echo "Current Date: " . date('Y-m-d H:i:s') . "\n";
echo "Retention Policy: Keep last " . YEARS_TO_KEEP . " years\n";
echo "Cutoff Date: " . getCutoffDate() . "\n\n";

// Test 1: Count old shipments
echo "--- Task 1: Old Shipments ---\n";
$cutoffDate = getCutoffDate();
$countSql = "SELECT COUNT(*) as total FROM tbl_pengiriman WHERE do_print_date < '{$cutoffDate}'";
$countResult = mysqli_query($con, $countSql);

if ($countResult) {
    $countRow = mysqli_fetch_assoc($countResult);
    $totalShipments = $countRow['total'];
    echo "Records to be deleted: {$totalShipments}\n";

    if ($totalShipments > 0) {
        // Show sample of records that would be deleted
        $sampleSql = "SELECT id_pengiriman, do_num, do_print_date, nama_gudang 
                      FROM tbl_pengiriman 
                      WHERE do_print_date < '{$cutoffDate}' 
                      ORDER BY do_print_date ASC 
                      LIMIT 5";
        $sampleResult = mysqli_query($con, $sampleSql);

        echo "\nSample records (first 5):\n";
        echo str_repeat("-", 80) . "\n";
        printf("%-15s %-20s %-15s %s\n", "ID", "DO Number", "Date", "Warehouse");
        echo str_repeat("-", 80) . "\n";

        while ($row = mysqli_fetch_assoc($sampleResult)) {
            printf(
                "%-15s %-20s %-15s %s\n",
                $row['id_pengiriman'],
                $row['do_num'],
                $row['do_print_date'],
                $row['nama_gudang']
            );
        }
        echo str_repeat("-", 80) . "\n";
    }
} else {
    echo "ERROR: " . mysqli_error($con) . "\n";
}

echo "\n";

// Test 2: Count orphaned products
echo "--- Task 2: Orphaned Products ---\n";
$countSql = "SELECT COUNT(*) as total 
             FROM temp_produk tp
             LEFT JOIN tbl_pengiriman p ON tp.random_id = p.random_id
             WHERE p.random_id IS NULL";
$countResult = mysqli_query($con, $countSql);

if ($countResult) {
    $countRow = mysqli_fetch_assoc($countResult);
    $totalProducts = $countRow['total'];
    echo "Records to be deleted: {$totalProducts}\n";

    if ($totalProducts > 0) {
        // Show sample of orphaned records
        $sampleSql = "SELECT tp.id_temp_produk, tp.random_id, tp.id_produk_katalog, tp.quantity
                      FROM temp_produk tp
                      LEFT JOIN tbl_pengiriman p ON tp.random_id = p.random_id
                      WHERE p.random_id IS NULL
                      LIMIT 5";
        $sampleResult = mysqli_query($con, $sampleSql);

        echo "\nSample records (first 5):\n";
        echo str_repeat("-", 80) . "\n";
        printf("%-15s %-15s %-20s %s\n", "ID", "Random ID", "Product ID", "Quantity");
        echo str_repeat("-", 80) . "\n";

        while ($row = mysqli_fetch_assoc($sampleResult)) {
            printf(
                "%-15s %-15s %-20s %s\n",
                $row['id_temp_produk'],
                $row['random_id'],
                $row['id_produk_katalog'],
                $row['quantity']
            );
        }
        echo str_repeat("-", 80) . "\n";
    }
} else {
    echo "ERROR: " . mysqli_error($con) . "\n";
}

echo "\n";

// Summary
echo "=== SUMMARY ===\n";
echo "Total shipments to be deleted: " . ($totalShipments ?? 0) . "\n";
echo "Total orphaned products to be deleted: " . ($totalProducts ?? 0) . "\n";
echo "\n";

if (($totalShipments ?? 0) > 0 || ($totalProducts ?? 0) > 0) {
    echo "To execute the actual deletion, run:\n";
    echo "  php scheduler.php\n\n";
    echo "WARNING: This will permanently delete the records shown above!\n";
} else {
    echo "No records need to be deleted at this time.\n";
}

// Close database connection
mysqli_close($con);
echo "\nDatabase connection closed.\n";
