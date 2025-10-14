# Database Cleanup Scheduler

This directory contains the automated database cleanup scheduler for Lima Waktu Logistic Application.

## Overview

The scheduler automatically performs two cleanup tasks:

1. **Delete Old Shipments**: Removes records from `tbl_pengiriman` older than 2 years
2. **Delete Orphaned Products**: Removes records from `temp_produk` that no longer have a relation to `tbl_pengiriman`

## Files

- `scheduler.php` - Main scheduler script
- `scheduler.log` - Log file (created automatically)
- `README.md` - This file

## Configuration

### Years to Keep

By default, the script keeps records from the last 2 years. You can adjust this in `scheduler.php`:

```php
define('YEARS_TO_KEEP', 2); // Change this number
```

### Examples:

- Current year: 2025 → Deletes records before 2023-01-01
- Current year: 2026 → Deletes records before 2024-01-01
- Current year: 2027 → Deletes records before 2025-01-01

## Manual Execution

To run the scheduler manually:

```bash
# Navigate to the cron directory
cd /path/to/5waktu/cron

# Run the script
php scheduler.php
```

## Cron Job Setup

### Linux/Unix

1. Open crontab editor:

```bash
crontab -e
```

2. Add one of these lines:

**Option 1: Run every Sunday at 2:00 AM**

```bash
0 2 * * 0 /usr/bin/php /path/to/5waktu/cron/scheduler.php
```

**Option 2: Run on the 1st day of each month at 3:00 AM**

```bash
0 3 1 * * /usr/bin/php /path/to/5waktu/cron/scheduler.php
```

**Option 3: Run every day at 1:00 AM**

```bash
0 1 * * * /usr/bin/php /path/to/5waktu/cron/scheduler.php
```

3. Save and exit

### Windows Task Scheduler

1. Open Task Scheduler
2. Click "Create Basic Task"
3. Name: "Lima Waktu DB Cleanup"
4. Trigger: Choose your schedule (e.g., Weekly, Sunday, 2:00 AM)
5. Action: Start a program
6. Program/script: `C:\php\php.exe` (or your PHP path)
7. Add arguments: `C:\path\to\5waktu\cron\scheduler.php`
8. Finish

### cPanel / Web Hosting

1. Go to cPanel → Cron Jobs
2. Add New Cron Job:
   - Common Settings: Once Per Week
   - Command: `/usr/bin/php /home/username/public_html/5waktu/cron/scheduler.php`
3. Save

## Logging

The scheduler writes detailed logs to `scheduler.log`. Each run includes:

- Timestamp
- Number of records counted before deletion
- Number of records actually deleted
- Any errors encountered
- Summary of the cleanup operation

### Example Log Output:

```
[2025-10-14 02:00:01] === Scheduler Started ===
[2025-10-14 02:00:01] Database connection established successfully.
[2025-10-14 02:00:01] Starting deletion of old shipments (before 2023-01-01)...
[2025-10-14 02:00:02] Successfully deleted 1250 old shipment records.
[2025-10-14 02:00:02] Starting deletion of orphaned product records...
[2025-10-14 02:00:03] Successfully deleted 3420 orphaned product records.
[2025-10-14 02:00:03] === Scheduler Completed ===
[2025-10-14 02:00:03] Summary: Deleted 1250 shipments and 3420 orphaned products.
[2025-10-14 02:00:03] Database connection closed.
```

## Testing

Before setting up the cron job, test the script manually:

```bash
# Navigate to cron directory
cd /path/to/5waktu/cron

# Run the script
php scheduler.php

# Check the log file
cat scheduler.log
```

## Troubleshooting

### Permission Denied

```bash
chmod +x scheduler.php
chmod 644 scheduler.log
```

### PHP Not Found

Find your PHP path:

```bash
which php
# or
whereis php
```

Then use the full path in your cron job.

### Database Connection Failed

- Verify `config.php` is in the parent directory
- Check database credentials in `config.php`
- Ensure database server is running

### No Records Deleted

This is normal if:

- All records are within the retention period (last 2 years)
- No orphaned products exist

Check the log file for details.

## Safety Features

1. **Count Before Delete**: The script counts records before deleting them
2. **Error Handling**: All database operations are wrapped in try-catch blocks
3. **Logging**: Every action is logged with timestamps
4. **Safe Date Calculation**: Uses PHP's date functions for accurate calculations
5. **Connection Validation**: Checks database connection before executing queries

## Performance

- **Deletion Method**: Uses optimized LEFT JOIN for orphaned products (faster than NOT IN)
- **Indexes**: For better performance, add these indexes:
  ```sql
  ALTER TABLE temp_produk ADD INDEX idx_random_id (random_id(32));
  ALTER TABLE tbl_pengiriman ADD INDEX idx_random_id (random_id(32));
  ALTER TABLE tbl_pengiriman ADD INDEX idx_do_print_date (do_print_date);
  ```

## Customization

### Change Cutoff Date Logic

Edit the `getCutoffDate()` function in `scheduler.php`:

```php
function getCutoffDate() {
    // Example: Keep last 3 years instead of 2
    $currentYear = (int)date('Y');
    $cutoffYear = $currentYear - 3; // Changed from 2 to 3
    return $cutoffYear . '-01-01';
}
```

### Add More Cleanup Tasks

Add new functions following the same pattern:

```php
function deleteAnotherTable($con) {
    writeLog("Starting deletion from another_table...");
    // Your deletion logic here
}

// Then call it in main():
function main() {
    // ...existing code...
    $anotherDeleted = deleteAnotherTable($con);
    // ...
}
```

## Maintenance

### Regular Checks

- Monitor log file size (rotate if needed)
- Review log entries after each run
- Adjust retention period if needed

### Log Rotation

To prevent the log file from growing too large:

```bash
# Linux/Unix - create a logrotate config
# /etc/logrotate.d/limawaktu
/path/to/5waktu/cron/scheduler.log {
    weekly
    rotate 4
    compress
    missingok
    notifempty
}
```

## Support

For issues or questions:

- Check the log file first (`scheduler.log`)
- Review the troubleshooting section above
- Ensure PHP 7.4+ is installed
- Verify database connection and credentials

## Version History

- **v1.0** (2025-10-14): Initial release
  - Delete old shipments (2+ years old)
  - Delete orphaned products
  - Comprehensive logging
  - Error handling
