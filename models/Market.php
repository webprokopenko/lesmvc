<?php

/**
 * Class Market - модель для работы с Рынком продаж и покупок
 */
class Market
{
    const SHOW_BY_DEFAULT = 18;

    /**
     * @param $id_company - id компании
     * @return mixed - возвращает имя компании
     */
    public static function getCompanyNameById($id_company)
    {
        //Соединяемся с БД
        $db = Db::getConnection();

        $sql = 'SELECT name_company FROM company WHERE id_company = :id_company';
        $result = $db->prepare($sql);
        $result->bindParam(':id_company',$id_company,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        //Выполняем запрос
        $result->execute();
        $company_name = $result->fetch();
        //Возвращаем Имя компании
        return $company_name['name_company'];
    }

    /**
     * @param $id_category - id категории
     * @return mixed - возвращает имя категории товара
     */
    public static function getProdCategoryNameById($id_category)
    {
        //Соединяемся с БД
        $db = Db::getConnection();

        $sql = 'SELECT name_category FROM prod_category WHERE id_category = :id_category';
        $result = $db->prepare($sql);
        $result->bindParam(':id_category',$id_category,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        //Выполняем запрос
        $result->execute();
        $category_name = $result->fetch();
        //Возвращаем Название категории
        return $category_name['name_category'];
    }

    /**
     * @param $id_country - id страны
     * @return mixed - возвращает Имя страны
     */
    public static function getCountryNameById($id_country)
    {
        //Соединяемся с БД
        $db = Db::getConnection();

        $sql = 'SELECT name_country FROM country WHERE id_country = :id_country';
        $result = $db->prepare($sql);
        $result->bindParam(':id_country',$id_country,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        //Выполняем запрос
        $result->execute();
        $country_name = $result->fetch();
        //Возвращаем Название категории
        return $country_name['name_country'];
    }

    /**
     * @param int $page - №страници
     * @return array - возвращает массив со всеми объявлениями в таблице market_tovar_q
     */
    public static function getAllMarket($page)
    {
        $limit = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM market_tovar_q '
            . 'ORDER BY id_market ASC LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $i=0;
        $marketList = array();
        while($row = $result->fetch()){
            $marketList[$i]['id_market'] = $row['id_market'];
            $marketList[$i]['id_company'] = $row['id_company'];
            $marketList[$i]['name_company'] = self::getCompanyNameById($row['id_company']);
            $marketList[$i]['id_prod_category'] = $row['id_prod_category'];
            $marketList[$i]['name_prod_category'] = self::getProdCategoryNameById($row['id_prod_category']);
            $marketList[$i]['id_country_proish'] = $row['id_country_proish'];
            $marketList[$i]['name_country'] = self::getCountryNameById($row['id_prod_category']);
            $marketList[$i]['cena'] = $row['cena'];
            $marketList[$i]['col_vo'] = $row['col_vo'];
            $marketList[$i]['data_actuality'] = $row['data_actuality'];
            $marketList[$i]['id_type_action'] = $row['id_type_action'];
            $i++;
        }
        return $marketList;
    }

    /**
     * @param $page - paginator action
     * @param $action - тип объявления (1 - покупка, 2-продажа)
     * @return array - массив данных
     */
    public static function getMarketByAction($page,$action)
    {
        $limit = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM market_tovar_q WHERE id_type_action= :action '
            . 'ORDER BY id_market DESC LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->bindParam(':action', $action, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $i=0;
        $marketList = array();
        while($row = $result->fetch()){
            $marketList[$i]['id_market'] = $row['id_market'];
            $marketList[$i]['id_company'] = $row['id_company'];
            $marketList[$i]['name_company'] = self::getCompanyNameById($row['id_company']);
            $marketList[$i]['id_prod_category'] = $row['id_prod_category'];
            $marketList[$i]['name_prod_category'] = self::getProdCategoryNameById($row['id_prod_category']);
            $marketList[$i]['id_country_proish'] = $row['id_country_proish'];
            $marketList[$i]['name_country'] = self::getCountryNameById($row['id_prod_category']);
            $marketList[$i]['cena'] = $row['cena'];
            $marketList[$i]['col_vo'] = $row['col_vo'];
            $marketList[$i]['data_actuality'] = $row['data_actuality'];
            $marketList[$i]['id_type_action'] = $row['id_type_action'];
            $i++;
        }
        return $marketList;
    }


    public static function getTotalMarket($category=false)
    {
        // Соединение с БД
        $db = Db::getConnection();

        if($category===false){
            // Текст запроса к БД
            $sql = 'SELECT count(id_market) AS count FROM market_tovar_q';
            $result = $db->prepare($sql);
        }else{
            // Текст запроса к БД
            $sql = 'SELECT count(id_market) AS count FROM market_tovar_q WHERE id_prod_category = :category';
            $result = $db->prepare($sql);
            $result->bindParam(':category',$category,PDO::PARAM_INT);
        }

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    public static function insertMarket($id_company, $id_prod_category, $id_country_proish, $cena, $col_vo, $data_actuality, $id_type_action)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $insert_market_query = "INSERT INTO market_tovar_q (id_company, id_prod_category, id_country_proish, cena, col_vo, data_actuality, id_type_action)";
        $insert_market_query.= " VALUES(:id_company, :id_prod_category, :id_country_proish, :cena, :col_vo, :data_actuality, :id_type_action)";

        $result = $db->prepare($insert_market_query);
        $result->bindParam(':id_company',$id_company,PDO::PARAM_INT);
        $result->bindParam(':id_prod_category',$id_prod_category,PDO::PARAM_INT);
        $result->bindParam(':id_country_proish',$id_country_proish,PDO::PARAM_INT);
        $result->bindParam(':cena',$cena,PDO::PARAM_INT);
        $result->bindParam(':col_vo',$col_vo,PDO::PARAM_INT);
        $result->bindParam(':data_actuality',$data_actuality,PDO::PARAM_STR);
        $result->bindParam(':id_type_action',$id_type_action,PDO::PARAM_STR);

        if($result->execute()) {
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