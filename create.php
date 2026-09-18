<?php
require_once "db.php";
require_once "functions.php";

$message = "";

if (isset($_POST['save'])) {
    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $course = cleanInput($_POST['course']);

    if (empty($name) || empty($email) || empty($course)) {
        $message = "Please complete all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $course);
        $stmt->execute();
        $stmt->close();

        header("Location: index.php");
        exit();
    }
}

include_once "includes/header.php";
?>

<h3>Add Student</h3>
<?php if (!empty($message)): ?>
    <p style="color:red;"><?= displayValue($message); ?></p>
<?php endif; ?>

<form action="create.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name"><br><br>
    
    <label>Email:</label><br>
    <input type="email" name="email"><br><br>
    
    <label>Course:</label><br>
    <input type="text" name="course"><br><br>
    
    <button type="submit" name="save">Save</button>
</form>
</body>
</html>