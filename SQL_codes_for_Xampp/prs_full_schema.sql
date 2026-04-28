
-- Create and use the database
CREATE DATABASE IF NOT EXISTS prs_database;
USE prs_database;

-- Table: Roles
CREATE TABLE IF NOT EXISTS Roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

-- Table: Users
CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    national_id VARCHAR(20) UNIQUE,
    prs_id VARCHAR(36) UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

-- Table: Vaccination_Records
CREATE TABLE IF NOT EXISTS Vaccination_Records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    vaccine_type VARCHAR(50),
    dose_number INT,
    vaccination_date DATE,
    vaccination_center VARCHAR(100),
    region VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Table: Documents
CREATE TABLE IF NOT EXISTS Documents (
    document_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    document_type VARCHAR(50),
    document_path VARCHAR(255),
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Table: Audit_Logs
CREATE TABLE IF NOT EXISTS Audit_Logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Table: Encryption_Keys
CREATE TABLE IF NOT EXISTS Encryption_Keys (
    key_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    key_label VARCHAR(50),
    encryption_key TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
