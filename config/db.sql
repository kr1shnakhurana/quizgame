-- Step 1: Create Database
CREATE DATABASE IF NOT EXISTS quiz_platform;

-- Step 2: Use the Database
USE quiz_platform;

-- Step 3: Create Users Table
CREATE TABLE users (
    uid VARCHAR(36) PRIMARY KEY, -- Unique ID (UUID format)
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Store hashed passwords
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Step 4: Create Quizzes Table
CREATE TABLE quizzes (
    quiz_id INT AUTO_INCREMENT PRIMARY KEY,
    uid VARCHAR(36) NOT NULL, -- Links to `users.uid`
    quiz_title VARCHAR(255) NOT NULL,
    question_1 TEXT,
    question_2 TEXT,
    question_3 TEXT,
    question_4 TEXT,
    question_5 TEXT,
    question_6 TEXT,
    question_7 TEXT,
    question_8 TEXT,
    question_9 TEXT,
    question_10 TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE
);

-- Step 5: Create Answers Table
CREATE TABLE answers (
    answer_id INT AUTO_INCREMENT PRIMARY KEY,
    uid VARCHAR(36) NOT NULL, -- Links to `users.uid`
    quiz_id INT NOT NULL, -- Links to `quizzes.quiz_id`
    answer_1 TEXT,
    answer_2 TEXT,
    answer_3 TEXT,
    answer_4 TEXT,
    answer_5 TEXT,
    answer_6 TEXT,
    answer_7 TEXT,
    answer_8 TEXT,
    answer_9 TEXT,
    answer_10 TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(quiz_id) ON DELETE CASCADE
);

-- Step 6: Enable Event Scheduler for Timed Deletion of Quizzes
SET GLOBAL event_scheduler = ON;

-- Step 7: Create Event to Delete Old Quizzes After 20 Minutes
CREATE EVENT IF NOT EXISTS delete_old_quizzes
ON SCHEDULE EVERY 1 MINUTE
DO
  DELETE FROM quizzes
  WHERE created_at < NOW() - INTERVAL 20 MINUTE;

-- Step 8: Verify Event Scheduler is Running
SHOW EVENTS;
