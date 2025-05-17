<?php
require_once 'config.php';
require_once 'auth.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Please fill in all fields';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long';
    } else {
        $result = register_user($email, $password);
        if ($result['success']) {
            $success = $result['message'];
            header('Refresh: 2; URL=index.php');
        } else {
            $error = $result['message'];
        }
    }
}

require_once 'includes/header.php';
?>

<div class="auth-form">
    <h2 class="text-center mb-4">Sign Up for <?php echo SITE_NAME; ?></h2>
    
    <?php if ($error): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" 
                   required minlength="8">
            <div class="form-text">Password must be at least 8 characters long</div>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" 
                   name="confirm_password" required minlength="8">
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
    </form>
    
    <div class="text-center mt-3">
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 