CREATE DATABASE TODOAPP;
USE TODOAPP;

CREATE TABLE usuarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE tareas (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NULL,
    estado ENUM('ABIERTA', 'PROGRESO', 'HECHO') NOT NULL DEFAULT 'ABIERTA',
    constraint usuario_id_fk foreign key(usuario_id) references usuarios(id)
);
