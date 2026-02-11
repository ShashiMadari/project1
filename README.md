🔐 Secure Data Conversion & Routing System

A full-stack web application built using PHP, MySQL, HTML, CSS, and JavaScript that enables multi-format data conversion, secure routing, SHA256-based duplicate detection, and structured database storage.

🚀 Project Overview

This system allows users to:

Paste data in JSON or CSV format

Automatically detect input format

Convert between JSON and CSV

Save converted files into structured folders

Insert data into MySQL database

Prevent duplicate entries using SHA256 hashing

View database records in JSON format

Download database records in CSV format

The system ensures data integrity, format interoperability, and secure duplicate handling.

🧠 Key Features
✅ Multi-Format Input

Accepts JSON (single object or array)

Accepts CSV (with header row)

✅ Intelligent Format Detection

Automatically detects JSON or CSV

Converts to a unified internal JSON structure

✅ File Routing System

Saves JSON files in:

storage/json/


Saves CSV files in:

storage/csv/

✅ Secure Duplicate Prevention

Generates SHA256 hash for each record

Stores hash in database

UNIQUE constraint prevents duplicate insertion

✅ Database Viewing

View stored data as JSON

Download stored data as CSV

✅ Modern Responsive UI

Gradient background

Glassmorphism layout

Interactive buttons

Clean user interface

🏗️ Technology Stack

Frontend: HTML, CSS, JavaScript

Backend: PHP

Database: MySQL

Security: SHA256 Hashing

Server: Apache (XAMPP)

📂 Project Structure
data-router/
│
├── index.html        # Frontend UI
├── process.php       # Data processing & routing logic
├── view.php          # View database (JSON / CSV)
├── config.php        # Database connection
│
├── storage/
│   ├── json/         # Saved JSON files
│   └── csv/          # Saved CSV files
│
└── database.sql      # Database setup script

🗄️ Database Structure
users Table
Column	Type	Description
id	INT (PK)	Auto Increment ID
name	VARCHAR(100)	User Name
age	INT	User Age
city	VARCHAR(100)	City Name
created_at	DATE	Record Date
data_hash	VARCHAR(64)	SHA256 Unique Hash
🔐 Duplicate Prevention Logic

Normalize record fields.

Generate SHA256 hash:

name|age|city|created_at


Store hash in data_hash.

UNIQUE constraint ensures duplicates are rejected.

If same record is submitted again → insertion is skipped.

📥 Input Examples
JSON Example (Array)
[
  {
    "name": "Alice",
    "age": 30,
    "city": "New York",
    "created_at": "2024-09-01"
  },
  {
    "name": "Bob",
    "age": 25,
    "city": "Chicago",
    "created_at": "2024-08-15"
  }
]

JSON Example (Single Object)
{
  "name": "Charlie",
  "age": 35,
  "city": "San Francisco",
  "created_at": "2024-07-10"
}

CSV Example
name,age,city,created_at
David,28,Boston,2024-06-01
Emma,22,Seattle,2024-05-10

▶️ How To Run the Project

Install XAMPP

Place project inside:

C:\xampp\htdocs\data-router


Start Apache and MySQL

Open phpMyAdmin

Import database.sql

Open browser:

http://localhost/data-router/index.html

🧪 Testing Workflow

Paste JSON or CSV input

Select "Save to Database"

Click "Process & Route"

Re-submit same data → duplicate will be skipped

Click "View as JSON" to see database data

Click "Download as CSV" to export data

📊 Sample Stored Records
ID	Name	Age	City	Date
1	Alice	30	New York	2024-09-01
2	Bob	25	Chicago	2024-08-15
3	Charlie	35	San Francisco	2024-07-10
4	David	28	Boston	2024-06-01
5	Emma	22	Seattle	2024-05-10
🎯 What This Project Demonstrates

Data interoperability

Backend validation & routing

Secure duplicate prevention

File storage management

REST-style processing logic

Full-stack integration

Database integrity handling

🔮 Future Enhancements

File upload instead of textarea

User authentication system

REST API version

Logging & analytics dashboard

Role-based access control

Deployment to cloud (AWS / Render / DigitalOcean)

👨‍💻 Developed By

Shashi Madari
Computer Science Engineering Student

📜 License
