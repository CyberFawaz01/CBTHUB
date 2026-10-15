<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

require '../Includes/dbcon.php';
$msg = '';


if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $con->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $msg = "Question deleted successfully.";
}


if (isset($_POST['add'])) {
    $question = trim($_POST['question']);
    $a = trim($_POST['option_a']);
    $b = trim($_POST['option_b']);
    $c = trim($_POST['option_c']);
    $d = trim($_POST['option_d']);
    $correct = $_POST['correct_option'];

    $stmt = $con->prepare(
        "INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_option)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssssss", $question, $a, $b, $c, $d, $correct);

    if ($stmt->execute()) {
        $msg = "Question added successfully.";
    } else {
        $msg = "Error adding question.";
    }
}


$q = $con->query("SELECT id, question FROM questions ORDER BY id DESC");

include '../Includes/header.php';
?>

<div class="card p-4">
  <h4>Add Question</h4>

  <?php if ($msg): ?>
    <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label>Question</label>
      <textarea name="question" required class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label>Option A</label>
      <input name="option_a" required class="form-control">
    </div>

    <div class="mb-3">
      <label>Option B</label>
      <input name="option_b" required class="form-control">
    </div>

    <div class="mb-3">
      <label>Option C</label>
      <input name="option_c" class="form-control">
    </div>

    <div class="mb-3">
      <label>Option D</label>
      <input name="option_d" class="form-control">
    </div>

    <div class="mb-3">
      <label>Correct Option</label>
      <select name="correct_option" class="form-select" required>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
      </select>
    </div>

    <button name="add" class="btn btn-primary">Add Question</button>
    <a class="btn btn-link" href="dashboard.php">Back</a>
  </form>

  <hr>

  <h5>Existing Questions</h5>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Question</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $q->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['question']) ?></td>
          <td>
            <a href="?delete=<?= $row['id'] ?>"
               onclick="return confirm('Delete this question?')"
               class="btn btn-danger btn-sm">
               Delete
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</div>

<?php include '../Includes/footer.php'; ?>