<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>予約状況の確認</title>
</head>
<body>
    <h1>予約状況の確認</h1>
    <?php
    // データベースに接続
    $link = mysqli_connect('127.0.0.1', 'root', 'dbpass');
    mysqli_select_db($link, 'HotelReservation');

    // 予約されている部屋を取得
    $result = mysqli_query($link, "SELECT Rooms.name, Users.name AS user_name, Users.phone, Users.email FROM Reservations INNER JOIN Rooms ON Reservations.room_id = Rooms.id INNER JOIN Users ON Reservations.user_id = Users.id");
    if (mysqli_num_rows($result) > 0) {
        // 予約されている部屋がある場合、予約情報を表示
        while ($row = mysqli_fetch_assoc($result)) {
            echo '部屋名：' . $row['name'] . ', 予約者：' . $row['user_name'] . ', 電話番号：' . $row['phone'] . ', メールアドレス：' . $row['email'] . '<br>';
        }
    } else {
        // 予約されている部屋がない場合、メッセージを表示
        echo '現在、予約されている部屋はありません。';
    }

    mysqli_close($link);
    ?>
    <form action="admin.php" method="post">
        <button type="submit">戻る</button>
    </form>
</body>
</html>
