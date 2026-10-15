<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$base = (strpos($_SERVER['PHP_SELF'] ?? '', '/admin/') !== false) ? '../' : '';
$pageTitle = $pageTitle ?? 'FountainTest | Computer-Based Examination';
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($pageTitle) ?></title><meta name="theme-color" content="#123c2d"><meta name="description" content="FountainTest secure online computer-based examination portal.">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="<?= $base ?>style.css" rel="stylesheet"><script src="<?= $base ?>jsfile.js" defer></script></head><body>
<nav class="navbar navbar-expand-lg site-nav"><div class="container"><a class="navbar-brand brand-lockup" href="<?= $base ?>index.php"><span class="brand-mark">F</span><span>Fountain<span class="brand-light">Test</span><small>COMPUTER-BASED EXAMINATION</small></span></a><div class="d-flex align-items-center gap-2 flex-wrap">
<?php if(isset($_SESSION['student_id'])): ?><span class="nav-greeting d-none d-md-inline">Hello, <?= htmlspecialchars($_SESSION['student_matric_no'] ?? 'Student') ?></span><a class="btn btn-sm btn-light" href="<?= $base ?>dashboard.php">Dashboard</a><a class="btn btn-sm btn-outline-light" href="<?= $base ?>logout.php">Sign out</a>
<?php elseif(isset($_SESSION['admin_id'])): ?><span class="nav-greeting d-none d-md-inline">Administrator</span><a class="btn btn-sm btn-outline-light" href="<?= $base ?>admin/dashboard.php">Dashboard</a><a class="btn btn-sm btn-light" href="<?= $base ?>admin/logout.php">Sign out</a>
<?php else: ?><a class="nav-link-light" href="<?= $base ?>index.php">Student access</a><a class="btn btn-sm btn-light" href="<?= $base ?>admin/index.php">Admin access</a><?php endif; ?></div></div></nav>
<main class="container page-shell">
