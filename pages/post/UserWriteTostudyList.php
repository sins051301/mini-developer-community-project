<?php
session_unset();
session_start(); 
// 데이터베이스 연결
$db = mysqli_connect('localhost', 'root', '', 'userdata') or die ('Unable to connect. Check your connection parameters.');

// 추가 버튼이 클릭되었을 때
if(isset($_POST['submit'])){
    $id = $_SESSION['Login_id'];
    $category = "Study-summary";
    $thumb = 0;
    $view = 0;
    $chat =0;
    $time = date("Y-m-d H:i:s");
    //가장 최신 유저가져와서 1늘린다음 저장
    $check_query = "SELECT User_id FROM userboardtable WHERE Login_board_id = '$id' AND Board_category = '$category' ORDER BY SID DESC LIMIT 1";
    $result = mysqli_query($db, $check_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['User_id'] ?? 0;
    $user_id++; // Increment the User_id
    
    // $check_query = "SELECT SID FROM userboardtable WHERE Login_board_id = '$id' AND Board_category = '$category'";
    // $result = mysqli_query($db, $check_query);

    $query = "INSERT INTO userboardtable (Login_board_id, User_id, Board_category, Create_board_date, Board_chat, Board_thumb, Board_view) VALUES ('$id','$user_id', '$category', '$time', '$chat', '$thumb', '$view')";
    mysqli_query($db, $query) or die(mysqli_error($db));
   
    $id = $_SESSION['Login_id'];
    $category = $_POST['user_category'];
    $content =  $_POST['user_content'];
    $summary =  $_POST['user_summary'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $time = date("Y-m-d H:i:s");
    

    $check_query = "SELECT Study_id FROM tostudytable WHERE Login_study_id = '$id' ORDER BY SID DESC LIMIT 1";
    $result = mysqli_query($db, $check_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['Study_id'] ?? 0;
    $user_id++; // Increment the User_id
    
    $query = "INSERT INTO tostudytable (Login_study_id, Study_id, User_category, User_content, User_summary, Image, Create_date) VALUES ('$id','$user_id','$category', '$content','$summary', '$image','$time')";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header("Location:../board/TodoBoardPage.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community-write-page</title>
    <link rel="stylesheet" href="../../reset.css" />
    <link rel="stylesheet" href="UserWriteTostudyList.css" />
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
            <?php
            echo "<a href=\"UserWriteTostudyList.php?id={$_SESSION['Login_id']}\">";
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
                StudySummaries
            </div>
            <form method="post" enctype="multipart/form-data" action="">

                <div class="form-group">
                    <label for="userCategory">User Category</label>
                    <input type="text" class="form-control" id="userCategory" name="user_category" required>
                </div>
                <div class="form-group">
                    <label for="userContent">User Content</label>
                    <input type="textfield" class="field-control" id="userContent" name="user_content" required>
                </div>
                <div class="form-group">
                    <label for="userSummary">User Summary</label>
                    <input type="textfield" class="field-control" id="userSummary" name="user_summary" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>
                <button type="submit" class="btn btn-custom btn-block" name="submit">Submit</button>
            </form>

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