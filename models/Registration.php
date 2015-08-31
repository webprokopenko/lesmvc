<?php
class Registration
{
    public static function addCompany($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO company '
            . '(name_company, name_sotr, dolzn_sotr, email, tel, country, adress, password, opisanie)'
            . 'VALUES '
            . '(:name_company, :name_sotr, :dolzn_sotr, :email, :tel, :country,'
            . ' :adress, :password, :opisanie)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);


        $result->bindParam(':name_company', $options['name_company'], PDO::PARAM_STR);
        $result->bindParam(':name_sotr', $options['name_sotr'], PDO::PARAM_STR);
        $result->bindParam(':dolzn_sotr', $options['dolzn_sotr'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':tel', $options['tel'], PDO::PARAM_STR);
        $result->bindParam(':country', $options['country'], PDO::PARAM_INT);
        $result->bindParam(':adress', $options['adress'], PDO::PARAM_STR);
        $result->bindParam(':password', $options['pass1'], PDO::PARAM_INT);
        $result->bindParam(':opisanie', $options['opisanie'], PDO::PARAM_INT);



        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        //print_r($result->errorInfo());

        // Иначе возвращаем 0
        return 0;
    }
}