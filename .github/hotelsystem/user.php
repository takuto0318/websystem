<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ユーザー情報入力</title>
</head>
<body>
    <h1>ユーザー情報入力</h1>
    <form action="user_confirm.php" method="post">
        名前：<input type="text" name="name"><br>
        電話番号：<input type="text" name="phone"><br>
        メールアドレス：<input type="text" name="email"><br>
        <button type="submit">送信</button>
    </form>
    <form action="index.php" method="post">
        <button type="submit">戻る</button>
    </form>
</body>
</html>
