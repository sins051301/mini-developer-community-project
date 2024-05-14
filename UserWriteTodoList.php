<?php
    // 데이터베이스 연결
session_start(); 
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
                <img id="header-img" src="./img/sejonglogo.png" alt="LogoImg">
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
            <form method="POST" action="">
                <div class="input-wrap">
                    <input type="text" id="toDo" placeholder="할 일 추가하기">
                    <button type="button" id="addButton">추가</button>
                </div>
                <div id="toDoList"></div>
                <div class="input-wrap2">
                    <input id="submit" type="submit" value="추가">
                </div>
                <div class="user-add">
                    <img src="./img/sejongwhite.png" alt="LogoImg">
                </div>
            </form>
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