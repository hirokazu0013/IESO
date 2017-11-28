<?php

/**
 * common.php
 */

/**
 * connect_db
 * @return \PDO
 */
// データベースサーバへの接続
function connect_db()
{
$username = "co-735.it.3919.c";
$password = "Mbiu8rt";
$dbname = "co_735_it_3919_com";
$dsn = 'mysql:host=localhost;dbname=co_735_it_3919_com;charset=Shift_JIS';
$options = PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC;
    return new PDO($dsn, $username, $password, $options);
}

/**
 * insert
 * @param string $sql
 * @param array $arr
 * @return int lastInsertId
 */
function insert($sql, $arr)
{
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $pdo->lastInsertId();
}

/**
 * select
 * @param string $sql
 * @param array $arr
 * @return array $rows
 */
function select($sql, $arr)
{
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $stmt->fetchAll();
}

/**
 * htmlspecialchars
 * @param string $string
 * @return $string
 */
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'Shift_JIS');
}