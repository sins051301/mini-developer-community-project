<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community-login-page</title>
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="LoginPage.css" />

</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="main-log">
                <img id="header-img" src="./img/sejonglogo.png" alt="LogoImg">
            </div>
            <div class="menu">
                <a href="UserAddPage.php">회원가입</a>
                |
                <a href="LoginPage.php">로그인</a>
            </div>
        </div>
    </header>
    <nav>
        로그인
    </nav>
    <div class="content-wrap">
        <div class="login-wrap">
            <div class="login-head">
                로그인
            </div>
            <form method="POST" action="MainPage.php">
                <p>
                <div class="input-wrap">
                    <div class="login-img">𖠌</div>
                    <input type="text" name="Login_id" required />
                </div>
                <p>
                <p>
                <div class="input-wrap">
                    <div class="login-img">🔓︎</div>
                    <input type="password" name="Login_pw" required />
                </div>
                <p>
                <p>
                <div class="input-wrap2">
                    <div>
                        <input type="checkbox" id="visible" name="visible">
                        비밀번호 표시
                    </div>
                    <input id="submit" type="submit" value="로그인">
                </div>
                </p>
                <div class="user-add">
                    <div> 회원가입은 <a href="UserAddPage.php">여기</a>서 할 수 있습니다.</div>
                    <img src="./img/sejongwhite.png" alt="LogoImg">
                </div>
            </form>
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