
CREATE TABLE IF NOT EXISTS students (
 id INT AUTO_INCREMENT PRIMARY KEY,
 fullname VARCHAR(255) NOT NULL,
 matricno VARCHAR(80) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS admin (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(100) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS questions (
 id INT AUTO_INCREMENT PRIMARY KEY,
 question TEXT NOT NULL,
 option_a TEXT NOT NULL,
 option_b TEXT NOT NULL,
 option_c TEXT NULL,
 option_d TEXT NULL,
 correct_option ENUM('A','B','C','D') NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS results (
 id INT AUTO_INCREMENT PRIMARY KEY,
 student_id INT NOT NULL,
 score INT NOT NULL,
 total_questions INT NOT NULL,
 date_taken TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_results_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
) ENGINE=InnoDB;
-- Create the first admin by inserting a password_hash() generated in PHP; never store a plain-text admin password.
-- Example: INSERT INTO admin (username,password) VALUES ('admin', '$2y$10$REPLACE_WITH_A_REAL_PASSWORD_HASH');
