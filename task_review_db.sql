-- Create database
CREATE DATABASE IF NOT EXISTS task_review_db;
USE task_review_db;

-- Create task_reviews table
CREATE TABLE IF NOT EXISTS task_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    review_summary VARCHAR(255) NOT NULL,
    task VARCHAR(255) NOT NULL,
    reviewer VARCHAR(100) NOT NULL,
    points_awarded INT DEFAULT 0,
    time_taken INT DEFAULT 0,
    quality_rating ENUM('Excellent', 'Good', 'Average', 'Poor') DEFAULT 'Average',
    assigned_to VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO task_reviews (review_summary, task, reviewer, points_awarded, time_taken, quality_rating, assigned_to) VALUES
('API docs clear', 'Document API', 'John Smith', 8, 10, 'Excellent', 'Syahirah Sabudin'),
('Backend needs improvement', 'Develop Backend', 'Jane Doe', 5, 20, 'Average', 'Syahirah Sabudin'),
('Deployment successful', 'Deploy App', 'Mike Johnson', 7, 8, 'Good', 'Syahirah Sabudin'),
('Good UI design', 'Design UI', 'Sarah Lee', 8, 12, 'Excellent', 'Syahirah Sabudin'),
('Tests are comprehensive', 'Write Tests', 'Tom Brown', 9, 15, 'Excellent', 'Syahirah Sabudin'),
('To manage system', 'review system pro...', 'Alice Wong', 0, 30, 'Average', 'Syahirah Sabudin');