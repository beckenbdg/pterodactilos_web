CREATE TABLE flight_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    origin_icao CHAR(4) NOT NULL,
    destination_icao CHAR(4) NOT NULL,
    upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (origin_icao) REFERENCES airports(icao_code),
    FOREIGN KEY (destination_icao) REFERENCES airports(icao_code)
);