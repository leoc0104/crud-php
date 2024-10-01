# PHP CRUD Application

It is a project for the *Laboratory III* subject required in the Database program at Fatec Bauru. This project is a dictionary containing words from the following subjects: *Data Structures, Statistics, and Fundamentals of Networks*.

## Features

- **Create**: Add new records to the database.
- **Read**: Display the records stored in the database in a structured format (index and show).
- **Update**: Modify existing records.
- **Delete**: Remove records from the database.
- Basic routing system with MVC architecture.
- Uses environment variables for database configuration.

## Technologies Used

- PHP
- MySQL Database

## Project Structure

```
📂 crud-php
 ┣ 📂 config          # Contains database configuration and connection setup
 ┣ 📂 Controllers     # Contains the logic for handling requests and responses
 ┣ 📂 Models          # Contains the data structures and database interactions
 ┣ 📂 public          # Publicly accessible files
 ┃ ┗ 📄 index.php     # Main entry point for the application
 ┣ 📂 routes          # Defines the routes and their corresponding controllers
 ┣ 📂 vendor          # Composer dependencies
 ┣ 📄 .env           # Environment variables for configuration
 ┣ 📄 .env.example    # Example environment variables
 ┣ 📄 .gitignore      # Specifies files to be ignored by Git
 ┣ 📄 composer.json    # Composer dependencies and project configuration
 ┣ 📄 composer.lock    # Locks dependencies to specific versions
 ┗ 📄 README.md       # Project documentation
```

## Database Schema and Table

```sql
CREATE DATABASE `dictionary`;

CREATE TABLE `words` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(20),
    `translation` VARCHAR(20),
    `subject` VARCHAR(20),
    `context_applied` VARCHAR(255)
);
```
