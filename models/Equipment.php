<?php
class Equipment
{
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
}