<?php
require_once 'config.php';

// Handle DELETE
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM task_reviews WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// Fetch all task reviews
$result = $conn->query("SELECT * FROM task_reviews ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Review Insights</title>
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
            max-width: 1400px;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 600;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #106ebe;
            color: white;
        }
        .btn-primary:hover {
            background: #005a9e;
        }
        .btn-success {
            background: #107c10;
            color: white;
            padding: 8px 16px;
        }
        .btn-success:hover {
            background: #0e6b0e;
        }
        .btn-warning {
            background: #ff8c00;
            color: white;
            padding: 8px 16px;
        }
        .btn-warning:hover {
            background: #e67d00;
        }
        .btn-danger {
            background: #d13438;
            color: white;
            padding: 8px 16px;
        }
        .btn-danger:hover {
            background: #a72d30;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #f3f2f1;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #323130;
            border-bottom: 2px solid #e1dfdd;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #edebe9;
        }
        tr:hover {
            background: #faf9f8;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
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
        .actions {
            display: flex;
            gap: 8px;
        }
        .no-data {
            padding: 40px;
            text-align: center;
            color: #605e5c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Task Review Insights</h1>
            <a href="create.php" class="btn btn-primary">+ New Review</a>
        </div>
        
        <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Review Summary</th>
                    <th>Task</th>
                    <th>Reviewer</th>
                    <th>Points</th>
                    <th>Time (min)</th>
                    <th>Quality</th>
                    <th>Assigned To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['review_summary']); ?></td>
                    <td><?php echo htmlspecialchars($row['task']); ?></td>
                    <td><?php echo htmlspecialchars($row['reviewer']); ?></td>
                    <td><?php echo $row['points_awarded']; ?></td>
                    <td><?php echo $row['time_taken']; ?></td>
                    <td>
                        <span class="badge badge-<?php echo strtolower($row['quality_rating']); ?>">
                            <?php echo $row['quality_rating']; ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($row['assigned_to']); ?></td>
                    <td>
                        <div class="actions">
                            <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-success">View</a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this review?')">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="no-data">
            <p>No task reviews found. Click "New Review" to create one.</p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>