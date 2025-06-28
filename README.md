# 🛒 EcomInsight – AI-Powered Location-Based E-Commerce Platform

EcomInsight is a smart, modular e-commerce platform that connects users with nearby stores by displaying localized product availability and providing AI-based product recommendations. It is designed to empower small and mid-sized retailers with the tools they need to grow in a digital marketplace.

---

## 🚀 Features

- 📍 **Location-Based Product Availability**  
  Products display their store location (e.g., Johar Town, DHA) so users know where items are available.

- 🤖 **AI-Driven Product Recommendations**  
  Personalized suggestions based on browsing and purchase history using Python (TensorFlow & Scikit-learn).

- 💬 **AI Chatbot for Smart Suggestions**  
  Helps users decide which products to buy based on price range and needs (e.g., “best phone under 500”).

- 🛒 **Smart Cart and Checkout**  
  Add/remove items, update quantities, and proceed to a secure checkout flow.

- 🔐 **Secure Login & Role-Based Access**  
  Authenticated sessions with admin and user roles.

- 🧠 **Powerful Admin Panel**  
  Includes product management, order tracking, payment summary, brand/category controls, and visual analytics.

---

## 🧠 Admin Panel Overview

EcomInsight includes a rich admin interface that offers total control and visibility across the platform.


###  Admin Features

- 👤 **Manage Users**: View and remove registered users  
- 📦 **Manage Products**: Add, edit, delete, and fetch products from store APIs  
- 🏷️ **Brands**: Add/remove brand entries  
- 🗂️ **Categories/Subcategories**: Organize product structure  
- 💳 **Payments**: View order payments, totals, and status  
- 📈 **Sales Analytics**: View monthly sales and top-selling products  
- 📜 **Order Management**: Track all customer orders and status


## 🧠 Tech Stack

| Layer         | Technology           |
|---------------|----------------------|
| Frontend      | React.js, Bootstrap  |
| Backend       | Laravel (PHP, MVC)   |
| AI Module     | Python (TensorFlow, Scikit-learn) |
| Database      | MySQL                |
| Deployment    | Localhost (Cloud-Ready Architecture) |

---

## 🗂️ Project Structure

```bash
final-year-project/
├── backend/                  # Laravel Backend (Main Website)
├── frontend/                 # React Frontend (Main Website)
├── recommendation/          # Python Recommendation Engine
├── stores/
│   ├── johartown/
│   │   ├── backend/          # Johar Town Laravel Backend
│   │   └── frontend/         # Johar Town React Frontend
│   └── dha/
│       ├── backend/          # DHA Laravel Backend
│       └── frontend/         # DHA React Frontend
└── .env                      # Environment config
