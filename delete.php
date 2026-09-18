<?php
require_once "db.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepared DELETE query na may WHERE id = ?
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect sa index.php pagkatapos mag-delete
header("Location: index.php");
exit();
?>