# Business Listing & Rating System

This project is a **Business Listing & Rating System** built as part of a PHP machine test.  
It demonstrates **Core PHP (PDO)**, **MySQL**, **jQuery**, **AJAX**, **Bootstrap 5**, and the **Raty jQuery Plugin**, with real-time UI updates and no page reloads.

---

## 🚀 Features

- Business listing in tabular format  
- Add, Edit, Delete business (AJAX + Bootstrap modal)  
- Star rating system using **Raty jQuery Plugin**  
- Half-star ratings supported (0–5 scale)  
- Rating overwrite logic based on **Email OR Phone**  
- Real-time average rating updates  
- No page refresh anywhere  
- Clean, modular, GitHub-ready structure  

---

## 🛠 Tech Stack

- **PHP**: 8.2 (Core PHP, no framework)  
- **Database**: MySQL  
- **Frontend**: Bootstrap 5, jQuery  
- **AJAX**: jQuery AJAX  
- **Rating Plugin**: Raty jQuery Plugin  
- **Icons**: Font Awesome  

---

## 📂 Project Structure

```
business-rating-system/
│
├── index.php
├── README.md
│
├── config/
│   └── Database.php
│
├── ajax/
│   ├── business.php
│   └── rating.php
│
├── assets/
│   ├── js/
│   │   ├── business.js
│   │   └── rating.js
│   └── css/
│
├── partials/
│   ├── business_modal.php
│   ├── rating_modal.php
│   └── alert_modal.php
│
└── sql/
    └── database.sql
```

---

## ⚙️ Setup Instructions

### 1️⃣ Clone or Download the Project

```bash
git clone <repository-url>
```

Or download and extract the ZIP file.

---

### 2️⃣ Database Setup

1. Create a MySQL database named:

```sql
business_rating_system
```

2. Import the SQL file:

```sql
sql/database.sql
```

This will create:
- `businesses` table  
- `ratings` table with proper constraints  

---

### 3️⃣ Configure Database Connection

Edit the file:

```
config/Database.php
```

Update credentials if required:

```php
$host = 'localhost';
$db   = 'business_rating_system';
$user = 'root';
$pass = '';
```

---

### 4️⃣ Run the Project

- Place the project inside your local server directory  
  - `htdocs` (XAMPP)  
  - `www` (WAMP)

- Open your browser and visit:

```
http://localhost/business-rating-system/
```

---

## ⭐ Rating Logic

- Rating scale: **0 to 5**
- Half-star ratings supported
- If a user submits a rating with:
  - Same **Email OR Phone** for the same business → existing rating is **updated**
  - New **Email & Phone** → new rating is **inserted**
- Average rating is recalculated and updated **instantly without page refresh**

---

## 🔐 Security Measures

- PDO prepared statements
- SQL injection prevention
- Server-side validation
- No raw query execution

---

📷 Screenshots

<img width="2922" height="1486" alt="Screenshot from 2026-02-10 23-03-22" src="https://github.com/user-attachments/assets/2caf6328-05e8-4163-873b-cf7133b9f284" />
<img width="2922" height="1486" alt="Screenshot from 2026-02-10 23-03-39" src="https://github.com/user-attachments/assets/3ddbc4b4-8339-4169-b5dc-dd4c574776e4" />
<img width="2922" height="1486" alt="Screenshot from 2026-02-10 23-03-50" src="https://github.com/user-attachments/assets/abf75de4-66c0-47ea-8e8d-94f3ded96c1a" />
<img width="2922" height="1486" alt="Screenshot from 2026-02-10 23-04-01" src="https://github.com/user-attachments/assets/11f2aade-1329-42e0-a84e-db7098cf3890" />
<img width="2922" height="1486" alt="Screenshot from 2026-02-10 23-04-46" src="https://github.com/user-attachments/assets/109d3c80-124c-4f9c-8410-bea51816b489" />
<img width="2922" height="1486" alt="Screenshot from 2026-02-10 23-05-02" src="https://github.com/user-attachments/assets/d49d7715-8b5f-4f1c-8987-1b6957980389" />

---

## 👤 Author

**Lalit Nanwal**
