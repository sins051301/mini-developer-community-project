<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'userdata') or die('Unable to connect. Check your connection parameters.');

$pageid = $_GET['Login_board_id'];
$userid = $_GET['User_id'];
// 조회수 증가
    $update_query = "UPDATE userboardtable SET Board_view = Board_view + 1 WHERE Login_board_id='$pageid'AND Board_category ='Study-summary' AND User_id =$userid ";
    mysqli_query($db, $update_query) or die(mysqli_error($db));
    $_SESSION["viewed_$pageid"] = true;


// 좋아요 증가
if (isset($_POST['submitlike']) && !isset($_SESSION["liked_$pageid"])) {
    $update_query = "UPDATE userboardtable SET Board_thumb = Board_thumb + 1 WHERE Login_board_id='$pageid'AND Board_category ='Study-summary'";
    mysqli_query($db, $update_query) or die(mysqli_error($db));
    $_SESSION["liked_$pageid"] = true;
}

// 댓글 추가
if (isset($_POST['submit'])) {
    $category = 'Study-summary';
    $id = $_SESSION['Login_id'];
    $User_id =$_GET['User_id'];
    $chat = $_POST['comment'];
    $time = date("Y-m-d H:i:s");
    $query = "INSERT INTO userchattable (User_page_id, Login_chat_id, User_id, Login_chat_category, Chat_message, Chat_date) VALUES ('$pageid', '$id', '$User_id','$category', '$chat', '$time')";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header("Location: StudyViewPage.php?Login_board_id=$pageid&User_id=$User_id");
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
    <link rel="stylesheet" href="StudyViewPage.css?after" />
    <script type="text/javascript" src="ToggleForm.js"></script>
</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="main-log">
                <img id="header-img" src="../../img/sejonglogo.png" alt="LogoImg">
            </div>
            <div>
                <?php
                if (isset($_SESSION['Login_id'])) {
                    echo $_SESSION['Login_id'];
                    echo "| ";
                    echo "<a class='loginlink' href='../../utils/LogOut.php'>Logout</a>";
                } else {
                    echo "<div class='menu'>";
                    echo "<a href='../login/UserAddPage.php'>회원가입</a>";
                    echo "| ";
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
            echo "<a href=\"../post/UserWriteTodoList.php?id={$_SESSION['Login_id']}\">";
            echo "내가 할일";
            echo "</a>";
            ?>
            <?php
            echo "<a href=\"../post/UserWriteTostudyList.php?id={$_SESSION['Login_id']}\">";
            echo "공부 정리";
            echo "</a>";
        ?>
            <?php
            echo "<a href=\"../board/TodoBoardPage.php?id={$_SESSION['Login_id']}\">";
            echo "게시판";
            echo "</a>";
            ?>
        </nav>

        <div class="login-wrap">
            <div class="login-head">
                Study-Summary
            </div>
            <div class="container">
                <?php
                  $login_board_id = $_GET['Login_board_id'];
                  $User_id = $_GET['User_id'];
                  $query = "SELECT * FROM tostudytable WHERE Login_study_id = '$login_board_id' AND Study_id = '$User_id'";
                  $result = mysqli_query($db, $query) or die(mysqli_error($db));
                 while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']); ?>" alt="User Image">
                    <h3><?php echo htmlspecialchars($row['User_category']); ?></h3>
                    <p><?php echo htmlspecialchars($row['User_content']); ?></p>
                    <p><?php echo htmlspecialchars($row['User_summary']); ?></p>
                    <p class="date"><?php echo htmlspecialchars($row['Create_date']); ?></p>
                </div>
                <?php endwhile; ?>

            </div>
            <?php
            // 좋아요 수 가져오기
            $User_id = $_GET['User_id'];
            $query = "SELECT Board_thumb FROM userboardtable WHERE Login_board_id='$pageid' AND Board_category ='Study-summary' AND User_id='$User_id'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            echo "<div class='like-wrap'>";
            echo "<form method='post' action=''>";
            echo "<input type='submit' name='submitlike' value='좋아요' " . (isset($_SESSION["liked_$pageid"]) ? "disabled" : "") . "> ";
            echo "</form>";
            echo "</div>";
            ?>
            <img class="content-img" src="../../img/sejongwhite.png" alt="LogoImg">

        </div>
        <div>
            <?php
            $User_id = $_GET['User_id'];
            $query = "SELECT * FROM userchattable WHERE User_page_id='$pageid' AND Login_chat_category='Study-summary' AND User_id='$User_id'";
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