# 💈 Barber POS System

A simple **Point of Sale (POS) system for barber shops** built to manage  
**inventory (products)** and **services** with sales tracking.

This project is designed for **small barber businesses** and for learning
full-stack development using lightweight technologies.

---

## 🚀 Features

### 📦 Product Inventory
- Add, update, delete products (e.g. hair gel, shampoo)
- Track stock quantity
- Track product sales

### ✂️ Service Management
- Add barber services (e.g. haircut, beard trim)
- Service-based sales (no barcode required)
- Price tracking per service

### 💰 Sales Tracking
- Combined product + service transactions
- Daily sales records
- Simple reporting via database queries

---

## 🛠️ Tech Stack

### Backend
- PHP **or** Node.js  
- SQLite (lightweight local database)

### Frontend
- HTML
- JavaScript
- Tailwind CSS

### Tools
- Git & GitHub
- VS Code
- SQLite Browser (for DB inspection)

---

## 📂 Project Structure

```text
barber-pos/
│
├── database/
│   └── barberpos.db
│
├── backend/
│   ├── db/
│   ├── routes/
│   └── server.js / index.php
│
├── frontend/
│   ├── index.html
│   ├── app.js
│   └── styles.css
│
└── README.md
