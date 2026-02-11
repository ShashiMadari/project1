CREATE DATABASE IF NOT EXISTS data_router;

USE data_router;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    city VARCHAR(100) NOT NULL,
    created_at DATE NOT NULL,
    data_hash VARCHAR(64) NOT NULL UNIQUE
);