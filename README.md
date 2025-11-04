# Task Review Insights - CRUD Application

A simple web application for managing task reviews built with LAMP stack (Linux, Apache, MySQL, PHP).

## Features

- ✅ Create new task reviews
- 📋 View all reviews in a table
- 👁️ View detailed review information
- ✏️ Edit existing reviews
- 🗑️ Delete reviews
- 🎨 Clean, modern UI inspired by Microsoft Power Apps

## Screenshots

The application includes:
- Dashboard with all task reviews
- Create/Edit forms with validation
- Detailed view page
- Color-coded quality ratings

## Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache

## Installation

### Prerequisites

- LAMP stack installed (Linux, Apache, MySQL, PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/task-review-app.git
cd task-review-app
```

### Step 2: Set Up Database

1. Log into MySQL:
```bash
mysql -u root -p
```

2. Import the database:
```bash
mysql -u root -p < database.sql
```

Or manually run the SQL commands from `database.sql`

### Step 3: Configure Database Connection

Edit `config.php` and update your database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'task_review_db');
```

### Step 4: Deploy to Web Server

Copy all files to your Apache web directory:

```bash
sudo cp -r * /var/www/html/task-review/
```

### Step 5: Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/html/task-review/
sudo chmod -R 755 /var/www/html/task-review/
```

### Step 6: Access the Application

Open your browser and navigate to:
```
http://localhost/task-review/index.php
```

## Project Structure

```
task-review-app/
├── index.php           # Main dashboard (list all reviews)
├── create.php          # Create new review form
├── edit.php            # Edit existing review form
├── view.php            # View review details
├── config.php          # Database configuration
├── database.sql        # Database schema and sample data
├── README.md           # This file
└── .gitignore          # Git ignore file
```

## Usage

### Create a New Review
1. Click the "New Review" button on the dashboard
2. Fill in all required fields
3. Click "Create Review"

### View Review Details
1. Click the "View" button on any review row
2. See all details including timestamps

### Edit a Review
1. Click the "Edit" button on any review row
2. Modify the fields as needed
3. Click "Update Review"

### Delete a Review
1. Click the "Delete" button on any review row
2. Confirm the deletion in the popup

## Database Schema

### `task_reviews` Table

| Column | Type | Description |
|--------|------|-------------|
| id | INT | Primary key (auto-increment) |
| review_summary | VARCHAR(255) | Summary of the review |
| task | VARCHAR(255) | Task name |
| reviewer | VARCHAR(100) | Name of the reviewer |
| points_awarded | INT | Points given (0-10) |
| time_taken | INT | Time in minutes |
| quality_rating | ENUM | Excellent/Good/Average/Poor |
| assigned_to | VARCHAR(100) | Assignee name |
| created_at | TIMESTAMP | Creation timestamp |
| updated_at | TIMESTAMP | Last update timestamp |

## Security Notes

⚠️ **Important**: This is a basic CRUD application for learning purposes. For production use, consider:

- Implement user authentication
- Add CSRF protection
- Use prepared statements (already implemented)
- Sanitize all inputs (basic sanitization included)
- Implement proper session management
- Add access control/authorization
- Use HTTPS
- Add input validation on both client and server side
- Implement rate limiting

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

## Contact

Your Name - Umi Syahirah

Project Link: [https://github.com/Umisyr/task-review-app](https://github.com/Umisyr/task-review-app)

## Acknowledgments

- Inspired by Microsoft Power Apps interface
- Built for learning PHP and MySQL CRUD operations
