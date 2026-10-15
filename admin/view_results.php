<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

require '../Includes/dbcon.php';
include '../Includes/header.php';

$stmt = $con->prepare("
    SELECT 
        results.id AS result_id,
        students.fullname,
        students.matricno,
        results.score,
        results.total_questions,
        results.date_taken
    FROM results
    JOIN students ON results.student_id = students.id
    ORDER BY results.date_taken DESC
");

$stmt->execute();
$res = $stmt->get_result();
?>

<div class="card p-4">
  <h4>Student Results</h4>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Student Name</th>
        <th>Matric No</th>
        <th>Score</th>
        <th>Total Questions</th>
        <th>Date Taken</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($r = $res->fetch_assoc()): ?>
        <tr>
          <td><?= $r['result_id'] ?></td>
          <td><?= htmlspecialchars($r['fullname']) ?></td>
          <td><?= htmlspecialchars($r['matricno']) ?></td>
          <td><?= $r['score'] ?></td>
          <td><?= $r['total_questions'] ?></td>
          <td><?= $r['date_taken'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a class="btn btn-secondary" href="dashboard.php">Back</a>
</div>

<?php include '../Includes/footer.php'; ?>