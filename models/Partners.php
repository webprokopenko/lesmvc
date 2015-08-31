<?php
class Partners
{
    const SHOW_BY_DEFAULT = Market::SHOW_BY_DEFAULT;

    public static function getAllPartners($page)
    {
        $limit = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM partner '
            . 'ORDER BY id_partner DESC LIMIT :limit OFFSET :offset';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполнение коменды
        $result->execute();

        $i=0;
        $partnerList = array();
        while($row = $result->fetch()){
            $partnerList[$i]['id_company'] = $row['id_company'];
            $partnerList[$i]['name_company'] = Market::getCompanyNameById($row['id_company']);
            $partnerList[$i]['opisanie_partner'] = $row['opisanie_partner'];
            $partnerList[$i]['phone'] = Technology::getPhoneById($row['id_company']);
            $partnerList[$i]['data_actuality'] = $row['data_actuality'];
            $i++;
        }
        return $partnerList;
    }
    public static function getTotalPartners()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id_partner) AS count FROM partner ';
        $result = $db->prepare($sql);


        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    public static function addPartner($id_company,$opisanie,$date)
    {
        $db = Db::getConnection();

        $insert_partner_query = "INSERT INTO partner (id_company,opisanie_partner, data_actuality)";
        $insert_partner_query.= " VALUES(:id_company, :opisanie,:date)";
        $result = $db->prepare($insert_partner_query);

        $result->bindParam(':id_company',$id_company,PDO::PARAM_INT);
        $result->bindParam(':opisanie',$opisanie,PDO::PARAM_STR);
        $result->bindParam(':date',$date,PDO::PARAM_STR);

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