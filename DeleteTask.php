<?php
session_start();

// 데이터베이스 연결
$db = mysqli_connect('localhost', 'root', '', 'userdata') or die ('Unable to connect. Check your connection parameters.');

// 삭제할 항목의 User_task 값을 GET 방식으로 받아옵니다.
$task_to_delete = $_GET['num'];

// 해당 User_task 값을 가진 레코드를 데이터베이스에서 삭제합니다.
$query = "DELETE FROM todotable WHERE User_task='$task_to_delete' AND Login_todo_id='{$_SESSION['Login_id']}'";
mysqli_query($db, $query) or die(mysqli_error($db));
header("Location:UserWriteTodoList.php");
exit;

// 삭제 후 리다이렉트 또는 다시 로드할 수 있습니다.
// 예를 들어 원래 페이지로 리다이렉트하려면:
// header("Location: UserWriteTodoList.php");
// exit();
?>