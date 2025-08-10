# Deploying to https://job.codeapka.com/

Follow these steps to run the app on a live server:

1) PHP requirements
- PHP 8.1+ with extensions: intl, mbstring, json, curl
- Web server: Apache (with mod_rewrite) or Nginx

2) Point web root to /public
- Best: Set the vhost/hosting document root to the project's `public/` folder.
- If you cannot change the document root, keep the root `.htaccess` (added) which forwards all requests to `/public`.

3) Configure environment (.env)
- Copy `.env.production` to `.env` on the server.
- Edit database credentials in `.env` (MySQL recommended):
  - database.default.hostname, database, username, password
- Ensure:
  - `CI_ENVIRONMENT = production`
  - `app.baseURL = 'https://job.codeapka.com/'`
  - `app.indexPage = ''` (hides index.php from URLs)
  - `app.forceGlobalSecureRequests = true` (forces HTTPS)
- If behind a reverse proxy/CDN (e.g., Cloudflare), add allowed hostnames and proxy IPs as needed:
  - app.allowedHostnames[] = 'job.codeapka.com'
  - app.proxyIPs[] = '0.0.0.0/0'  # or a specific CIDR list from your provider

4) Writable permissions
- Ensure the `writable/` directory (and its subfolders: cache, logs, session) is writable by the web server user.

5) Database migrations & seeds
- From the project root on the server:
  - Run `php spark migrate --all`
  - Optionally `php spark db:seed UserSeeder` to create the default admin user (admin / admin123). Change the password after login.

6) Apache-only tips
- If the site is under a subfolder (e.g., /app/), edit `public/.htaccess` and set `RewriteBase /app/`.
- To force HTTPS at Apache layer, you can add to `public/.htaccess`:
  - RewriteCond %{HTTPS} !=on
  - RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]

7) Nginx sample configuration
- Set `root /path/to/project/public;`
- Pass PHP to FPM and rewrite all to `/index.php`.

8) Verify
- Visit https://job.codeapka.com/
- Login at /login (admin/admin123 by default) and check /admin.

Troubleshooting
- 404 for all routes: Ensure mod_rewrite is enabled and the site is pointed to `public/` or the root `.htaccess` is present.
- Mixed content or redirect loops behind a proxy: Ensure `app.forceGlobalSecureRequests = true` and set `app.allowedHostnames[]` and `app.proxyIPs[]`.
- Session issues: Ensure `writable/session` is writable.
