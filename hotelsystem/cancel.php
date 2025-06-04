<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>予約キャンセル</title>
</head>
<body>
    <h1>予約キャンセル</h1>
    <?php
    // データベースに接続
    $link = mysqli_connect('127.0.0.1', 'root', 'dbpass');
    mysqli_select_db($link, 'HotelReservation');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room'])) {
        // フォームから送信され、部屋が選択された場合、選択された部屋の予約をキャンセル
        $room = $_POST['room'];
        mysqli_query($link, "DELETE FROM Reservations WHERE room_id = $room");
        mysqli_query($link, "UPDATE Rooms SET status = 'available' WHERE id = $room");
        echo '選択された部屋の予約をキャンセルしました。<br>';
    }

    // 予約されている部屋を取得
    $result = mysqli_query($link, "SELECT * FROM Rooms WHERE status = 'reserved'");
    if (mysqli_num_rows($result) > 0) {
        // 予約されている部屋がある場合、キャンセルフォームを表示
        echo '<form action="cancel.php" method="post">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<input type="radio" name="room" value="' . $row['id'] . '">' . $row['name'] . '<br>';
        }
        echo '<button type="submit">選択した部屋の予約をキャンセル</button>';
        echo '</form>';
    } else {
        // 予約されている部屋がない場合、メッセージを表示
        echo '現在、予約されている部屋はありません。';
    }

    mysqli_close($link);
    ?>
    <form action="admin.php" method="post">
        <button type="submit">管理者画面に戻る</button>
    </form>
</body>
</html>
