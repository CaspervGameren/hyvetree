# Hyvetree

Laravel 13 project workspace with Blade, Tailwind, session authentication and user/admin roles.

## Local setup

Use PHP 8.4+, Composer, Node 22.12+ and SQLite (PDO SQLite enabled). Install the locked dependencies:

```sh
composer install
npm ci
```

For a **new checkout**, copy `.env.example` to `.env`, create `database/database.sqlite`, configure the database connection and run:

```sh
php artisan key:generate
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Use `npm run dev` while changing frontend assets. Existing installations should keep their `.env`, application key and database; run only pending migrations. Never use `migrate:fresh` against data you want to keep.

The local/testing database seeder creates `admin` and `user` roles and a local admin (`admin@hyvetree.test`). A generated password is displayed only on first creation. Running the seeder again preserves the existing password. No production admin account is automatically created. Registration requires the role seeder to have run.

## Behaviour

- Signed-in users discover public projects and their own private projects on `/projects`.
- Search matches title or summary and combines with the status dropdown.
- Only a project's owner can edit its content, including through direct URLs.
- `/projects/manage` lists your projects and a separate list of liked public projects.
- `/admin/projects` is an admin-only table of every project. Admins can inspect, change visibility and delete other projects, but content editing stays with the owner.
- Visibility changes and likes use POST actions with CSRF protection. Deletion asks for confirmation in the view.
- Publishing requires at least three existing projects for the owner. This is checked using an Eloquent count query on the server for creation, editing and the list toggle. Start by saving three private projects. Admin visibility changes follow the same owner's eligibility rule.
- Profile show/edit/update always uses the authenticated user; IDs and roles submitted in a form cannot select another account.
- Slugs are generated once from the title with a unique suffix and remain stable when the title changes. Resource URLs currently use project IDs.

## Checks

```sh
php artisan test
vendor/bin/pint --test
npm run build
```

Feature tests use an isolated in-memory SQLite database. They cover ownership, admin permissions, privacy, search/filter combinations, publication eligibility, likes, validation, profiles, registration and logout.

See [assessment notes](docs/assessment.md) for an explanation and deployment preparation. Chat and translations are visibly disabled placeholders. Password recovery and email verification are not implemented flows. The theme animation uses JavaScript, while access controls and validation run on the server.

## Submission

Upload the source ZIP to the Brightspace assignment and click **Indienen** to finish. The assignment deadline is 1 November 2026, 23:59 Europe/Amsterdam. A production deployment is an alternative way to demonstrate the OTAP criterion; it is not a prerequisite for the ZIP submission.

The ZIP includes source, locked dependencies metadata, migrations, seeders, tests, documentation and compiled frontend assets. It excludes `.env`, the local database, credentials, logs, `.git`, `vendor` and `node_modules`. Install Composer dependencies and follow the setup instructions above. Included frontend assets allow the app to display without starting Vite; rebuild them after frontend changes.

Repository: https://github.com/CaspervGameren/hyvetree — current work is on the `development` branch. Git history remains available in the repository, not inside the source ZIP. Test-admin accounts in a local database are not included in the ZIP; run the local seeder to obtain a new generated admin password.
