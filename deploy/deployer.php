<?php
define('APP_ROOT_DIR', 'www/smareco/');

echo "# FTP通信開始\n";

$host = getenv('SAKURA_FTP_HOST');
$user = getenv('SAKURA_FTP_USER');
$pass = getenv('SAKURA_FTP_PASS');

echo "## ログイン開始\n";

if (strlen($host) === 0) {
    throw new Exception('ホストが不明です。');
}

if (strlen($user) === 0) {
    throw new Exception('ユーザーが不明です。');
}

if (strlen($pass) === 0) {
    throw new Exception('パスワードが不明です。');
}

$connection = ftp_connect($host);

if ($connection === false) {
    throw new Exception('通信に失敗しました。');
}

if (!ftp_login($connection, $user, $pass)) {
    throw new Exception('ログインに失敗しました。');
}

echo "### ファイルアップロード開始\n";

$uploadFile = 'src.tar.gz';
$remoteFile = APP_ROOT_DIR . $uploadFile;

if (!file_exists($uploadFile)) {
    throw new Exception('ソースコードが存在しません。');
}

if (!ftp_pasv($connection, true)) {
    throw new Exception('パッシブモードへの変更に失敗しました。');
}

$bakFile = $remoteFile . '.' . date('YmdHis');

ftp_rename($connection, $remoteFile, $bakFile);

if (!ftp_put($connection, $remoteFile, $uploadFile, FTP_BINARY, false)) {
    throw new Exception('コンテンツの更新に失敗しました。');
}

$uploadDeployer = 'deployer.sh';
$remoteDeployer = APP_ROOT_DIR . $uploadDeployer;

if (!file_exists($uploadDeployer)) {
    throw new Exception('deploy用のファイルが見つかりませんでした。');
}

if (!ftp_put($connection, $remoteDeployer, $uploadDeployer, FTP_BINARY, false)) {
    throw new Exception('コンテンツの更新に失敗しました。');
}

ftp_close($connection);

echo "# FTP通信終了\n";
