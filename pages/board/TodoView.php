<?php
session_start(); 
$db = mysqli_connect('localhost', 'root', '', 'userdata') or die('Unable to connect. Check your connection parameters.');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community-view-page</title>
    <link rel="stylesheet" href="../../reset.css" />
    <link rel="stylesheet" href="TodoView.css" />
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
                    echo"|";
                    echo "<a href='../../utils/LogOut.php'>Logout</a>";
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
            <a href="">글쓰기</a>
            <a href="">내가 할일</a>
            <a href="">공부 정리</a>
        </nav>

        <div class="login-wrap">
            <div class="login-head">
                Todo-List
            </div>
            <?php
            // 데이터베이스에서 해당 사용자의 투두리스트 불러오기
            $query = "SELECT * FROM todotable WHERE Login_todo_id='{$_GET['Login_board_id']}'";
            $result = mysqli_query($db, $query);
            // 투두리스트 항목 출력
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='toDoList'>";
                echo "<input type='checkbox' name='completed[]'>";
                echo "<span>{$row['User_task']}</span>";
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