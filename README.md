# SecureApp Data Collection System

## Overview

Welcome to the SecureApp Data Collection System! This project is designed to collect and validate various types of user data through a web form. The system ensures data integrity by employing both front-end and back-end validation techniques.

## Requirements

To run this project locally, ensure you have the following:

- PHP (7.0 or later)
- Composer
- PHPUnit for running tests
- MySQL database

## Setup Instructions

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/cadofoh/secureApp_cw
   ```

2. Navigate to the project directory:

   ```bash
   cd secureApp_cw
   ```

3. Install dependencies using Composer:

   ```bash
   composer install
   ```

4. Create a MySQL database for the project:

   ```sql
   CREATE DATABASE secureapp;
   ```

5. Update database connection details:

   Open `src/config/DatabaseConnection.php` and modify the `$dbHost`, `$dbUser`, `$dbPassword`, and `$dbName` variables according to your MySQL setup.

6. Run the SQL script to create the necessary table:

   ```bash
   mysql -u your_username -p secureapp < database.sql
   ```

7. Start a local PHP server:

   ```bash
   php -S localhost:8000
   ```

   Access the application in your web browser at [http://localhost:8000](http://localhost:8000).

## Accessing the Application

The main entry point of the SecureApp Data Collection System is located in the `secureApp_cw/public` folder. To access the application, navigate to the following URL in your web browser:

   ```
http://localhost:8000/secureApp_cw/public
   ```



## Running Unit Tests

1. Ensure PHPUnit is installed globally:

   ```bash
   composer global require phpunit/phpunit
   ```

2. Run PHPUnit tests:

   ```bash
   phpunit
   ```

   This will execute the unit tests defined in the `tests` directory.

## Form Inputs and Validation

The form includes the following input fields:

- Date (Format: yyyy-mm-dd or dd/mm/yyyy)
- Phone Number (Format: +44 1234 567890)
- JSON Input (Valid JSON structure)
- Email Address
- Password (Must meet certain criteria)
- Postcode (UK format, e.g., B11 4NX)
- Credit Card Number
- IP Address
- XML Input (Valid XML structure)


Front-end and back-end validations ensure the correctness of the provided data. Refer to the `SecureAppModelTest` AND `SecureAppViewTest` class in the `tests` directory for specific validation test cases.

