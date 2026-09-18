<?php
require_once "db.php";
require_once "functions.php";
include_once "includes/header.php";

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<h3>Student List</h3>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= displayValue($row['id']); ?></td>
        <td><?= displayValue($row['name']); ?></td>
        <td><?= displayValue($row['email']); ?></td>
        <td><?= displayValue($row['course']); ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> | 
            <a href="delete.php?id=<?= $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>