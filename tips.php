<?php
require_once 'config.php';
require_once 'auth.php';
require_once 'db.php';

// Require login for this page
require_login();

// Pagination settings
$tips_per_page = 10;
$current_page = max(1, $_GET['page'] ?? 1);
$offset = ($current_page - 1) * $tips_per_page;

// Get total number of tips
$stmt = $pdo->query("SELECT COUNT(*) FROM tips");
$total_tips = $stmt->fetchColumn();
$total_pages = ceil($total_tips / $tips_per_page);

// Get tips for current page
$stmt = $pdo->prepare("
    SELECT t.*, u.email as author_email 
    FROM tips t 
    JOIN users u ON t.user_id = u.id 
    ORDER BY t.created_at DESC 
    LIMIT ? OFFSET ?
");
$stmt->execute([$tips_per_page, $offset]);
$tips = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cybersecurity Tips</h2>
            <a href="add_tip.php" class="btn btn-primary">Share a New Tip</a>
        </div>

        <?php if (empty($tips)): ?>
            <div class="alert alert-info">
                No tips have been shared yet. Be the first to share a cybersecurity tip!
            </div>
        <?php else: ?>
            <?php foreach ($tips as $tip): ?>
                <div class="tip-card">
                    <h3><?php echo htmlspecialchars($tip['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($tip['content'])); ?></p>
                    <div class="tip-meta">
                        Shared by <?php echo htmlspecialchars($tip['author_email']); ?> 
                        on <?php echo date('F j, Y', strtotime($tip['created_at'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">
                                    Previous
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo $i === $current_page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">
                                    Next
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 