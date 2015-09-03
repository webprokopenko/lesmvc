<?php
class Equipment
{
    const SHOW_BY_DEFAULT = Market::SHOW_BY_DEFAULT;

    public static function getEquipmentByAction($page,$action)
    {
        $limit = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM equipment WHERE id_type_action= :action '
            . 'ORDER BY id_equipment DESC LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->bindParam(':action', $action, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $i=0;
        $equipmentList = array();
        while($row = $result->fetch()){
            $equipmentList[$i]['id_equipment'] = $row['id_equipment'];
            $equipmentList[$i]['id_company'] = $row['id_company'];
            $equipmentList[$i]['name_company'] = Market::getCompanyNameById($row['id_company']);
            $equipmentList[$i]['nazvanie'] = $row['nazvanie'];
            $equipmentList[$i]['model'] = $row['model'];
            $equipmentList[$i]['status_equipment'] = self::getStatusEquipmentById($row['status_equipment']);
            $equipmentList[$i]['foto'] = $row['foto'];
            $equipmentList[$i]['cena'] = $row['cena'];
            $equipmentList[$i]['data_actuality'] = $row['data_actuality'];
            $equipmentList[$i]['id_type_action'] = $row['id_type_action'];
            $i++;
        }
        return $equipmentList;
    }
    public static function getStatusEquipmentById($id_equipment)
    {
        //Соединяемся с БД
        $db = Db::getConnection();

        $sql = 'SELECT name_status_equipment FROM status_equipment_slv WHERE id_status_equipment = :id_equipment';
        $result = $db->prepare($sql);
        $result->bindParam(':id_equipment',$id_equipment,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        //Выполняем запрос
        $result->execute();
        $company_name = $result->fetch();
        //Возвращаем Имя компании
        return $company_name['name_status_equipment'];
    }
    public static function getTotalEquipment($category=false)
    {
        // Соединение с БД
        $db = Db::getConnection();

        if($category===false){
            // Текст запроса к БД
            $sql = 'SELECT count(id_equipment) AS count FROM equipment';
            $result = $db->prepare($sql);
        }else{
            // Текст запроса к БД
            $sql = 'SELECT count(id_equipment) AS count FROM equipment WHERE id_equipment = :category';
            $result = $db->prepare($sql);
            $result->bindParam(':category',$category,PDO::PARAM_INT);
        }

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    public static function getListStatusEquipment()
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM status_equipment_slv';

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $list_category = array();
        while($row = $result->fetch()){
            $list_category.="<option value='".$row['id_status_equipment']."'>".$row['name_status_equipment']."</option>";
        }

        return $list_category;
    }

    public static function insertEquipment($id_company, $nazvanie, $model, $status_equipment, $cena, $data_actuality,$id_type_action,$filename)
    {
        $insert_equipment_query = "INSERT INTO equipment (id_company,nazvanie, model, status_equipment,cena, data_actuality, id_type_action,foto) ";
        $insert_equipment_query.= " VALUES(:id_company, :nazvanie, :model,:status_equipment ,:cena, :data_actuality, :id_type_action,:filename)";

        $db = Db::getConnection();

        $result = $db->prepare($insert_equipment_query);
        $result->bindParam(':id_company', $id_company, PDO::PARAM_INT);
        $result->bindParam(':nazvanie', $nazvanie, PDO::PARAM_STR);
        $result->bindParam(':model', $model, PDO::PARAM_STR);
        $result->bindParam(':status_equipment', $status_equipment, PDO::PARAM_INT);
        $result->bindParam(':cena', $cena, PDO::PARAM_STR);
        $result->bindParam(':data_actuality', $data_actuality, PDO::PARAM_STR);
        $result->bindParam(':id_type_action', $id_type_action, PDO::PARAM_INT);
        $result->bindParam(':filename', $filename, PDO::PARAM_STR);


        // Выполнение коменды
        $data = $result->execute();
        //$data = $result->errorInfo();

        return $data;
    }
}