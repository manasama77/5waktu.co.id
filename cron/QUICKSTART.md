# Quick Start Guide - Database Cleanup Scheduler

## 🚀 Quick Setup (5 minutes)

### Step 1: Test Without Deleting

```bash
cd C:\Users\MyBook Hype AMD\Herd\5waktu\cron
php test_scheduler.php
```

This shows what **would** be deleted without actually deleting anything.

### Step 2: Run Manual Test

```bash
php scheduler.php
```

This actually performs the cleanup. Check `scheduler.log` for results.

### Step 3: Set Up Automatic Scheduling

#### Windows (Task Scheduler):

1. Double-click `run_scheduler.bat` (edit paths inside first)
2. Or use Task Scheduler:
   - Open Task Scheduler
   - Create Basic Task → "Lima Waktu Cleanup"
   - Schedule: Weekly, Sunday, 2:00 AM
   - Action: Start Program
   - Program: `C:\php\php.exe`
   - Arguments: `C:\Users\MyBook Hype AMD\Herd\5waktu\cron\scheduler.php`

#### Linux/cPanel:

```bash
crontab -e
```

Add this line:

```
0 2 * * 0 /usr/bin/php /path/to/5waktu/cron/scheduler.php
```

## ⚙️ Configuration

Edit `scheduler.php` to change how many years to keep:

```php
define('YEARS_TO_KEEP', 2); // Change to 3, 4, etc.
```

## 📊 What Gets Deleted?

### Task 1: Old Shipments

- **Table:** `tbl_pengiriman`
- **Criteria:** `do_print_date` older than 2 years
- **Example:** In 2025, deletes records before 2023-01-01

### Task 2: Orphaned Products

- **Table:** `temp_produk`
- **Criteria:** `random_id` not found in `tbl_pengiriman`
- **Purpose:** Clean up products from deleted shipments

## 📝 Check Results

View the log:

```bash
cat scheduler.log
# or on Windows:
type scheduler.log
```

## ⚠️ Important Notes

1. **Test First**: Always run `test_scheduler.php` before the actual deletion
2. **Backup**: Create a database backup before first run
3. **Check Logs**: Review `scheduler.log` after each run
4. **Adjust Timing**: Run during low-traffic hours (e.g., 2:00 AM)

## 🔧 Troubleshooting

**"Config not found"**

- Make sure `config.php` exists in parent directory

**"Database connection failed"**

- Check database credentials in `config.php`
- Ensure MySQL server is running

**"No records deleted"**

- This is normal if all data is recent
- Check log file for details

## 📁 Files

- `scheduler.php` - Main script
- `test_scheduler.php` - Test mode (no deletion)
- `run_scheduler.bat` - Windows helper
- `scheduler.log` - Log file (auto-created)
- `README.md` - Full documentation
- `QUICKSTART.md` - This file

## 🎯 Recommended Schedule

- **Small database** (<10,000 records): Monthly
- **Medium database** (10,000-100,000): Weekly
- **Large database** (>100,000): Daily

## 📞 Need Help?

1. Read `README.md` for full documentation
2. Check `scheduler.log` for error messages
3. Run `test_scheduler.php` to see what will happen
