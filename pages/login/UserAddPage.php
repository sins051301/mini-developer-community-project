<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community-login-page</title>
    <link rel="stylesheet" href="../../reset.css" />
    <link rel="stylesheet" href="UserAddPage.css" />

</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="main-log">
                <img id="header-img" src="../../img/sejonglogo.png" alt="LogoImg">
            </div>
            <div class="menu">
                <a href="UserAddPage.php">회원가입</a>
                |
                <a href="LoginPage.php">로그인</a>
            </div>
        </div>
    </header>
    <nav>
        회원가입
    </nav>
    <div class="content-wrap">
        <div class="login-wrap">
            <div class="login-head">
                회원가입
            </div>
            <form method="POST" action="">
                <div class="input-wrap">
                    이름
                    <input type="text" name="Login_name" required />
                </div>
                <div class="input-wrap">
                    아이디
                    <input type="text" name="Login_id" required />
                </div>
                <div class="input-wrap2">
                    <div class="pass-wrap">
                        비밀번호
                        <input class="pass" type="password" name="Login_pw" required />
                    </div>
                    <div class="pass-wrap">
                        비밀번호 (확인)
                        <input class="pass" type="password" name="Login_pw_confirm" required />
                    </div>
                </div>
                <div class="input-wrap">
                    학교
                    <input type="text" name="User_university" required />
                </div>
                <div class="input-wrap">
                    이메일
                    <input type="text" name="Login_email" required />
                </div>
                <input id="submit" type="submit" name="submit" value="회원가입">

            </form>
            <img src="../../img/sejongwhite.png" alt="LogoImg">
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
    <?php
if(isset($_POST['submit'])) {
    $name = $_POST['Login_name'];
    $id = $_POST['Login_id'];
    $pass = $_POST['Login_pw'];
    $school = $_POST['User_university'];
    $email = $_POST['Login_email'];
    $time = date("Y-m-d H:i:s");
    $servername = 'localhost';
    $dbusername = 'root'; // 사용자 이름 변수명 수정
    $dbpassword = ''; // 비밀번호 변수명 수정
    $dbname = 'userdata';

    $db = new mysqli($servername, $dbusername, $dbpassword, $dbname) or die("Connection failed:");

    $query = "INSERT INTO usertable (Login_name, Login_id, Login_pw, User_university, Login_email, Join_date) VALUES ('$name', '$id', '$pass', '$school', '$email','$time' )";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header("Location: LoginPage.php");
    exit; // 중요: 페이지 이동 후 스크립트를 중지해야 합니다.
}
?>
</body>


</html>