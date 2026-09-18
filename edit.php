<?php
require_once "db.php";
require_once "functions.php";

$message = "";

// 1. Basahin ang ID mula sa query string ($_GET)
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// 4 & 5. Kapag pino-post ang form (UPDATE operation)
if (isset($_POST['save'])) {
    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $course = cleanInput($_POST['course']);

    if (empty($name) || empty($email) || empty($course)) {
        $message = "Please complete all fields.";
    } else {
        // Prepared UPDATE query na may WHERE id = ?
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $course, $id);
        $stmt->execute();
        $stmt->close();

        // 6. Redirect sa index.php pagkatapos mag-update
        header("Location: index.php");
        exit();
    }
}

// 2 & 3. Prepared SELECT query para makuha ang kasalukuyang data ng student (Pre-fill)
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

if (!$student) {
    header("Location: index.php");
    exit();
}

include_once "includes/header.php";
?>

<h3>Edit Student</h3>
<?php if (!empty($message)): ?>
    <p style="color:red;"><?= displayValue($message); ?></p>
<?php endif; ?>

<form action="edit.php?id=<?= displayValue($id); ?>" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= displayValue($student['name']); ?>"><br><br>
    
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= displayValue($student['email']); ?>"><br><br>
    
    <label>Course:</label><br>
    <input type="text" name="course" value="<?= displayValue($student['course']); ?>"><br><br>
    
    <button type="submit" name="save">Update</button>
</form>
</body>
</html>