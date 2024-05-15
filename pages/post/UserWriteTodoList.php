<?php
session_unset();
session_start(); 
// 데이터베이스 연결
$db = mysqli_connect('localhost', 'root', '', 'userdata') or die ('Unable to connect. Check your connection parameters.');

// 추가 버튼이 클릭되었을 때
if(isset($_POST['submit'])){
    $id = $_SESSION['Login_id'];
    $category = "To-do";
    $thumb = 0;
    $view = 0;
    $chat =0;
    $time = date("Y-m-d H:i:s");
    $check_query = "SELECT SID FROM userboardtable WHERE Login_board_id = '$id' AND Board_category = '$category'";
    $result = mysqli_query($db, $check_query);

    if(mysqli_num_rows($result) > 0){
        // 이미 해당 아이디와 카테고리로 등록된 레코드가 존재함
        // 처리할 내용을 여기에 추가하거나 에러 메시지를 표시할 수 있음
    } else {
        // 중복되는 아이디와 카테고리가 없으므로 새로운 레코드 삽입
        $query = "INSERT INTO userboardtable (Login_board_id, Board_category, Create_board_date, Board_chat, Board_thumb, Board_view) VALUES ('$id','$category', '$time', '$chat', '$thumb', '$view')";
        mysqli_query($db, $query) or die(mysqli_error($db));
        header("Location:UserWriteTodoList.php");
        exit;
    }
    
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
    <link rel="stylesheet" href="../../reset.css" />
    <link rel="stylesheet" href="UserWriteTodoList.css" />
</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="main-log">
                <img class="header-img" src="../../img/sejonglogo.png" alt="LogoImg">
            </div>
            <div>
                <?php
                // 세션에 저장된 데이터 확인
                if(isset($_SESSION['Login_id'])) {
                    echo $_SESSION['Login_id'];
                    echo"| ";
                    echo "<a class='loginlink' href='../../utils/LogOut.php'>Logout</a>";
                } else {
                    echo "<div class='menu'>";
                    echo "<a href='../login/UserAddPage.php'>회원가입</a>";
                    echo"|";
                    echo "<a href='../login/LoginPage.php'>로그인</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </header>
    <div class="content-wrap">
        <nav>
            <?php
            echo "<a href=\"../MainPage.php?id={$_SESSION['Login_id']}\">";
            echo "홈";
            echo "</a>";
        ?>
            <?php
            echo "<a href=\"UserWriteTodoList.php?id={$_SESSION['Login_id']}\">";
            echo "내가 할일";
            echo "</a>";
        ?>
            <a href="">공부 정리</a>
            <?php
            echo "<a href=\"../board/TodoBoardPage.php?id={$_SESSION['Login_id']}\">";
            echo "게시판";
            echo "</a>";
        ?>
        </nav>

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
                echo "<a href='../../utils/DeleteTask.php?num={$row['User_task']}'>삭제</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            <img class="content-img" src="../../img/sejongwhite.png" alt="LogoImg">
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