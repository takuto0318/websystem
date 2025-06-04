<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>予約確認</title>
</head>
<body>
    <h1>予約確認</h1>
    <?php
    // ユーザー情報を取得
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (isset($_POST['room'])) {
        // 部屋が選択されている場合
        $room = $_POST['room'];

        // データベースに接続
        $link = mysqli_connect('127.0.0.1', 'root', 'dbpass');
        mysqli_select_db($link, 'HotelReservation');

        // ユーザーが既に存在するかチェック
        $result = mysqli_query($link, "SELECT id FROM Users WHERE name = '$name' AND phone = '$phone' AND email = '$email'");
        if (mysqli_num_rows($result) > 0) {
            // ユーザーが存在する場合、そのIDを取得
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];
        } else {
            // ユーザーが存在しない場合、新たにユーザーを追加
            mysqli_query($link, "INSERT INTO Users (name, phone, email) VALUES ('$name', '$phone', '$email')");
            $userId = mysqli_insert_id($link);
        }

        // 部屋の予約をデータベースに追加
        mysqli_query($link, "INSERT INTO Reservations (user_id, room_id) VALUES ($userId, $room)");

        // 部屋のステータスを更新
        mysqli_query($link, "UPDATE Rooms SET status = 'reserved' WHERE id = $room");

        echo '予約が完了しました。<br>';
        echo '名前：' . $name . '<br>';
        echo '電話番号：' . $phone . '<br>';
        echo 'メールアドレス：' . $email . '<br>';

        mysqli_close($link);
    } else {
        // 部屋が選択されていない場合、エラーメッセージを表示
        echo '部屋が選択されていません。';
    }
    ?>
    <form action="index.php" method="post">
        <button type="submit">戻る</button>
    </form>
</body>
</html>
