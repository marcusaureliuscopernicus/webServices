<?php
class DB
{
    private static $conn;
    public static function getConnect()
    {
        if(!self::$conn)
        {
            $connectStr = "mysql:dbname=".DB_NAME.";host=".DB_HOST."";
            self::$conn = new PDO ($connectStr, DB_USER, DB_PASS);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}
