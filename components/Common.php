<?php
Class Common
{
    public static function getUsernameById($id_company)
    {
        $db = DB::getConnection();
        $sql = 'SELECT name_sotr FROM company '
            . 'WHERE id_company = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id_company, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data = $result->fetch();
        return $data['name_sotr'];
    }

    public static function getCategoryProduction()
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM prod_category';

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $list_category = array();
        while($row = $result->fetch()){
            $list_category.="<option value='".$row['id_category']."'>".$row['name_category']."</option>";
        }

        return $list_category;
    }

    public static function getCountry()
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM country';

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $list_country = array();
        while($row = $result->fetch()){
            $list_country.="<option value='".$row['id_country']."'>".$row['name_country']."</option>";
        }

        return $list_country;
    }

    static function token(){
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        return $_SESSION['token'];
    }
}