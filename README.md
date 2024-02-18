# Project Structure

## Controllers:

- **AuthController:** Handles user authentication.
- **CustomerController:** Manages customer-related actions.
- **DashboardController:** Controls the dashboard and its functionalities.
- **TaskController:** Manages task-related actions.
- **Traits/ZohoControllerTrait:** A trait containing methods related to Zoho CRM interactions.

## Models:

- **CustomerModel:** Represents the database model for customers.
- **TaskModel:** Represents the database model for tasks.
- **UserModel:** Represents the database model for users.

## Database Migrations:

- **2024-02-12-095007_CreateCustomersTable:** Migration for creating the customers table.
- **2024-02-12-120827_CreateTasksTable:** Migration for creating the tasks table.
- **2024-02-12-125239_CreateUsersTable:** Migration for creating the users table.
- **2024-02-17-032809_CreateTaskCustomerTable:** Migration for creating the TaskCustomer pivot table.

## Views:

- **auth:**
  - **signin_view:** View for user login.
  - **signup_view:** View for user registration.
- **customers:**
  - **summary:** View for displaying customer summaries.
- **dashboard:**
  - **index:** View for the dashboard.
  - **task:** View for managing tasks.
- **layout:**
  - **dashboard-layout:** Layout file for the dashboard views.

## Public:

- **css/style.css:** Stylesheet for the project.
- **img:** Folder containing images used in the project.

# Controllers

## AuthController:

- **Methods:**
  - **signin():** Displays the login view.
  - **login():** Handles user login.
  - **signup():** Displays the signup view.
  - **register():** Handles user registration.

## CustomerController:

- **Methods:**
  - **index():** Displays the customer summary.
  - **add():** Handles the addition of new customers.

## DashboardController:

- **Methods:**
  - **index():** Displays the dashboard.

## TaskController:

- **Methods:**
  - **viewTasks():** Displays tasks.
  - **add():** Handles the addition of new tasks.

## Traits/ZohoControllerTrait:

- **Methods:**
  - **Methods related to Zoho CRM interactions.**

# Models

## CustomerModel:

- **Represents the customers table in the database.**

## TaskModel:

- **Represents the tasks table in the database.**

## UserModel:

- **Represents the users table in the database.**

# Database Migrations

## 2024-02-12-095007_CreateCustomersTable:

- **Migration for creating the customers table.**

## 2024-02-12-120827_CreateTasksTable:

- **Migration for creating the tasks table.**

## 2024-02-12-125239_CreateUsersTable:

- **Migration for creating the users table.**

## 2024-02-17-032809_CreateTaskCustomerTable:

- **Migration for creating the TaskCustomer pivot table.**

# Views

## auth:

- **signin_view:** View for user login.
- **signup_view:** View for user registration.

## customers:

- **summary:** View for displaying customer summaries.

## dashboard:

- **index:** View for the dashboard.
- **task:** View for managing tasks.

## layout:

- **dashboard-layout:** Layout file for the dashboard views.

# Public

## css/style.css:

- **Stylesheet for the project.**

## img:

- **Folder containing images used in the project.**

# Routes Documentation

## Authentication Routes

### 1. Home (GET /)

- **Controller:** AuthController
- **Method:** signin
- **Description:** Displays the signin view.

### 2. Signup (GET /signup)

- **Controller:** AuthController
- **Method:** signup
- **Description:** Displays the signup view.

### 3. Signup (POST /signup)

- **Controller:** AuthController
- **Method:** signup
- **Description:** Handles user registration.

### 4. Signin (GET /signin)

- **Controller:** AuthController
- **Method:** signin
- **Description:** Displays the signin view.

### 5. Signin (POST /signin)

- **Controller:** AuthController
- **Method:** signin
- **Description:** Handles user login.

## Dashboard Routes

### 1. Dashboard Home (GET /dashboard)

- **Controller:** Dashboard
- **Method:** index
- **Description:** Displays the dashboard home.

### 2. Customer Routes

#### 2.1. Customer Index (GET /dashboard/customers)

- **Controller:** Customer
- **Method:** index
- **Description:** Displays customer summaries.

#### 2.2. Add Customer (POST /dashboard/customer/add)

- **Controller:** Customer
- **Method:** add
- **Description:** Handles the addition of new customers.

#### 2.3. Customer Summary (GET /dashboard/customer/summary)

- **Controller:** Customer
- **Method:** index
- **Alias:** customer-summary
- **Description:** Displays customer summaries (alias route).

### 3. Task Routes

#### 3.1. View Tasks (GET /dashboard/tasks/task)

- **Controller:** TaskController
- **Method:** viewTasks
- **Alias:** tasks
- **Description:** Displays tasks (alias route).

#### 3.2. Additional Task Routes (if needed)

- **Controller:** TaskController
- **Method:** viewTasks
- **Alias:** dashboard-tasks
- **Description:** Additional route for viewing tasks (alias route).

### 4. Task Routes (Outside 'dashboard' group)

#### 4.1. View Tasks (GET /task)

- **Controller:** TaskController
- **Method:** viewTasks

#### 4.2. Add Task (POST /task)

- **Controller:** TaskController
- **Method:** add

# Prerequisites:

1. **Web Server:**
   - Install a web server like Apache or use built-in servers like PHP's **`php -S`** for development.
2. **PHP:**
   - Ensure PHP is installed. CodeIgniter 4 requires PHP 7.2 or newer.
3. **Composer:**
   - Install Composer, a dependency manager for PHP. CodeIgniter uses Composer to manage its dependencies.
4. **Database:**
   - Set up a database (MySQL, PostgreSQL, etc.) and configure your database connection in the **`.env`** file.

# Steps to Run the Project:

## Clone the Repository:

```bash
git clone https://github.com/mubarakalmustapha/crm-task.git
```

-- cd crm-task
-- composer install
-- cp .env.example .env
-- php spark migrate
-- php spark serve

-- Access the Project:
Open your web browser and go to http://localhost:8080
