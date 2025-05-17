<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // Change this to your MySQL username
define('DB_PASS', '');         // Change this to your MySQL password
define('DB_NAME', 'cybertips');

// Application configuration
define('SITE_NAME', 'CyberTips');
define('BASE_URL', 'http://localhost/cybertips'); // Change this to your base URL

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
session_start(); 