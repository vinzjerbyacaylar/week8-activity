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

        header("Location: index.php?msg=created");
        exit();
    }
}

include_once "includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add Student</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger"><?= displayValue($message); ?></div>
                <?php endif; ?>

                <form action="create.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course:</label>
                        <input type="text" name="course" class="form-control">
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Save Student</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>