<?php
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'fruits_db';
$username = getenv('DB_USER') ?: 'admin';
$password = getenv('DB_PASS') ?: 'secure_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT name, season, nutritional_info, color FROM fruits");
    $fruits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Ghanaian Fruits in Season</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0fdf4;
            color: #166534;
        }
        .container {
            max-width: 1200px;
        }
        .fruit-card {
            background-color: #ecfdf5;
            border-radius: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease-in-out;
        }
        .fruit-card:hover {
            transform: translateY(-5px);
        }
        .seasonal-tag {
            background-color: #34d399;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .main-title {
            background: linear-gradient(135deg, #10b981, #34d399, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 3rem;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center main-title">🍃 Healthy Ghanaian Fruits in Season 🍃</h1>
        <div class="row">
            <?php foreach ($fruits as $fruit): ?>
                <div class="col-md-4 mb-4">
                    <div class="card fruit-card border-0" style="border-left: 6px solid <?php echo htmlspecialchars($fruit['color']); ?> !important;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($fruit['name']); ?></h5>
                            <span class="seasonal-tag mb-3 d-inline-block" style="background-color: <?php echo htmlspecialchars($fruit['color']); ?>;"><?php echo htmlspecialchars($fruit['season']); ?></span>
                            <p class="card-text"><?php echo htmlspecialchars($fruit['nutritional_info']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>