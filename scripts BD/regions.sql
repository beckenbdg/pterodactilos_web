-- Tabla de regiones
CREATE TABLE regions (
    iso_region VARCHAR(10) PRIMARY KEY,
    iso_country CHAR(2) NOT NULL,
    name VARCHAR(100) NOT NULL,
    FOREIGN KEY (iso_country) REFERENCES countries(iso_country)
);
