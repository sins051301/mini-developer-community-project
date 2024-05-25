<?php
// 데이터베이스 연결
session_start();

$servername = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'userdata';

$db = new mysqli($servername, $db_username, $db_password, $db_name) or die('Unable to connect. Check your connection parameters.');

// 로그인 정보 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_id = $_POST['Login_id'];
    $login_pw = $_POST['Login_pw'];

    // 사용자 인증 쿼리
    $query = "SELECT * FROM usertable WHERE Login_id='$login_id' AND Login_pw='$login_pw'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // 결과 확인
    if (mysqli_num_rows($result) == 1) {
        // 로그인 성공
        $_SESSION['Login_id'] = $login_id;
        // 로그인 성공 후 리다이렉트할 페이지로 이동
        header("Location: MainPage.php");
        exit;
    } else {
        header("Location: LoginPage.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community</title>
    <link rel="stylesheet" href="../reset.css" />
    <link rel="stylesheet" href="MainPage.css?after" />
</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="main-log">
                <img id="header-img" src="../img/sejonglogo.png" alt="LogoImg">
            </div>
            <div>
                <?php
                // 세션에 저장된 데이터 확인
                if (isset($_SESSION['Login_id'])) {
                    echo $_SESSION['Login_id'];
                    echo "| ";
                    echo "<a class='loginlink' href='../utils/LogOut.php'>Logout</a>";
                } else {
                    echo "<div class='menu'>";
                    echo "<a href='./login/UserAddPage.php'>회원가입</a>";
                    echo "|";
                    echo "<a href='./login/LoginPage.php'>로그인</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </header>
    <div class="content-wrap">
        <nav>
            <?php
            echo "<a href=\"MainPage.php?id={$_SESSION['Login_id']}\">";
            echo "홈";
            echo "</a>";
            ?>
            <?php
            echo "<a href=\"./post/UserWriteTodoList.php?id={$_SESSION['Login_id']}\">";
            echo "내가 할일";
            echo "</a>";
            ?>
            <?php
            echo "<a href=\"./post/UserWriteTostudyList.php?id={$_SESSION['Login_id']}\">";
            echo "공부 정리";
            echo "</a>";
            ?>
            <?php
            echo "<a href=\"./board/TodoBoardPage.php?id={$_SESSION['Login_id']}\">";
            echo "게시판";
            echo "</a>";
            ?>
        </nav>
        <img id="main-logo-img" src="../img/sejonglogo.png" alt="LogoImg">
        <div class="main-logo">
            Developer Community Site
        </div>
    </div>
    <footer>
        <p>사업자 등록 번호: 1004</p>
        <p>
            대표자명: 신혁수
        </p>
        <p>
            주소: 용인
        </p>
        <p>
            전화번호: 010-****-**** (이메일로 연락 주세요)
        </p>
        <p>
            이메일: sins051301@naver.com
        </p>
    </footer>
</body>

</html>