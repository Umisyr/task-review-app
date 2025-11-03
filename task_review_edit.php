<?php
require_once 'config.php';

$error = '';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review_summary = trim($_POST['review_summary']);
    $task = trim($_POST['task']);
    $reviewer = trim($_POST['reviewer']);
    $points_awarded = (int)$_POST['points_awarded'];
    $time_taken = (int)$_POST['time_taken'];
    $quality_rating = $_POST['quality_rating'];
    $assigned_to = trim($_POST['assigned_to']);
    
    if (empty($review_summary) || empty($task) || empty($reviewer) || empty($assigned_to)) {
        $error = 'Please fill in all required fields.';
    } else {
        $stmt = $conn->prepare("UPDATE task_reviews SET review_summary = ?, task = ?, reviewer = ?, points_awarded = ?, time_taken = ?, quality_rating = ?, assigned_to = ? WHERE id = ?");
        $stmt->bind_param("sssiissi", $review_summary, $task, $reviewer, $points_awarded, $time_taken, $quality_rating, $assigned_to, $id);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = 'Error updating review: ' . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task Review</title>
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
        .form-container {
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #323130;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d1d1;
            border-radius: 4px;
            font-size: 14px;
        }
        input:focus,
        select:focus {
            outline: none;
            border-color: #0078d4;
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
        }
        .btn-primary {
            background: #0078d4;
            color: white;
        }
        .btn-primary:hover {
            background: #005a9e;
        }
        .btn-secondary {
            background: #e1dfdd;
            color: #323130;
            margin-left: 10px;
        }
        .btn-secondary:hover {
            background: #d1cfcd;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-error {
            background: #fde7e9;
            color: #a4262c;
            border: 1px solid #f1aeb5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Edit Task Review</h1>
        </div>
        
        <div class="form-container">
            <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="review_summary">Review Summary *</label>
                    <input type="text" id="review_summary" name="review_summary" value="<?php echo htmlspecialchars($review['review_summary']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="task">Task *</label>
                    <input type="text" id="task" name="task" value="<?php echo htmlspecialchars($review['task']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="reviewer">Reviewer *</label>
                    <input type="text" id="reviewer" name="reviewer" value="<?php echo htmlspecialchars($review['reviewer']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="points_awarded">Points Awarded</label>
                    <input type="number" id="points_awarded" name="points_awarded" value="<?php echo $review['points_awarded']; ?>" min="0">
                </div>
                
                <div class="form-group">
                    <label for="time_taken">Time Taken (minutes)</label>
                    <input type="number" id="time_taken" name="time_taken" value="<?php echo $review['time_taken']; ?>" min="0">
                </div>
                
                <div class="form-group">
                    <label for="quality_rating">Quality Rating</label>
                    <select id="quality_rating" name="quality_rating">
                        <option value="Excellent" <?php echo $review['quality_rating'] === 'Excellent' ? 'selected' : ''; ?>>Excellent</option>
                        <option value="Good" <?php echo $review['quality_rating'] === 'Good' ? 'selected' : ''; ?>>Good</option>
                        <option value="Average" <?php echo $review['quality_rating'] === 'Average' ? 'selected' : ''; ?>>Average</option>
                        <option value="Poor" <?php echo $review['quality_rating'] === 'Poor' ? 'selected' : ''; ?>>Poor</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="assigned_to">Assigned To *</label>
                    <input type="text" id="assigned_to" name="assigned_to" value="<?php echo htmlspecialchars($review['assigned_to']); ?>" required>
                </div>
                
                <div>
                    <button type="submit" class="btn btn-primary">Update Review</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>