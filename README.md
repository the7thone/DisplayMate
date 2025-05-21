# 📅 DisplayMate

**DisplayMate** is a PHP-based web application designed to show the current day's class schedule for an educational institution. It dynamically updates the page to reflect current, upcoming, and completed classes based on real-time server data.

> “Simplifying your academic day, one class at a time.”

---

## 🚀 Features

* 📆 Automatically detects today's date and determines if it's a **holiday**.
* 🟢 Displays **current classes** based on time.
* 🔜 Shows the **next upcoming class**.
* ⏭ Lists all **upcoming classes** for the day.
* 🎉 Holiday UI with a cheerful message when no classes are scheduled.
* ⏱ Auto-refreshes every 10 seconds to stay up-to-date.
* ✅ Mobile responsive with a clean, Bootstrap-powered interface.

---

## 🛠️ Technologies Used

* **PHP** (Core application logic)
* **MySQL** or **SQLite** (via `PDO`) – to store and retrieve schedules
* **Bootstrap 5** – for styling and responsive layout
* **Bootstrap Icons** – for modern and friendly icons
* **HTML5 & CSS3** – for markup and layout

---

## 📁 Project Structure

```bash
DisplayMate/
├── config.php               # Database config and settings
├── functions.php            # Custom functions (getClasses, renderTableRows, etc.)
├── index.php                # Main application logic and HTML rendering
├── _partials/
│   ├── navbar.php           # Navigation bar
│   └── footer.php           # Footer
├── vendor/
│   └── twbs/                # Bootstrap & Bootstrap Icons (via Composer or manual install)
└── README.md                # Project documentation
```

---

## ⚙️ Installation

1. **Clone the repository:**

```bash
git clone https://github.com/the7thone/DisplayMate.git
cd displaymate
```

2. **Set up your database:**

Ensure you have a valid database and a `schedule` table configured to support functions like `get_schedule()`, `getClasses()`, and others.

3. **Configure database connection:**

Edit `config.php` and set your database credentials:

```php
$pdo = new PDO("mysql:host=localhost;dbname=your_db", "username", "password");
```

4. **Install dependencies (if using Composer):**

```bash
composer install
```

> Note: Bootstrap and Bootstrap Icons are expected to be in the `vendor/twbs/` directory. Install them via Composer or add them manually.

5. **Run the app:**

Start a local PHP server:

```bash
php -S localhost:8000
```

Then open your browser and visit: [http://localhost:8000](http://localhost:8000)

---

## 🙌 Acknowledgements

This project was developed under the guidance of my **Head of Department (HOD)** from the **Computer Department** at
**VMV College, Nagpur**.

I am sincerely grateful for their support and mentorship throughout the development process.

---

## 📅 Future Improvements

* Weekly schedule viewer
* Notifications for upcoming classes
* Admin panel to manage class schedules
* Dark mode theme

---

## 🤝 Contributing

Contributions are welcome! If you find a bug or want to suggest a feature, open an issue or submit a pull request.

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).
