<?php 

class Photo {
    protected static $db_table = "photos";
    public $title;
    public $description;
    public $filename;
    public $photo_type;
    public $size;

    public static function find_all_photos() {
        return self::find_this_query("SELECT * FROM photos");
    }

    public static function find_this_query($sql) {
        global $db;
        $result_set = $db->query($sql);
        $object_array = array();
        while($row = mysqli_fetch_array($result_set)) {
            $object_array[] = self::instantiation($row);
        }
        return $object_array;
    }

    public function create() {
        global $db;
        $sql = "INSERT INTO ". self::$db_table ." (title, description, filename, photo_type, size) ";
        $sql .= "VALUES ('";
        $sql .= $db->escape_string($this->title) . "', '";
        $sql .= $db->escape_string($this->description) . "', '";
        $sql .= $db->escape_string($this->filename) . "', '";
        $sql .= $db->escape_string($this->photo_type) . "', ";
        $sql .= $db->escape_string($this->size) . "')";
        if($db->query($sql)) {
            $this->id = $db->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $db;
        $sql = "UPDATE ". self::$db_table ." SET ";
        $sql .= "title= '" . $db->escape_string($this->title) . "', ";
        $sql .= "description= '" . $db->escape_string($this->description) . "', ";
        $sql .= "filename= '" . $db->escape_string($this->filename) . "', ";
        $sql .= "photo_type= '" . $db->escape_string($this->photo_type) . "', ";
        $sql .= "size= '" . $db->escape_string($this->size) . "' ";
        $sql .= " WHERE id= " . $db->escape_string($this->id);
        $db->query($sql);
        return (mysqli_affected_rows($db->con) == 1) ? true : false;
    }

    public function delete() {
        global $db;
        $sql = "DELETE FROM ". self::$db_table ." WHERE id=" . $db->escape_string($this->id) . " LIMIT 1";
        $db->query($sql);
        return (mysqli_affected_rows($db->con) == 1) ? true : false;
    }

}