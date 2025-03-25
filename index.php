<?php
require_once 'connect.php';

// Initialize variables
$name = $age = $job = '';
$insert_success = false;

// Insert data if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $job = $_POST['job'] ?? '';
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO people (name, age, job) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $age, $job); // s=string, i=integer
    
    if ($stmt->execute()) {
        $insert_success = true;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// Get all people data
$result = $conn->query("SELECT * FROM people ORDER BY id DESC");
$people = $result->fetch_all(MYSQLI_ASSOC);
$result->free();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; background: #f5f5f5; padding: 15px; border-radius: 5px; }
        label { display: inline-block; width: 80px; }
        input { margin-bottom: 10px; padding: 5px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .success { color: green; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>People Data Form</h1>
    
    <?php if ($insert_success): ?>
        <div class="success">Record added successfully!</div>
    <?php endif; ?>
    
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required><br>
        
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?= htmlspecialchars($age) ?>" required><br>
        
        <label for="job">Job:</label>
        <input type="text" id="job" name="job" value="<?= htmlspecialchars($job) ?>" required><br>
        
        <input type="submit" value="Insert">
    </form>
    
    <h2>People List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Job</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($people as $person): ?>
            <tr>
                <td><?= htmlspecialchars($person['id']) ?></td>
                <td><?= htmlspecialchars($person['name']) ?></td>
                <td><?= htmlspecialchars($person['age']) ?></td>
                <td><?= htmlspecialchars($person['job']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>