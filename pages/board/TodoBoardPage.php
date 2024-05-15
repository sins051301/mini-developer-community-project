<?php
//session_unset();
session_start(); 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Developer-community-board</title>
    <link rel="stylesheet" href="../../reset.css" />
    <link rel="stylesheet" href="TodoBoardPage.css" />
</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="main-log">
                <img id="header-img" src="../../img/sejonglogo.png" alt="LogoImg">
            </div>
            <div>
                <?php
                // 세션에 저장된 데이터 확인
                if(isset($_SESSION['Login_id'])) {
                    echo $_SESSION['Login_id'];
                    echo"|";
                    echo "<a href='../utils/LogOut.php'>Logout</a>";
                } else {
                    echo "<div class='menu'>";
                    echo "<a href='../../pages/UserAddPage.php'>회원가입</a>";
                    echo"|";
                    echo "<a href='../../pages/LoginPage.php'>로그인</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </header>
    <div class="content-wrap">
        <nav>
            <?php
            echo "<a href=\"../../pages/UserWriteTodoList.php?id={$_SESSION['Login_id']}\">";
            echo "내가 할일";
            echo "</a>";
        ?>
            <a href="">게시판</a>
            <a href="">공부 정리</a>
        </nav>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="110">카테고리</th>
                    <th width="120">글쓴이</th>
                    <th width="500">작성일</th>
                    <th width="100">추천수</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
            <tbody>
                <?php
        // 데이터베이스에서 가져온 각각의 레코드에 대해 반복하여 출력
        $db = mysqli_connect('localhost', 'root', '', 'userdata') or die('Unable to connect. Check your connection parameters.');
        $sql = mysqli_query($db, "SELECT * FROM userboardtable ORDER BY SID DESC LIMIT 0,10");
        while ($board = mysqli_fetch_assoc($sql)) {
            ?>
                <tr>
                    <td width="70"><?php echo $board['SID']; ?></td>
                    <td width="110">
                        <?php echo "<a href='TodoView.php?Login_id={$_SESSION['Login_id']}&Login_board_id={$board['Login_board_id']}'/>"?><?php echo $board['Board_category']; ?>
                    </td>
                    <td width="120"><?php echo $board['Login_board_id']; ?></td>
                    <td width="500"><?php echo $board['Create_board_date']; ?></td>
                    <td width="100"><?php echo $board['Board_thumb']; ?></td>
                    <td width="100"><?php echo $board['Board_view']; ?></td>
                </tr>
                <?php
        }
        ?>
            </tbody>
        </table>
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