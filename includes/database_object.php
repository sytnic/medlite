<?php

class DatabaseObject {    
    
    // Здесь используется позднее статическое связывание: static вместо self, -
    // здесь вызываются методы подкласса, расширяющие этот класс,
    // атрибут $table_name также берётся из подкласса, а не здесь.

    // returns array of all objects
    public static function find_all() {
        return static::find_by_sql("SELECT * FROM ".static::$table_name);
    }

      // returns array of objects
    public static function find_by_sql($sql="") {
        global $database;

        $result_set = $database->query($sql);
        $object_array = array();
           while ($row = $database->fetch_array($result_set)) {
           // while ($row = mysqli_fetch_assoc($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        // массив из объектов
        return $object_array;
    }

     /**
     * @return string
     */
    public static function count_all() {
        global $database;

        $sql = "SELECT COUNT(*) FROM ".static::$table_name;
        $result_set = $database->query($sql);
        // массив
        $row = $database->fetch_array($result_set);
        // строка
        return array_shift($row);
    }

       // предоставляется массив (row, mix array from db)
      // возвращается объект этого класса
    public static function instantiate($record) {
            // Простой, но долгий способ:
            // нужно проверять каждую запись в БД
            // на то, что она существует и является массивом,
            // и необходимо сюда добавить связь с каждым столбцом из БД,
            // но их может быть и 50
            $object = new static;
            
        // for Late Static Binding possible:   
        //    $class_name = get_called_class();
        //    $object = new $class_name;        
            
        //    $object->id         = $record['id'];
        //    $object->username   = $record['username'];
        //    $object->password   = $record['password'];
        //    $object->first_name = $record['first_name'];
        //    $object->last_name  = $record['last_name'];
        
        // Короткий, динамический способ
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
            
            return $object;
    }
    
    // должно быть private, для отладки public
    private function has_attribute($attribute) {
        // get_object_vars returns an associative array with all attributes 
        // (incl. private ones!) as the keys and their current values as the value
        
        //$object_vars = get_object_vars($this);
        // или, что то же самое
        $object_vars = $this->attributes();

        // We don't care about the value, we just want to know if the key exists
        // Will return true or false

        return array_key_exists($attribute, $object_vars);
    }

    
    // для тестов public, изначально protected
    // не эскэйпенные атрибуты заданного объекта, массив
    public function attributes() {
        // return an assoc. array of attribute keys and their values
        // return get_object_vars($this);
        // get_object_vars имеет тот недостаток, что выбирает все свойства объекта,
        // вместо него можно перебирать нужные поля, перечисленные в начале подкласса:
        
        // return an array of attribute names and their values
        $attributes = array();
        foreach(static::$db_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    // для тестов public, изначально protected
    // эскэйпенные атрибуты заданного объекта, массив
    public function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach($this->attributes() as $key => $value){
        $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }


}
?>