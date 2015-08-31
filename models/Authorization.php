<?php
Class Authorization
{
    public static function authoriz($login, $pass)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM company '
            . 'WHERE email = :email AND password = :password';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $login, PDO::PARAM_STR);
        $hash = md5($pass);
        $result->bindParam(':password', $hash, PDO::PARAM_STR);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }
}