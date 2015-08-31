<?php
class Technology
{
    const SHOW_BY_DEFAULT = Market::SHOW_BY_DEFAULT;

    public static function getAllTechnology($page,$type_action=1)
    {
        $limit = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

            // Текст запроса к БД
            $sql = 'SELECT * FROM technology WHERE id_type_action = :types '
                . 'ORDER BY id_technology DESC LIMIT :limit OFFSET :offset';
            // Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':limit', $limit, PDO::PARAM_INT);
            $result->bindParam(':offset', $offset, PDO::PARAM_INT);
            $result->bindParam(':types', $type_action, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            // Выполнение коменды
            $result->execute();

        $i=0;
        $technologyList = array();
        while($row = $result->fetch()){
            $technologyList[$i]['id_technology'] = $row['id_technology'];
            $technologyList[$i]['id_company'] = $row['id_company'];
            $technologyList[$i]['name_company'] = Market::getCompanyNameById($row['id_company']);
            $technologyList[$i]['opisanie_technology'] = $row['opisanie_technology'];
            $technologyList[$i]['phone'] = self::getPhoneById($row['id_company']);
            $technologyList[$i]['data_actuality'] = $row['data_actuality'];
            $technologyList[$i]['id_type_action'] = $row['id_type_action'];
            $i++;
        }
        return $technologyList;
    }

    public static function getTotalTechnology($type_action=1)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id_technology) AS count FROM technology WHERE id_type_action = :type_action';
        $result = $db->prepare($sql);
        $result->bindParam(':type_action',$type_action,PDO::PARAM_INT);


        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    public static function getPhoneById($id_company)
    {
        //Соединяемся с БД
        $db = Db::getConnection();

        $sql = 'SELECT tel FROM company WHERE id_company = :id_company';
        $result = $db->prepare($sql);
        $result->bindParam(':id_company',$id_company,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        //Выполняем запрос
        $result->execute();
        $company_name = $result->fetch();
        //Возвращаем Телефон компании
        return $company_name['tel'];
    }

    public static function insertTechnology($id_company, $opisanie,$date, $id_type_action)
    {
        $db = Db::getConnection();
        $insert_technology_query = "INSERT INTO technology (id_company,opisanie_technology, data_actuality, id_type_action)";
        $insert_technology_query.= " VALUES(:id_company, :opisanie,:date ,:id_type_action)";

        $result = $db->prepare($insert_technology_query);
        $result->bindParam(':id_company',$id_company,PDO::PARAM_INT);
        $result->bindParam(':opisanie',$opisanie,PDO::PARAM_STR);
        $result->bindParam(':date',$date,PDO::PARAM_STR);
        $result->bindParam(':id_type_action',$id_type_action,PDO::PARAM_INT);

        $result->execute();

        if($result) {
            $data['error'] = 0;
            $data['msg']="Объявление успешно добавлено";
        }
        else {
            $data['error'] = 1;
            $data['msg']="Ошибка!!Обратитесь в службу поддержки";
        }
        return $data;
    }
}