<?php
session_start();
if(!isset($_SESSION['admin_id'])) header("Location: index.php");
require '../Includes/dbcon.php';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $stmt = $con->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
}
header("Location: view_results.php");
exit;
