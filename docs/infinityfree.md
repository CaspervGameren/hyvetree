# InfinityFree deployment

InfinityFree free hosting provides PHP and MySQL, but no SSH/terminal for Composer or Artisan. The application is built locally and uploaded over encrypted FTP. Database SQL is imported through the hosting panel's phpMyAdmin. This is a separate production database; never upload the development SQLite database or copy local accounts into it.

## Release preparation

1. Use the reviewed `main` commit. Install PHP dependencies in an isolated release directory with `composer install --no-dev`, then build frontend assets using the committed pnpm lockfile. Keep development dependencies and node_modules off the server.
2. Use `deploy/infinityfree.env.example` as the production `.env`. Set a new application key and the actual domain and MySQL details from the panel. Preserve the production key and database on subsequent releases. Production must use HTTPS with secure session cookies and debug disabled.
3. Use file sessions/cache and a synchronous queue. No Redis, background worker or scheduled job is required by the implemented features. Mail is logged; password recovery/email verification are not implemented flows.
4. Put `deploy/infinityfree.htaccess` at `htdocs/.htaccess` and keep Laravel's `public/.htaccess`. Upload the application under `htdocs`. Upload private-file protection before `.env` or other private files. Never place database exports or credential notes in the document root.
5. Keep storage/framework/cache/data, storage/framework/views, storage/framework/sessions, storage/logs and bootstrap/cache present and writable by PHP. Do not upload cached local configuration or compiled views. Do not use permissions of 777 as a default.

## Database setup

Run and test migrations against a separate empty local MySQL database and export its SQL, or compile the migration SQL for MySQL and verify the import against the live server. Import through phpMyAdmin into the intended empty hosting database. Include roles and the migration repository entries only when the corresponding schema operations have succeeded. Provision a separate production administrator using a hashed password through a controlled database setup step. The local AdminUserSeeder intentionally refuses to run in production.

The initial InfinityFree import exposed a server default of **MyISAM** and an index-length error. Hyvetree explicitly selects **InnoDB** for MySQL/MariaDB migrations; the deployment schema uses InnoDB with dynamic row format. This supports the indexed UTF-8 columns, transactions and foreign-key relationships used by the application. SQLite tests alone do not establish MySQL compatibility.

The import is SQL executed on the live server, not a remote execution of `php artisan migrate`. The `migrations` table records the schema version, so future migrations must not recreate existing tables. Check all migration records, engines, indexes and foreign keys after importing. Back up production before later schema changes.

## Release verification

Check HTTPS, home/login/register, admin login, project creation/editing, search, profile and logout. Check a normal account cannot open the admin area or edit another owner's project. Request `/.env`, `/storage/logs/laravel.log`, `/composer.json`, and `/vendor/composer/installed.json` in a browser and confirm access is refused. InfinityFree may return a browser JavaScript challenge to command-line HTTP clients; a 200 challenge response does not prove the Laravel application or a protected path works.

Use phpMyAdmin to show live projects, users, roles, role_user, project_user and the migrations table during the assessment. Do not display database passwords, application keys or password hashes unnecessarily.
