<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>部屋予約</title>
</head>
<body>
    <h1>部屋予約</h1>
    <?php
    // ユーザー情報を取得
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // データベースに接続
    $link = mysqli_connect('127.0.0.1', 'root', 'dbpass');
    mysqli_select_db($link, 'HotelReservation');

    // 空き部屋を取得
    $result = mysqli_query($link, "SELECT * FROM Rooms WHERE status = 'available'");
    if (mysqli_num_rows($result) > 0) {
        // 空き部屋がある場合、予約フォームを表示
        echo '<form action="confirm.php" method="post">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<input type="radio" name="room" value="' . $row['id'] . '">' . $row['name'] . '<br>';
        }
        echo '<input type="hidden" name="name" value="' . $name . '">';
        echo '<input type="hidden" name="phone" value="' . $phone . '">';
        echo '<input type="hidden" name="email" value="' . $email . '">';
        echo '<button type="submit">予約</button>';
        echo '</form>';
    } else {
        // 空き部屋がない場合、メッセージを表示
        echo '申し訳ありません、現在空き部屋はありません。';
    }

    mysqli_close($link);
    ?>
    <form action="index.php" method="post">
        <button type="submit">戻る</button>
    </form>
</body>
</html>
