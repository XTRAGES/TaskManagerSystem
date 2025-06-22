# Task Manager System

This project demonstrates a hybrid Task Manager system with a Node.js backend (REST API) and a PHP frontend, secured using JSON Web Tokens (JWT).

## Features

*   **User Authentication:** Secure login using username and password, returning a JWT token.
*   **Task Management:**
    *   View a list of tasks.
    *   Create new tasks.
    *   Delete existing tasks.
*   **Protected Routes:** All task-related API endpoints are protected by JWT authentication.
*   **CORS Enabled:** The Node.js backend is configured to allow cross-origin requests from the PHP frontend.

## Technologies Used

*   **Backend API:**
    *   Node.js
    *   Express.js (web framework)
    *   jsonwebtoken (for JWT creation and verification)
    *   body-parser (for parsing request bodies)
    *   cors (for Cross-Origin Resource Sharing)
    *   Data Storage: In-memory JavaScript array (for simplicity, no database required).

*   **Frontend:**
    *   PHP (pure PHP, no frameworks)
    *   cURL (for making HTTP requests to the Node.js API)
    *   HTML for page rendering
    *   PHP sessions (for storing the JWT token)

## Folder Structure

```
/TaskManagerSystem
├── node-api/
│   ├── server.js
│   ├── package.json
│   └── node_modules/
├── php-frontend/
│   ├── index.php
│   ├── tasks.php
│   ├── add_task.php (removed, functionality moved to tasks.php)
│   ├── delete_task.php
│   └── logout.php
├── README.md
└── package-lock.json
```

## Prerequisites

Before you begin, ensure you have the following installed on your system:

*   **Node.js and npm:**
    *   Download from [nodejs.org](https://nodejs.org/)
*   **PHP:**
    *   Download from [php.net](https://www.php.net/downloads.php)
    *   Ensure PHP is configured with `php-curl` extension enabled for cURL functionality.

## Setup and Installation

git clone https://github.com/XTRAGES/TaskManagerSystem.git
cd TaskManagerSystem


2.  **Backend Setup:**
    Navigate into the `node-api` directory and install the required Node.js packages:
    ```bash
    cd TaskManagerSystem/node-api
    npm install
    ```

## Running the Application

To run the full Task Manager system, you need to start both the Node.js backend and the PHP frontend separately.

1.  **Start the Node.js Backend:**
    Open a terminal and navigate to the `node-api` directory:
    ```bash
cd TaskManagerSystem/node-api
    node server.js
    ```
    You should see the message `Server listening at http://localhost:3000` in your terminal. Keep this terminal running.

2.  **Start the PHP Frontend:**
    Open a *new, separate* terminal and navigate to the `php-frontend` directory:
    ```bash
cd TaskManagerSystem/php-frontend
    php -S localhost:8000
    ```
    This will start PHP's built-in web server. Keep this terminal running.

3.  **Access the Application in your Browser:**
    Open your web browser and go to:
    `http://localhost:8000/index.php`

## Usage

1.  **Login:**
    On the `index.php` page, you will find a login form. Use the following credentials:
    *   **Username:** `admin`
    *   **Password:** `password`
    Click "Login". If successful, you will be redirected to `tasks.php`.

2.  **View Tasks:**
    The `tasks.php` page will display a list of tasks fetched from the Node.js API. Initially, this list will be empty.

3.  **Add a New Task:**
    On the `tasks.php` page, there is a form to add new tasks. Enter a title for your task and click "Add Task". The page will refresh, and your new task should appear in the list.

4.  **Delete a Task:**
    Next to each task in the list on `tasks.php`, there is a "Delete" link. Clicking this link will send a DELETE request to the Node.js API to remove the task. The page will refresh, and the task will be gone.

5.  **Logout:**
    Click the "Logout" link on the `tasks.php` page to clear your session and return to the login page.

## Authentication Details

*   **JWT Generation:** Upon successful login, the Node.js backend generates a JWT using `jsonwebtoken` and sends it back to the PHP frontend.
*   **Token Storage:** The PHP frontend stores this JWT in the user's session (`$_SESSION['token']`).
*   **Protected API Calls:** For all subsequent requests to protected API routes (`/tasks` GET/POST, `/tasks/:id` DELETE), the PHP frontend includes the JWT in the `Authorization: Bearer <token>` header using cURL.
*   **Token Verification:** The Node.js backend's `verifyToken` middleware intercepts these requests, verifies the JWT, and grants access only if the token is valid.
