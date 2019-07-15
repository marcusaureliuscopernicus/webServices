CREATE DATABASE clientele;

CREATE TABLE clients
(
    client_idx INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(40)
);

CREATE TABLE sections
(
    section_idx INT AUTO_INCREMENT PRIMARY KEY,
    client_idx INT NULL,
    section_name VARCHAR(40)
);

CREATE TABLE links
(
    link_idx INT AUTO_INCREMENT PRIMARY KEY,
    section_idx INT NULL,
    link_name VARCHAR(40)
);

