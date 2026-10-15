<?php
session_start();if(!isset($_SESSION['student_id'])){header('Location: index.php');exit;}if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: exam.php');exit;}require 'Includes/dbcon.php';
$token=$_POST['exam_token']??'';if(empty($_SESSION['exam_token'])||!hash_equals($_SESSION['exam_token'],$token)){http_response_code(400);exit('This exam form has expired. Please return to your dashboard and start again.');}unset($_SESSION['exam_token']);
$answers=$_POST['answer']??[];if(!is_array($answers))$answers=[];$score=0;$examIds=$_SESSION['current_exam_ids']??[];unset($_SESSION['current_exam_ids']);$total=count($examIds);
if($total===0){header('Location: dashboard.php');exit;}
$correct=[];$stmt=$con->prepare('SELECT id, correct_option FROM questions WHERE id=?');
foreach($examIds as $qid){$qid=(int)$qid;$stmt->bind_param('i',$qid);$stmt->execute();$q=$stmt->get_result()->fetch_assoc();if($q)$correct[$qid]=$q['correct_option'];}
$total=count($correct);
foreach($answers as $qid=>$chosen){$id=filter_var($qid,FILTER_VALIDATE_INT);if($id!==false&&isset($correct[$id])&&is_string($chosen)&&hash_equals($correct[$id],$chosen))$score++;}
$student=(int)$_SESSION['student_id'];$ins=$con->prepare('INSERT INTO results (student_id, score, total_questions) VALUES (?, ?, ?)');$ins->bind_param('iii',$student,$score,$total);if(!$ins->execute()){http_response_code(500);exit('Your result could not be saved. Please contact the administrator.');}
$_SESSION['last_exam_result']=['score'=>$score,'total'=>$total,'date'=>date('Y-m-d H:i:s')];header('Location: result.php');exit;
