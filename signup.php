<?php
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "pass";  // ユーザー名のパスワード
$db['dbname'] = "loginManagement";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$SignUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["mailaddress"])) {  // 値が空のとき
        $errorMessage = 'mailaddressが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["mailaddress"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] == $_POST["password2"] && filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) {
        // 入力したユーザIDとパスワードを格納
        $mailaddress = $_POST["mailaddress"];
        $password = $_POST["password"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO userData(mailaddress, password) VALUES (?, ?)");

            $stmt->execute(array($mailaddress, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $SignUpMessage = '登録が完了しました。あなたの登録ユーザIDは ' . $userid . ' です。パスワードは ' . $password . ' です。';  // ログイン時に使用するIDとパスワード
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
    } elseif ($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
    } elseif (filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL) == false) {
        $errorMessage = 'メールアドレスの書式が間違っています。';
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
</head>
<body>
<h1>新規登録画面</h1>
<!-- $_SERVER['PHP_SELF']はXSSの危険性があるので、actionは空にしておく -->
<!-- <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST"> -->
<form id="loginForm" name="loginForm" action="" method="POST">
    <fieldset>
        <legend>新規登録フォーム</legend>
        <div><font color="#ff0000"><?php echo $errorMessage ?></font></div>
        <div><font color="#0000ff"><?php echo $SignUpMessage ?></font></div>
        <label for="mailaddress">ユーザー名</label><input type="text" id="mailaddress" name="mailaddress"
                                                     placeholder="ユーザー名を入力"
                                                     value="<?php if (!empty($_POST["mailaddress"])) {
                                                         echo htmlspecialchars($_POST["mailaddress"], ENT_QUOTES);
                                                     } ?>">
        <br>
        <label for="password">パスワード</label><input type="password" id="password" name="password" value=""
                                                  placeholder="パスワードを入力">
        <br>
        <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value=""
                                                        placeholder="再度パスワードを入力">
        <br>
        <input type="submit" id="signUp" name="signUp" value="新規登録">
    </fieldset>
</form>
<br>
<form action="Login.php">
    <input type="submit" value="戻る">
</form>
</body>
</html>