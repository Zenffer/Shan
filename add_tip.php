<?php
require_once 'config.php';
require_once 'auth.php';
require_once 'db.php';

// Require login for this page
require_login();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($title) || empty($content)) {
        $error = 'Please fill in all fields';
    } else {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO tips (user_id, title, content, created_at) 
                VALUES (?, ?, ?, NOW())
            ");
            $stmt->execute([$_SESSION['user_id'], $title, $content]);
            $success = 'Your cybersecurity tip has been shared successfully!';
            
            // Redirect to dashboard after 2 seconds
            header('Refresh: 2; URL=dashboard.php');
        } catch (PDOException $e) {
            $error = 'Failed to save the tip. Please try again.';
        }
    }
}

require_once 'includes/header.php';
?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Share a Cybersecurity Tip</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" 
                       required maxlength="255"
                       placeholder="Enter a descriptive title for your tip">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" 
                          rows="6" required
                          placeholder="Share your cybersecurity knowledge and best practices..."></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Share Tip</button>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 