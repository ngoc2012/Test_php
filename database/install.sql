CREATE DATABASE IF NOT EXISTS weather 
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_general_ci;

USE weather;
CREATE TABLE IF NOT EXISTS city (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cityId INT NOT NULL,
    api VARCHAR(100) NOT NULL,
    temperature FLOAT,
    humidity FLOAT,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_city (cityId),
    FOREIGN KEY (cityId) REFERENCES city(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO city (name) VALUES
('New York'),
('Los Angeles'),
('Chicago'),
('San Jose'),
('London'),
('Paris'),
('Berlin'),
('Munich'),
('Frankfurt'),
('Madrid'),
('Barcelona'),
('Naples'),
('Venice'),
('Athens'),
('Vienna'),
('Brussels'),
('Porto');
