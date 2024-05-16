<?php

session_start(); 
$db = mysqli_connect('localhost', 'root', '', 'userdata') or die('Unable to connect. Check your connection parameters.');

if(isset($_POST['submit'])){
    $category = 'To-do';
    $pageid = $_GET['Login_board_id'];
    $id = $_SESSION['Login_id'];
    $chat = $_POST['comment'];
    $time = date("Y-m-d H:i:s");
    $query = "INSERT INTO userchattable (User_page_id, Login_chat_id, Login_chat_category, Chat_message, Chat_date) VALUES ( '$pageid', '$id','$category', '$chat', '$time')";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header("Location: TodoView.php?Login_board_id={$_GET['Login_board_id']}");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community-view-page</title>
    <link rel="stylesheet" href="../../reset.css" />
    <link rel="stylesheet" href="TodoView.css" />
    <script type="text/javascript" src="ToggleForm.js"></script>
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
                    echo"| ";
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
            echo "<a href=\"../post/UserWriteTodoList.php?id={$_SESSION['Login_id']}\">";
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
            <div class="toDOTitle">
                <div>카테고리</div>
                <div>할 일</div>
                <div>날짜</div>
            </div>
            <?php
            // 데이터베이스에서 해당 사용자의 투두리스트 불러오기
            $query = "SELECT * FROM todotable WHERE Login_todo_id='{$_GET['Login_board_id']}'";
            $result = mysqli_query($db, $query);
            // 투두리스트 항목 출력
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='toDoList'>";
                echo "<div>{$row['User_category']}</div>";
                echo "<div>{$row['User_task']}</div>";
                echo "<div>{$row['Create_date']}</div>";
                echo "</div>";
            }
            ?>


            <img class=" content-img" src="../../img/sejongwhite.png" alt="LogoImg">
        </div>
        <div>
            <?php
          $User_page_id = $_GET['Login_board_id']; // 예시 아이디
          $login_chat_category = 'To-do'; // 예시 카테고리
          
          $query = "SELECT * FROM userchattable WHERE User_page_id='$User_page_id' AND Login_chat_category='$login_chat_category'";
          $result = mysqli_query($db, $query);
            while ($row = mysqli_fetch_assoc($result)) {
              
                echo "<div class='chat-title'><div>{$row['Login_chat_id']}</div>";
                echo "<div>{$row['Chat_date']}</div></div>";
                echo "<div class='chat-wrap'>";
                echo "<div>{$row['Chat_message']}</div>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="form-wrap">
            <button class="comment-button" onclick="toggleForm()">댓글 쓰기</button>

            <div class="comment-form">
                <form id="commentForm" method="post" action="">
                    <textarea name="comment" placeholder="댓글을 입력하세요"></textarea>
                    <button class="addBtn" name="submit" type="submit">등록</button>
                </form>
            </div>
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