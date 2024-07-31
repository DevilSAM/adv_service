-- Создание базы данных, если она не существует
CREATE DATABASE IF NOT EXISTS testing;

-- Создание пользователя, если он не существует
CREATE USER IF NOT EXISTS 'username'@'%' IDENTIFIED BY 'password';

-- Предоставление всех привилегий пользователю на базу данных
GRANT ALL PRIVILEGES ON testing.* TO 'username'@'%';

-- Применение изменений
FLUSH PRIVILEGES;
