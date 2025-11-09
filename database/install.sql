CREATE DATABASE IF NOT EXISTS test 
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_general_ci;

USE test;

CREATE TABLE IF NOT EXISTS cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    visitedAt DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cityId INT NOT NULL,
    api VARCHAR(100) NOT NULL,
    temperature FLOAT,
    humidity FLOAT,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_city (cityId),
    FOREIGN KEY (cityId) REFERENCES cities(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO cities (name) VALUES
('New York'),
('Los Angeles'),
('Chicago'),
('Houston'),
('Phoenix'),
('Philadelphia'),
('San Antonio'),
('San Diego'),
('Dallas'),
('San Jose'),
('London'),
('Manchester'),
('Birmingham'),
('Paris'),
('Marseille'),
('Lyon'),
('Berlin'),
('Munich'),
('Frankfurt'),
('Madrid'),
('Barcelona'),
('Valencia'),
('Rome'),
('Milan'),
('Naples'),
('Turin'),
('Florence'),
('Venice'),
('Athens'),
('Thessaloniki'),
('Patras'),
('Warsaw'),
('Krakow'),
('Gdansk'),
('Budapest'),
('Debrecen'),
('Szeged'),
('Vienna'),
('Salzburg'),
('Graz'),
('Innsbruck'),
('Zurich'),
('Geneva'),
('Basel'),
('Brussels'),
('Antwerp'),
('Ghent'),
('Lisbon'),
('Porto');
