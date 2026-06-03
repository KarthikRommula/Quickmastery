# Quick Mastery

> Your one-stop destination for simplifying BTech studies and accelerating your learning journey.

Quick Mastery is a study-resource web application aimed at first-year BTech students. It organizes course materials (notes, downloadable PDFs and curated YouTube videos) by subject and module, behind a simple username/password login. The interface lets students browse a catalogue of subjects, search across them with live suggestions, and drill into module-based learning materials.

> Note: This is a learning/portfolio project. The login mechanism is intentionally simple and is **not** production-hardened (see [Security notes](#security-notes)).

## Features

- **Subject catalogue** — A home page listing first-year BTech subjects (C Programming, Mathematics-1 & 2, Basic Electrical Engineering, Engineering Graphics, Physics, Chemistry, English, Python), each with a short description and a "Learn more" link.
- **Module-based materials** — Subject pages (e.g. C Programming) break content into expandable units and modules, each linking to a downloadable PDF and a companion YouTube video.
- **Live search with suggestions** — A search bar filters the subject list as you type and lets you jump straight to a subject by clicking a suggestion or pressing Enter.
- **Username / password login** — A PHP + MySQL login flow that validates credentials against a `users` table and starts a PHP session.
- **"Suggest Me!" feedback form** — A contact form on the home page that posts submissions to a Google Apps Script endpoint (Google Sheets backend).
- **Responsive styling** — Dedicated stylesheets per page with mobile-oriented media queries, plus Font Awesome icons and a loading spinner for navigation transitions.

## Tech Stack

- **Frontend:** HTML5, CSS3 (multiple per-page stylesheets), vanilla JavaScript
- **Backend:** PHP (sessions + form handling)
- **Database:** MySQL (via `mysqli`)
- **Icons:** Font Awesome (CDN)
- **External integration:** Google Apps Script / Google Sheets (suggestion form)

## How It Works

1. **Entry point** — `index.html` shows the landing page with a "START" button leading to the main content. A separate PHP entry (`index1.php`) renders the login screen.
2. **Authentication** — The login form posts to `login.php`, which includes `db_conn.php` to connect to MySQL, sanitizes input (`trim` / `stripslashes` / `htmlspecialchars`), looks up the user in the `users` table, and on success stores `user_name`, `password` and `id` in the PHP session before redirecting to `home.html`. `logout.php` destroys the session and returns to `index1.php`.
3. **Browsing** — `home.html` presents the subject grid and the search bar. `script.js` holds the in-page list of subjects and their target pages, drives the live-suggestion dropdown, and handles search-and-redirect behaviour.
4. **Learning content** — Subject pages such as `c_programming.html` group materials into collapsible units/modules; each module links to a PDF (e.g. `unit 1.pdf`) and a YouTube video.
5. **Feedback** — The "Suggest Me!" form on `home.html` submits via `fetch` to a Google Apps Script Web App URL, which records entries in a Google Sheet.

## Project Structure

```
QUICK MASTERY/
├── index.html            # Landing page (START -> home)
├── index1.php            # Login page (renders the login form)
├── login.php             # Login handler: validates credentials, starts session
├── logout.php            # Destroys session and redirects to login
├── db_conn.php           # MySQL connection (mysqli)
├── home.html             # Main page: subject catalogue, search, suggestion form
├── about.html            # About / "What We Offer" page
├── about                 # (empty placeholder file)
├── c_programming.html    # Example subject page with unit/module materials
├── script.js             # Search + live-suggestion logic
├── style.css             # Landing page styles
├── style1.css            # Login page styles
├── style2.css            # About page styles
├── style3.css            # Home page styles
├── style4.css            # Subject (C Programming) page styles
├── LOGO TEXT.png         # Site logo
├── suggest-img.png       # Image for the suggestion section
├── unit 1.pdf            # Sample course material (C Programming, Unit 1)
└── WEBSITE/              # Screenshots / preview images of the site
```

## Prerequisites

- **PHP** (with the `mysqli` extension enabled)
- **MySQL** server
- A web server / PHP environment such as **XAMPP**, **WAMP**, or **MAMP** (recommended for local development on Windows)

## Configuration

Database connection settings live in `db_conn.php`. The defaults target a local XAMPP-style MySQL setup:

```php
$sname    = "localhost";   // MySQL host
$uname    = "root";        // MySQL username
$password = "";            // MySQL password
$db_name  = "qm_login";    // Database name
```

The application expects a database named `qm_login` containing a `users` table with at least the following columns:

| Column      | Purpose                          |
|-------------|----------------------------------|
| `id`        | User identifier                  |
| `user_name` | Login username                   |
| `password`  | Login password                   |

You can create the database and table, for example:

```sql
CREATE DATABASE qm_login;
USE qm_login;

CREATE TABLE users (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50)  NOT NULL,
    password  VARCHAR(255) NOT NULL
);

INSERT INTO users (user_name, password) VALUES ('demo', 'demo');
```

The suggestion form in `home.html` posts to a Google Apps Script Web App URL (`scriptURL`). Replace it with your own deployed script URL if you want submissions to land in your own Google Sheet.

## Installation & Running Locally

1. **Install a PHP/MySQL stack** (e.g. [XAMPP](https://www.apachefriends.org/)) and start the Apache and MySQL services.

2. **Clone the repository** into your web root (for XAMPP, that is typically `htdocs/`):

   ```bash
   git clone https://github.com/KarthikRommula/Quickmastery.git
   ```

3. **Create the database** `qm_login` and the `users` table (see [Configuration](#configuration)).

4. **Check `db_conn.php`** and adjust the credentials if your MySQL setup differs from the defaults.

5. **Open the app** in your browser via the local server, for example:

   ```
   http://localhost/Quickmastery/QUICK%20MASTERY/index1.php
   ```

   Log in with a user you inserted into the `users` table, then browse the catalogue from `home.html`.

> The HTML/CSS/JS pages can be opened directly in a browser, but the PHP login flow (`index1.php`, `login.php`, `logout.php`) requires a PHP-capable server to run.

## Security Notes

This is a student/portfolio project. Before any real-world use, note that the current code:

- Builds SQL queries via string interpolation in `login.php`, which is vulnerable to **SQL injection** — use prepared statements (`mysqli` parameterized queries).
- Stores and compares **plaintext passwords** — passwords should be hashed (e.g. `password_hash` / `password_verify`).
- Keeps database credentials directly in `db_conn.php` — move secrets out of source control for production.
