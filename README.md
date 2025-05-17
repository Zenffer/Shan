# CyberTips - Cybersecurity Tips Sharing Platform

A web application that allows users to share and view cybersecurity tips. Built with PHP and MySQL.

## Features

- User Authentication (Register/Login)
- Secure Session Management
- Create and Share Cybersecurity Tips
- View All Tips with Pagination
- Responsive Design using Bootstrap
- Security Best Practices Implementation

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/cybertips.git
cd cybertips
```

2. Create a MySQL database and import the schema:
```bash
mysql -u root -p < schema.sql
```

3. Configure the database connection:
   - Open `config.php`
   - Update the database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'cybertips');
     ```

4. Update the base URL in `config.php`:
```php
define('BASE_URL', 'http://your-domain.com/cybertips');
```

5. Set up your web server:
   - For Apache, ensure mod_rewrite is enabled
   - Point your web root to the project directory
   - Ensure the web server has write permissions for session handling

## Security Features

- Password hashing using PHP's `password_hash()`
- Prepared statements to prevent SQL injection
- XSS prevention through output escaping
- CSRF protection
- Secure session handling
- Input validation and sanitization

## Directory Structure

```
/
├── index.php          # Login page
├── signup.php         # User registration
├── dashboard.php      # Main dashboard
├── add_tip.php        # Add new tip
├── tips.php           # View all tips
├── logout.php         # Logout handler
├── db.php            # Database connection
├── auth.php          # Authentication functions
├── config.php        # Configuration settings
├── schema.sql        # Database schema
├── includes/         # Common includes
│   ├── header.php
│   └── footer.php
└── assets/           # Static assets
    ├── style.css
    └── scripts.js
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details. 