-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS hazard_map CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the hazard_map database
USE hazard_map;

-- Create markers table
CREATE TABLE IF NOT EXISTS markers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    lat DECIMAL(10, 6) NOT NULL,
    lng DECIMAL(10, 6) NOT NULL,
    memo TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create index for faster geographic queries
CREATE INDEX idx_lat_lng ON markers(lat, lng);
