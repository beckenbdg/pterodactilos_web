
-- Tabla de aeropuertos
CREATE TABLE airports (
    id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(100),
    iso_country CHAR(2) NOT NULL,
    iso_region VARCHAR(10),
    iata_code CHAR(3),
    icao_code CHAR(4),
    latitude DOUBLE,
    longitude DOUBLE,
    elevation_ft INT,
    timezone VARCHAR(50),
    type VARCHAR(50),
    FOREIGN KEY (iso_country) REFERENCES countries(iso_country),
    FOREIGN KEY (iso_region) REFERENCES regions(iso_region)
);