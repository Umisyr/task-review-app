<?php
require_once 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    header("Location: index.php");
    exit;
}

// Fetch the task review
$stmt = $conn->prepare("SELECT * FROM task_reviews WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$review = $result->fetch_assoc();

if (!$review) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task Review</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #0078d4;
            color: white;
            padding: 20px 30px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .detail-group {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #edebe9;
        }
        .detail-group:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #605e5c;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 16px;
            color: #323130;
        }
        .badge {
            padding: 6px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
        }
        .badge-excellent {
            background: #dff6dd;
            color: #107c10;
        }
        .badge-good {
            background: #fff4ce;
            color: #8a8886;
        }
        .badge-average {
            background: #fde7e9;
            color: #a4262c;
        }
        .badge-poor {
            background: #fde7e9;
            color: #a4262c;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        .btn-primary {
            background: #0078d4;
            color: white;
        }
        .btn-primary:hover {
            background: #005a9e;
        }
        .btn-warning {
            background: #ff8c00;
            color: white;
        }
        .btn-warning:hover {
            background: #e67d00;
        }
        .btn-secondary {
            background: #e1dfdd;
            color: #323130;
        }
        .btn-secondary:hover {
            background: #d1cfcd;
        }
        .actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #edebe9;
        }
        .metadata {
            background: #f3f2f1;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .metadata p {
            font-size: 13px;
            color: #605e5c;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Task Review Details</h1>
        </div>
        
        <div class="content">
            <div class="detail-group">
                <div class="detail-label">Review Summary</div>
                <div class="detail-value"><?php echo htmlspecialchars($review['review_summary']); ?></div>
            </div>
            
            <div class="detail-group">
                <div class="detail-label">Task</div>
                <div class="detail-value"><?php echo htmlspecialchars($review['task']); ?></div>
            </div>
            
            <div class="detail-group">
                <div class="detail-label">Reviewer</div>
                <div class="detail-value"><?php echo htmlspecialchars($review['reviewer']); ?></div>
            </div>
            
            <div class="detail-group">
                <div class="detail-label">Points Awarded</div>
                <div class="detail-value"><?php echo $review['points_awarded']; ?> points</div>
            </div>
            
            <div class="detail-group">
                <div class="detail-label">Time Taken</div>
                <div class="detail-value"><?php echo $review['time_taken']; ?> minutes</div>
            </div>
            
            <div class="detail-group">
                <div class="detail-label">Quality Rating</div>
                <div class="detail-value">
                    <span class="badge badge-<?php echo strtolower($review['quality_rating']); ?>">
                        <?php echo $review['quality_rating']; ?>
                    </span>
                </div>
            </div>
            
            <div class="detail-group">
                <div class="detail-label">Assigned To</div>
                <div class="detail-value"><?php echo htmlspecialchars($review['assigned_to']); ?></div>
            </div>
            
            <div class="metadata">
                <p><strong>Created:</strong> <?php echo date('F j, Y, g:i a', strtotime($review['created_at'])); ?></p>
                <p><strong>Last Updated:</strong> <?php echo date('F j, Y, g:i a', strtotime($review['updated_at'])); ?></p>
            </div>
            
            <div class="actions">
                <a href="edit.php?id=<?php echo $review['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</body>
</html>