CREATE DATABASE user_management;

USE user_management;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    gender ENUM('Male', 'Female', 'Others') NOT NULL,
    occupation ENUM('Doctor', 'Engineer', 'Teacher', 'Banker', 'Others') NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);





CREATE DATABASE database_name;

USE database_name;

CREATE TABLE database_table(
	id INT AUTO_INCREMENT PRIMARY KEY,
	NAME VARCHAR(255) NOT NULL,
	address TEXT NOT NULL,
	gender ENUM('Male', 'Female', 'Others'),
	occupation ENUM('engineer', 'doctor', 'others' ) NOT NULL,
	phone_no VARCHAR(255) NOT NULL,
	email_address VARCHAR(255) NOT NULL UNIQUE
	file_path VARCHAR(255) NOT NULL
);

USE database_name;

CREATE TABLE student(
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	NAME VARCHAR(255) NOT NULL,
	gender ENUM('female', 'male'),
	id INT NOT NULL,
	department ENUM('CSE', 'EEE', 'ME', 'BBA', 'IT'),
	phone_no VARCHAR(255) NOT NULL,
	birthday DATE NOT NULL
	
);
DROP TABLE student;