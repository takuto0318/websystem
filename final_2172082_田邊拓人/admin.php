<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>管理者画面</title>
</head>
<body>
    <?php
    // セッションを開始
    session_start();

    // ユーザーIDとパスワードを取得
    $userid = $_POST['userid'] ?? $_SESSION['userid'] ?? null;
    $password = $_POST['password'] ?? $_SESSION['password'] ?? null;

    // ユーザーIDとパスワードが正しいかチェック
    if ($userid === '1234' && $password === 'tanabe') {
        // ユーザーIDとパスワードが正しい場合、管理者画面を表示

        // ユーザーIDとパスワードをセッションに保存
        $_SESSION['userid'] = $userid;
        $_SESSION['password'] = $password;

        echo '<h1>管理者画面</h1>';

        // データベースに接続
        $link = mysqli_connect('127.0.0.1', 'root', 'dbpass');
        mysqli_select_db($link, 'HotelReservation');

        // 部屋の予約状況を取得
        $result = mysqli_query($link, "SELECT * FROM Rooms");
        while ($row = mysqli_fetch_assoc($result)) {
            $status = $row['status'] === 'available' ? '予約なし' : '予約済み';
            echo '日付：' . $row['date'] . ', 予約状況：' . $status . '<br>';
        }
                mysqli_close($link);
        ?>
        <form action="cancel.php" method="post">
            <button type="submit">予約のキャンセル</button>
        </form>
        <form action="check.php" method="post">
            <button type="submit">予約状況の確認</button>
        </form>
        <form action="index.php" method="post">
            <button type="submit">戻る</button>
        </form>
        <?php
    } else {
        // ユーザーIDとパスワードが正しくない場合、エラーメッセージを表示
        echo 'ユーザーIDまたはパスワードが正しくありません。';
        ?>
        <form action="admin_login.php" method="post">
            <button type="submit">戻る</button>
        </form>
        <?php
    }
    ?>
</body>
</html>
