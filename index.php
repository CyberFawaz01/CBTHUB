<?php
session_start(); require 'Includes/dbcon.php';
if(isset($_SESSION['student_id'])) { header('Location: dashboard.php'); exit; }
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $matricno=trim($_POST['matricno']??''); $password=$_POST['password']??'';
 $stmt=$con->prepare('SELECT id, fullname, matricno, password FROM students WHERE matricno = ? LIMIT 1');
 if($stmt){$stmt->bind_param('s',$matricno);$stmt->execute();$res=$stmt->get_result();$row=$res?$res->fetch_assoc():null;
 if($row && password_verify($password,$row['password'])){session_regenerate_id(true);$_SESSION['student_id']=(int)$row['id'];$_SESSION['student_name']=$row['fullname'];$_SESSION['student_matric_no']=$row['matricno'];header('Location: dashboard.php');exit;} $err='The matric number or password is incorrect.';}
}
$pageTitle='Student Sign In | FountainTest'; include 'Includes/header.php'; ?>
<section class="hero-panel"><span class="eyebrow">Your examination portal</span><h1>Prepare. Focus. Perform.</h1><p>A simple, secure space to sit computer-based tests, track your results and build confidence for your next assessment.</p><span class="pill">STUDENT CBT PORTAL</span></section>
<div class="auth-wrap"><div class="card"><div class="auth-heading"><div class="brand-mark">F</div><h2 class="h4 mt-3">Welcome back</h2><p class="muted mb-0">Sign in with your registered matric number.</p></div>
<?php if($err): ?><div class="alert alert-danger"><?=htmlspecialchars($err)?></div><?php endif; ?><form method="post" autocomplete="on"><div class="mb-3"><label for="matricno">Matric number</label><input id="matricno" name="matricno" class="form-control" required autocomplete="username" value="<?=htmlspecialchars($_POST['matricno']??'')?>" placeholder="e.g. FTA/2026/001"></div><div class="mb-4"><label for="pwd">Password</label><div class="input-group"><input id="pwd" name="password" type="password" class="form-control" required autocomplete="current-password" placeholder="Enter your password"><button class="btn btn-outline-secondary" type="button" data-toggle-password="pwd" aria-label="Show password">Show</button></div></div><button class="btn btn-success w-100" type="submit">Sign in to portal <span aria-hidden="true">→</span></button></form><div class="text-center mt-4 muted">New student? <a href="register.php" class="link-success fw-bold">Create an account</a></div></div><p class="text-center muted small mt-3">For assistance, contact your examination administrator.</p></div>
<?php include 'Includes/footer.php'; ?>
