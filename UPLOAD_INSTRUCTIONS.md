# Production Server Setup Instructions

## 🚨 Current Issue: 404 Error on https://job.codeapka.com/admin

The 404 error indicates that either:
1. Files haven't been uploaded to the server yet
2. Files are in the wrong directory
3. Server configuration issues

## 📋 Step-by-Step Fix

### Step 1: Upload Diagnostic File
1. Upload `diagnostic.php` to your server root
2. Visit: https://job.codeapka.com/diagnostic.php
3. Check what's missing

### Step 2: Upload All Files
Upload these files/folders to your server:
```
/public_html/ (or your domain root)
├── index.php
├── admin/
│   ├── index.php
│   ├── login.php
│   ├── config.php
│   └── .htaccess
├── includes/
│   ├── config.php
│   └── environment.php
├── database/
│   └── sarkariresult.db
├── assets/
├── .htaccess
└── diagnostic.php
```

### Step 3: Set Permissions
Via SSH or cPanel File Manager:
```bash
chmod 755 admin/
chmod 755 database/
chmod 755 includes/
chmod 666 database/sarkariresult.db
chmod 644 .htaccess
chmod 644 admin/.htaccess
```

### Step 4: Test URLs
- Main site: https://job.codeapka.com
- Diagnostic: https://job.codeapka.com/diagnostic.php
- Admin: https://job.codeapka.com/admin

### Step 5: Common Issues & Solutions

**Issue: Still 404 after upload**
- Check if files are in the correct directory (usually public_html/)
- Verify .htaccess files are uploaded
- Check if mod_rewrite is enabled on server

**Issue: Database errors**
- Ensure database/ directory has write permissions
- Re-run database setup if needed

**Issue: Admin login not working**
- Default credentials: admin / admin123
- Check database has users table

## 🆘 Quick Fixes

If you're using cPanel:
1. Go to File Manager
2. Navigate to public_html/
3. Upload all project files there
4. Set permissions as mentioned above

If you're using FTP:
1. Connect to your server
2. Navigate to your domain's root directory
3. Upload all files maintaining the folder structure

## 📞 Next Steps

1. Upload diagnostic.php first
2. Visit https://job.codeapka.com/diagnostic.php
3. Follow the recommendations shown
4. Upload missing files
5. Test https://job.codeapka.com/admin again
