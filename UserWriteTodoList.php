<?php
session_unset();
session_start(); 
// 데이터베이스 연결
$db = mysqli_connect('localhost', 'root', '', 'userdata') or die ('Unable to connect. Check your connection parameters.');

// 추가 버튼이 클릭되었을 때
if(isset($_POST['submit'])){
    $task = $_POST['toDo'];
    $category = $_POST['Category'];
    $id = $_SESSION['Login_id'];
    $time = date("Y-m-d H:i:s");
    $query = "INSERT INTO todotable (Login_todo_id, User_category, User_task, Create_date) VALUES ('$id','$category', '$task', '$time')";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header("Location:UserWriteTodoList.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community-login-page</title>
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="UserWriteTodoList.css" />
    <script type="text/javascript" src="TodoAdd.js"></script>
</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="main-log">
                <img class="header-img" src="./img/sejonglogo.png" alt="LogoImg">
            </div>
            <div>
                <?php
                // 세션에 저장된 데이터 확인
                if(isset($_SESSION['Login_id'])) {
                    echo $_SESSION['Login_id'];
                } else {
                    echo "세션에 로그인 정보가 없습니다.";
                }
                ?>
            </div>
        </div>
    </header>
    <nav>
        <a href="">글쓰기</a>
        <a href="">내가 할일</a>
        <a href="">공부 정리</a>
    </nav>
    <div class="content-wrap">
        <div class="login-wrap">
            <div class="login-head">
                Todo-List
            </div>
            <form method="post" action="">
                <div class="input-wrap">
                    <input type="text" name="Category" placeholder="카테고리">
                    <input type="text" name="toDo" placeholder="할 일 추가하기">
                    <button type="submit" class="addButton" name="submit">추가</button>
                </div>
            </form>
            <?php
            // 데이터베이스에서 해당 사용자의 투두리스트 불러오기
            $query = "SELECT * FROM todotable WHERE Login_todo_id='{$_SESSION['Login_id']}'";
            $result = mysqli_query($db, $query);
            // 투두리스트 항목 출력
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='toDoList'>";
                echo "<input type='checkbox' name='completed[]'>";
                echo "<span>{$row['User_task']}</span>";
                echo "<div class='delete'>";
                echo "<a href='DeleteTask.php?num={$row['User_task']}'>삭제</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            <img class="content-img" src="./img/sejongwhite.png" alt="LogoImg">
        </div>
    </div>
    <footer>
        <p>사업자 등록 번호: 1004</p>
        <p>대표자명: 신혁수</p>
        <p>주소: 용인</p>
        <p>전화번호: 010-****-**** (이메일로 연락 주세요)</p>
        <p>이메일: sins051301@naver.com</p>
    </footer>
</body>

</html>