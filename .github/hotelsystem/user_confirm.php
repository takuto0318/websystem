<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ユーザー情報確認</title>
</head>
<body>
    <h1>ユーザー情報確認</h1>
    <?php
    // ユーザー情報を取得
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    echo '名前：' . $name . '<br>';
    echo '電話番号：' . $phone . '<br>';
    echo 'メールアドレス：' . $email . '<br>';
    ?>
    <form action="reserve.php" method="post">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <button type="submit">予約</button>
    </form>
    <form action="user.php" method="post">
        <button type="submit">修正</button>
    </form>
</body>
</html>
