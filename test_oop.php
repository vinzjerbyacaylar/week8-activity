<?php
require_once "Student.php";
include_once "includes/header.php";

$student1 = new Student("Ana Reyes", "ana@example.com", "BSIT");
$student2 = new Student("Juan Cruz", "juan@example.com", "BSCS");
$student3 = new Student("Maria Santos", "maria@example.com", "BSEMC");
?>

<h2>OOP Student Test</h2>

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Student 1 Summary</h5>
        <p class="card-text"><?= htmlspecialchars($student1->displayInfo()); ?></p>
        <p class="text-muted"><strong>Individual Course Call:</strong> <?= htmlspecialchars($student1->getCourse()); ?></p>
    </div>
</div>

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Student 2 Summary</h5>
        <p class="card-text"><?= htmlspecialchars($student2->displayInfo()); ?></p>
    </div>
</div>

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Student 3 Summary</h5>
        <p class="card-text"><?= htmlspecialchars($student3->displayInfo()); ?></p>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>