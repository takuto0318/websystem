<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>管理者ログイン</title>
</head>
<body>
    <h1>管理者ログイン</h1>
    <form action="admin.php" method="post">
        ユーザーID：<input type="text" name="userid"><br>
        パスワード：<input type="password" name="password"><br>
        <button type="submit">ログイン</button>
    </form>
    <form action="index.php" method="post">
        <button type="submit">戻る</button>
    </form>
</body>
</html>
