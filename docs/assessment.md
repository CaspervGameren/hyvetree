# Assessment walkthrough

## Suggested five-minute demonstration

1. Register a regular user, then show that the profile belongs to that session. Edit the name/email and show validation errors.
2. Create three private projects. Demonstrate that an earlier publishing attempt fails, then publish using the management list button.
3. Search title/summary and combine the query with the status dropdown. Open another user's public project and like it; show the separate liked list.
4. Explain why another user's edit URL returns 403. Hiding the Edit button is only presentation: ProjectPolicy enforces ownership on the server.
5. With an admin session, show the separate all-projects table. Explain role middleware, moderation privileges and owner-only content editing.

Practise these steps and explain the code in your own words. These changes were made with coding assistance; the commit dates record when they were actually made.

## Where the requirements live

| Requirement | Implementation |
| --- | --- |
| Login/session boundary | routes/web.php, routes/Auth/web.php and existing auth controllers |
| Admin-only area | EnsureUserIsAdmin and Admin/ProjectController |
| Item ownership | ProjectPolicy and Gate checks in ProjectController |
| Own profile | ProfileController and pages/profile views |
| Multiple-column search + dropdown | ProjectController filters/filtered methods and projects/partials/filters |
| POST list toggle | projects.visibility route and toggleVisibility action |
| Deeper validation | checkPublication uses owner->projects()->count(), with no persisted counter; admins are exempt |
| Many-to-many likes | Project/User relationships and project_user migration |
| Server validation | validateProject, profile update and registration validation |
| Feedback | components/feedback and old form values |

## Security choices to explain

- Broken access control: auth middleware establishes the session; admin middleware checks roles; policies check individual records. Receiving a project ID does not grant permission.
- Injection: Eloquent binds search input as query values. Blade's escaped output renders user text as text instead of executable markup. Keep using escaped output for project descriptions.
- Request forgery: state-changing forms include CSRF tokens and use POST/PATCH/DELETE. GET requests do not toggle visibility.
- Mass assignment: controllers pass validated fields; the owner comes from the session relationship. Neither a submitted user_id nor a role field can assign ownership or admin rights.
- Credentials/session: passwords are hashed; login/registration regenerate the session; logout invalidates it. Authentication submissions are rate limited.

These are examples of safeguards, not a claim of a full security audit.

## OTAP and deployment preparation

Development, Testing, Acceptance and Production should have separate configuration and databases. The automated tests use a temporary in-memory database, not the development database. Acceptance should exercise the same build and migrations intended for Production using non-production data.

This work has not deployed a production server. Before deployment:

1. Use a supported PHP runtime and extensions matching composer.lock. Install locked production dependencies with `composer install --no-dev --optimize-autoloader`; build assets with `npm ci` and `npm run build` in the build environment.
2. Serve only the `public` directory over HTTPS. Permit writes to storage and bootstrap/cache; keep source configuration and `.env` outside the document root.
3. Configure the production `.env`: APP_ENV=production, APP_DEBUG=false, APP_URL, database and session settings. Keep secrets out of Git, use secure cookies over HTTPS and preserve APP_KEY between releases.
4. Back up the production database before applying pending migrations with `php artisan migrate --force`. Seed the required roles deliberately; the local admin seeder refuses production. Provision production admin access through an appropriate controlled process.
5. Cache production configuration/views/routes using `php artisan optimize`. Access environment variables through configuration so cached configuration works correctly.
6. Check registration/login/logout, validation, owner/admin boundaries, search, likes and publishing on Acceptance. Smoke-test Production after release. Monitor errors and plan rollback of code and database changes; a code rollback does not automatically undo a migration.

A ZIP of the source is not a deployed application. Brightspace submission and any Git push remain separate actions.
