-- Create database if not exists
CREATE DATABASE IF NOT EXISTS secureapp;

-- Use the secureapp database
USE secureapp;

-- Create the client_data table
CREATE TABLE IF NOT EXISTS client_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dateInput1 DATE NOT NULL,
    dateInput2 DATE NOT NULL,
    phoneInput VARCHAR(20) NOT NULL,
    jsonInput TEXT NOT NULL,
    emailInput VARCHAR(255) NOT NULL,
    passwordInput VARCHAR(255) NOT NULL,
    postcodeInput VARCHAR(10) NOT NULL,
    creditCardInput VARCHAR(20) NOT NULL,
    ipInput VARCHAR(15) NOT NULL,
    xmlInput TEXT NOT NULL
);