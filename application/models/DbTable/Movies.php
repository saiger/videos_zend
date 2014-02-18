<?php

class Application_Model_DbTable_Movies extends Zend_Db_Table_Abstract
{

    protected $_name = 'videos';

    // Метод для получения записи по id
    public function getMovie($id){
        // Получаем id как параметр
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('id = ' . $id);



    }




}

