<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-md-8 text-center">
            <h1 class="display-4 mb-4">Welcome to CyberTips</h1>
            <p class="lead mb-4">Your trusted source for cybersecurity tips and best practices.</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <h3>Learn</h3>
            <p>Access comprehensive cybersecurity tips and tutorials.</p>
        </div>
        <div class="col-md-4">
            <h3>Share</h3>
            <p>Contribute your knowledge and experiences with the community.</p>
        </div>
        <div class="col-md-4">
            <h3>Protect</h3>
            <p>Implement best practices to secure your digital life.</p>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
