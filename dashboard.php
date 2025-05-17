<?php
require_once 'auth.php';
require_once 'db.php';

// Require login for this page
require_login();

// Get user's tips count
$stmt = $pdo->prepare("SELECT COUNT(*) as tip_count FROM tips WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$result = $stmt->fetch();
$tip_count = $result['tip_count'];

// Get recent tips (limit to 5)
$stmt = $pdo->prepare("
    SELECT t.*, u.email as author_email 
    FROM tips t 
    JOIN users u ON t.user_id = u.id 
    ORDER BY t.created_at DESC 
    LIMIT 5
");
$stmt->execute();
$recent_tips = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</h2>
        <p class="lead">You have shared <?php echo $tip_count; ?> cybersecurity tip(s) so far.</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Recent Tips</h3>
            <a href="add_tip.php" class="btn btn-primary">Share a New Tip</a>
        </div>
        
        <?php if (empty($recent_tips)): ?>
            <div class="alert alert-info mt-3">
                No tips have been shared yet. Be the first to share a cybersecurity tip!
            </div>
        <?php else: ?>
            <?php foreach ($recent_tips as $tip): ?>
                <div class="tip-card">
                    <h4><?php echo htmlspecialchars($tip['title']); ?></h4>
                    <p><?php echo nl2br(htmlspecialchars($tip['content'])); ?></p>
                    <div class="tip-meta">
                        Shared by <?php echo htmlspecialchars($tip['author_email']); ?> 
                        on <?php echo date('F j, Y', strtotime($tip['created_at'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="text-center mt-4">
                <a href="tips.php" class="btn btn-outline-primary">View All Tips</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 