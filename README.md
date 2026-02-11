# 🔐 Secure Data Conversion & Routing System

A full-stack web application built using **PHP, MySQL, and JavaScript** that supports multi-format data conversion, secure routing, SHA256-based duplicate detection, and database storage.

---

## 🚀 Project Overview

This system allows users to:

- Paste data in **JSON or CSV format**
- Automatically detect the format
- Convert between JSON and CSV
- Save converted files in dedicated folders
- Insert data into MySQL database
- Prevent duplicate entries using SHA256 hashing
- View stored database records in JSON or CSV format

---

## 🧠 Key Features

### ✅ Multi-Format Input
- Accepts JSON (single object or array)
- Accepts CSV (with header row)

### ✅ Intelligent Format Detection
- Automatically detects input type (JSON / CSV)
- Converts to internal JSON structure

### ✅ File Routing System
- Saves JSON files to:
storage/json/

- Saves CSV files to:
storage/csv/


### ✅ Secure Duplicate Prevention
- Generates SHA256 hash for each record
- Stores hash in database
- Prevents duplicate insertions using UNIQUE constraint

### ✅ Database Viewing
- View database as JSON
- Download database as CSV

### ✅ Modern UI
- Responsive design
- Gradient background
- Glassmorphism layout
- Interactive buttons

---

## 🏗️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Security:** SHA256 Hashing
- **Server:** XAMPP (Apache + MySQL)

---

## 📂 Project Structure

data-router/
│
├── index.html
├── process.php
├── view.php
├── config.php
│
├── storage/
│ ├── json/
│ └── csv/
│
└── database.sql


---

## 🗄️ Database Structure

### users Table

| Column      | Type        | Description |
|------------|------------|-------------|
| id         | INT (PK)   | Auto increment ID |
| name       | VARCHAR    | User name |
| age        | INT        | User age |
| city       | VARCHAR    | City |
| created_at | DATE       | Record date |
| data_hash  | VARCHAR(64)| SHA256 unique hash |

---

## 🔐 How Duplicate Prevention Works

1. Each record is normalized.
2. SHA256 hash is generated:
name|age|city|created_at

3. Hash is stored in `data_hash`.
4. UNIQUE constraint prevents duplicate insertions.

---

## 📥 Input Examples

### JSON Example

```json
[
{
 "name": "Alice",
 "age": 30,
 "city": "New York",
 "created_at": "2024-09-01"
}
]
CSV Example
name,age,city,created_at
Alice,30,New York,2024-09-01
▶️ How To Run
Install XAMPP

Place project inside:

C:\xampp\htdocs\data-router
Start Apache and MySQL

Import database.sql in phpMyAdmin

Open browser:

http://localhost/data-router/index.html
🧪 How To Test
Paste JSON or CSV

Check "Save to Database"

Click "Process & Route"

Try inserting same data again → it will skip duplicates

🎯 What This Project Demonstrates
Data interoperability between applications

Backend validation logic

Secure duplicate detection

REST-style data routing

File system storage management

Full-stack integration

🔮 Future Enhancements
Drag & drop CSV upload

Login system

API key authentication

REST API endpoints

Data analytics dashboard

Deployment to cloud server

👨‍💻 Developed By
Shashi Madari
Computer Science Engineering

