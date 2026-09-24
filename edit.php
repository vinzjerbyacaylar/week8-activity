<?php
require_once "db.php";
require_once "functions.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$message = "";

if (isset($_POST['save'])) {
    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $course = cleanInput($_POST['course']);

    if (empty($name) || empty($email) || empty($course)) {
        $message = "Please complete all fields.";
    } else {
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $course, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: index.php?msg=updated");
        exit();
    }
}

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

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Student</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger"><?= displayValue($message); ?></div>
                <?php endif; ?>

                <form action="edit.php?id=<?= displayValue($id); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control" value="<?= displayValue($student['name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?= displayValue($student['email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course:</label>
                        <input type="text" name="course" class="form-control" value="<?= displayValue($student['course']); ?>">
                    </div>
                    <button type="submit" name="save" class="btn btn-warning">Save Changes</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>