# 🗂️ Task Manager System

A hybrid Task Manager system featuring a Node.js REST API backend and a pure PHP frontend, secured via JSON Web Tokens (JWT). This project demonstrates full-stack development without using heavy frameworks, focusing on simplicity, clarity, and core functionality.

## ✨ Features

### Customer Features
-   **User Authentication:** Secure login with username & password returning a JWT token.
-   **Task Management:**
    -   **View tasks**
    -   **Create new tasks**
    -   **Delete existing tasks**

### Admin Features
-   **Protected API Routes:** All task endpoints require valid JWT authentication.
-   **CORS Enabled:** Allows the PHP frontend to communicate seamlessly with the Node.js backend.

## 🛠️ Technologies Used

### 💻 Frontend (PHP)
*   **Pure PHP (no frameworks)**
*   **cURL (to make HTTP requests)**
*   **PHP Sessions (to store the JWT)**
*   **HTML (page rendering)**

### 🔗 Backend (Node.js REST API)
*   **Node.js**
*   **Express.js**
*   **JSON Web Tokens (jsonwebtoken)**
*   **CORS (cors)**
*   **Body Parsing (body-parser)**
*   **Data stored in-memory (no external database)**


## 📁 Folder Structure

```
/TaskManagerSystem
├── node-api/
│   ├── server.js
│   ├── package.json
│   └── node_modules/
├── php-frontend/
│   ├── index.php
│   ├── tasks.php
│   ├── delete_task.php
│   └── logout.php
├── README.md
└── package-lock.json
```

## 🔧 Prerequisites

Ensure the following are installed on your system:

*   **Node.js & npm:**
    *   Download here: \[nodejs.org](https://nodejs.org/)
*   **PHP (v7.x or later):**
    *   Download here: \[php.net](https://www.php.net/downloads.php)
    *   Ensure the php-curl extension is enabled.

## 🚀 Setup and Installation

1.  **Clone the Repository**

    ```bash
    git clone https://github.com/XTRAGES/TaskManagerSystem.git
    cd TaskManagerSystem
    ```

2.  **Backend Setup**

    Navigate to the Node.js backend folder and install dependencies:

    ```bash
    cd node-api
    npm install
    ```

3.  **Frontend Setup**

    No package installation is required. Ensure PHP with php-curl is properly set up.

## 🏃 Running the Application

1.  **Start the Node.js Backend**

    In one terminal:

    ```bash
    cd node-api
    node server.js
    ```

    Expected output:

    ```
    Server listening at http://localhost:3000
    ```

2.  **Start the PHP Frontend**

    In a new terminal:

    ```bash
    cd php-frontend
    php -S localhost:8000
    ```

3.  **Access the App**

    Open your browser at:

    👉 http://localhost:8000/index.php

## 💡 Usage Guide

**Login:**

*   **Username:** admin
*   **Password:** password

**View Tasks:**

Tasks will be displayed on tasks.php.

**Add Task:**

Enter a task title and click "Add Task".

**Delete Task:**

Click "Delete" next to a task.

**Logout:**

Click "Logout" to end your session.

## 🔐 Authentication Details

*   **JWT Token:** Generated on successful login in Node.js backend.
*   **Token Storage:** Stored in PHP session (\_SESSION['token']).
*   **API Requests:** PHP sends JWT in `Authorization: Bearer <token>` header.
*   **Token Verification:** Node.js checks token validity before granting access.

## ❗ Security Notes

*   JWT used for route protection.
*   CORS properly configured.
*   PHP cURL securely handles API requests.
*   Sessions manage frontend security.


## 📝 License

This project is licensed under a **Proprietary License**.

It is intended for **personal use, educational purposes, and portfolio demonstration only**.
**Commercial use, distribution, modification, or resale is strictly prohibited without explicit written permission from the author.**

See the [LICENSE](./LICENSE) file for full license details.

## 📞 Support

For support and questions:

*   Create an issue on GitHub
*   Email: aldinzendeli33@gmail.com

## 👨‍💻 Author

Aldin Zendeli — XTRAGES on GitHub
