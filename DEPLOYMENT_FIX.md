# Admin Panel Deployment Fix

## Problem
The admin panel shows 404 error at https://job.codeapka.com/admin because the admin directory and files are not deployed to the production server.

## Solution

### 1. Upload Required Files
Upload the entire `admin` directory to your production server. The directory should contain:

```
admin/
├── .htaccess
├── config.php
├── dashboard.php
├── index.php
├── login.php
├── logout.php
├── diagnosis.php
├── layouts/
│   ├── header.php
│   ├── sidebar.php
│   └── footer.php
├── pages/
│   ├── jobs-add.php
│   └── jobs-list.php
└── assets/
```

### 2. Upload Root Files
Also upload these root directory files:
- `.htaccess` (with proper rewrite rules)
- `admin.php` (fallback redirect)

### 3. Database Setup
Ensure the database is properly set up with admin user:
- Username: admin
- Password: admin123

### 4. File Permissions
Set proper permissions:
```bash
chmod 755 admin/
chmod 644 admin/*.php
chmod 666 database/sarkariresult.db
```

### 5. Verification
After upload, test these URLs:
- https://job.codeapka.com/admin/ (should redirect to login)
- https://job.codeapka.com/admin/login.php (should show login form)
- https://job.codeapka.com/admin/diagnosis.php (should show system info)

## Files to Upload Immediately

1. **admin/** directory (entire folder)
2. **Root .htaccess** (updated with admin routing)
3. **admin.php** (fallback redirect)
4. **includes/environment.php** (auto-configuration)

## Login Credentials
- Username: `admin`
- Password: `admin123`

The admin panel will be accessible at https://job.codeapka.com/admin once the files are uploaded.
