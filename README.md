# Hyvetree

Hyvetree is a project workspace where users can create projects, track their progress, discover public projects and save projects they like. Each user has a personal profile and a management page. Admins have a separate list of all projects for moderation.

Built with Laravel 13, PHP, Blade, Tailwind CSS and Vite. Authentication uses Laravel's session authentication. SQLite is the default local database; a separate database server is not required.

## Requirements

To run the submitted ZIP locally:

- PHP 8.4 or newer, with PDO SQLite enabled and the extensions required by Composer.
- Composer 2.
- A terminal and a browser.

To build or change frontend assets, also install Node.js 22.12 or newer and pnpm. The project has been checked with PHP 8.4.14, Node.js 24.7.0 and pnpm 12.3.4. Use the committed `pnpm-lock.yaml` when installing frontend dependencies.

The submission ZIP includes compiled frontend assets in `public/build`, so Node.js and pnpm are optional if you only want to run that ZIP. A GitHub checkout needs a frontend build.

## Run locally

### 1. Open the project

Extract the ZIP and open a terminal inside its `hyvetree` folder. This is the folder containing `artisan`, `composer.json` and this README.

Alternatively, clone the development branch:

```sh
git clone --branch development https://github.com/CaspervGameren/hyvetree.git
cd hyvetree
```

### 2. Create the local configuration and database

Run these commands from the project folder. They work in a terminal on Windows, macOS and Linux, and keep existing files intact:

```sh
php -r "file_exists('.env') || copy('.env.example', '.env');"
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
```

For a new installation, keep these settings in `.env`:

```dotenv
APP_NAME=Hyvetree
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
MAIL_MAILER=log
```

Leave `DB_DATABASE` unset to use `database/database.sqlite`. No MySQL credentials, mail server, Redis server or external service keys are required for the implemented features. Do not commit or share your `.env` file.

### 3. Install PHP dependencies

```sh
composer install
composer check-platform-reqs
```

Use `install`, which follows `composer.lock`. If Composer reports a missing PHP extension, enable that extension for the PHP executable used in your terminal before continuing.

### 4. Generate the application key

For a new installation only:

```sh
php artisan key:generate
```

Keep the existing key when updating an installation that already contains data.

### 5. Create the database tables and test admin

```sh
php artisan migrate
php artisan db:seed
```

This creates the tables, the `admin` and `user` roles and a local test admin account:

- **Email:** `admin@hyvetree.test`
- **Password:** a randomly generated password printed in the terminal during the first seed. Save it before closing the terminal.

Running the seeder again preserves the existing admin password. It does not print that password again. The admin seeder is restricted to the `local` and `testing` environments; it does not provision a production admin.

Regular test users can be created through the registration page after seeding. They automatically receive the `user` role.

### 6. Prepare the frontend

**Using the submitted ZIP:** skip this step if `public/build/manifest.json` is present. The compiled styles, scripts and application fonts are included.

**Using a GitHub checkout, or after changing frontend files:** run:

```sh
pnpm install --frozen-lockfile
pnpm run build
```

### 7. Start the application

```sh
php artisan serve
```

Open **http://127.0.0.1:8000** in your browser. Keep the terminal running while testing.

- Register a normal user at `/register`.
- Log in at `/login`.
- After logging in as the seeded admin, open `/admin/projects` or select **Admin** in the navigation.

Laravel Herd is also supported: serve the project folder through Herd and use its local URL instead. If necessary, update `APP_URL` in `.env` to that URL.

## What to try

| Page | Purpose |
| --- | --- |
| `/` | Public home page, or dashboard when signed in |
| `/projects` | Project cards, title/summary search and a status dropdown |
| `/projects/create` | Create a project |
| `/projects/manage` | Separate lists of your own projects and liked public projects |
| `/profile` | View your account information |
| `/profile/edit` | Edit your own name and email |
| `/admin/projects` | Admin-only table containing all projects |

Only the owner can edit a project's content, including when opening an edit URL directly. Admins can inspect all projects, change their visibility and delete them, but cannot edit another owner's content.

Regular users need **three existing projects before publishing**. Save three private projects first, then use the visibility switch in Manage. The server checks the actual related project count for every publishing action. Admins are exempt from this requirement.

Visibility changes and likes use POST forms with CSRF protection. Private projects are accessible to their owner and admins. A liked project disappears from the liked list if it becomes private. Slugs are generated automatically on creation and stay stable when the title changes; project URLs currently use IDs.

## Frontend development

For live frontend updates, leave `php artisan serve` running and use a second terminal:

```sh
pnpm run dev
```

Keep both processes running while developing. For a demonstration without the Vite development server, stop Vite and run `pnpm run build`.

## Tests and formatting

```sh
php artisan test
php vendor/bin/pint --test
```

The feature tests use a separate in-memory SQLite database. They cover registration, login/logout, profiles, ownership, admin permissions, privacy, search/filter combinations, validation, likes and publication eligibility. They do not use your local project database.

To check the frontend build:

```sh
pnpm run build
```

## Troubleshooting

| Problem | What to check |
| --- | --- |
| `vendor/autoload.php` is missing | Run `composer install` in the folder containing `composer.json`. |
| No application encryption key | For a new installation, run `php artisan key:generate`. |
| SQLite driver is missing | Enable PDO SQLite for your terminal's PHP installation. |
| Database file or tables are missing | Create `database/database.sqlite`, then run `php artisan migrate`. |
| Registration cannot find a role | Run `php artisan db:seed` with `APP_ENV=local`. |
| Vite manifest is missing | Run the frontend install and build commands in step 6. |
| Assets try to load from a stopped Vite server | Stop Vite, remove a leftover `public/hot` file if present, then run `pnpm run build`. |
| Changed configuration is not taking effect | Run `php artisan optimize:clear`, then restart the local server. |
| A regular user cannot publish | Create three private projects first. Admins can publish immediately. |
| Port 8000 is already in use | Run `php artisan serve --port=8001` and open the URL it prints. |

Do not use `migrate:fresh` on an existing database containing data you want to keep: it removes the tables and their contents. Updating an existing installation normally requires only pending migrations, not a new application key or a database reset.

## Current scope and submission

Chat and translations are disabled placeholders. Password recovery and email verification are not implemented flows. The light/dark theme and its animation use JavaScript; authentication, authorization and validation run on the server.

The submission ZIP contains source, dependency lockfiles, migrations, seeders, tests, documentation and compiled frontend assets. It excludes `.env`, local databases, account passwords, logs, `.git`, `vendor` and `node_modules`. Local test accounts are not bundled: the setup steps generate a separate admin account for the reviewer.

The current source and Git history are on the [development branch](https://github.com/CaspervGameren/hyvetree/tree/development). See [the assessment notes](docs/assessment.md) for a demonstration outline, implementation choices and OTAP/deployment preparation. This local setup does not deploy the application to a public server.

For the shared-hosting release procedure and MySQL configuration, see [InfinityFree deployment](docs/infinityfree.md).
