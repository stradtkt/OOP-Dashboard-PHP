<?php 

class User {
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users() {
        // global $db;
        // $result_set = $db->query("SELECT * FROM users");
        // return $result_set;
        return self::find_this_query("SELECT * FROM users");
    }

    public static function find_user_by_id($user_id) {
        global $db;
        $result_set = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
        if(!empty($result_set)) {
            $first_item = array_shift($result_set);
            return $first_item;
        } else {
            return false;
        }
        return $found_user;
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

    public static function verify_user($username, $password) {
        global $db;
        $uname = $db->escape_string($username);
        $pass = $db->escape_string($password);
        $sql = "SELECT * FROM users WHERE username = '{$uname}' AND password = '{$pass}' LIMIT 1";
        $result_set = self::find_this_query($sql);
        if(!empty($result_set)) {
            $first_item = array_shift($result_set);
            return $first_item;
        } else {
            return false;
        }
    }

    public static function instantiation($the_record) {
        $the_object = new self;
        // $the_object->username = $found_user['username'];
        // $the_object->password = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name = $found_user['last_name'];
        foreach($the_record as $key => $value) {
            if($the_object->has_the_attribute($key)) {
                $the_object->$key = $value;
            }
        }
        return $the_object;
    }

    private function has_the_attribute($key) {
        $object_properties = get_object_vars($this);
        return array_key_exists($key, $object_properties);
    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $db;
        $sql = "INSERT INTO users (username, password, first_name, last_name) ";
        $sql .= "VALUES ('";
        $sql .= $db->escape_string($this->username) . "', '";
        $sql .= $db->escape_string($this->password) . "', '";
        $sql .= $db->escape_string($this->first_name) . "', '";
        $sql .= $db->escape_string($this->last_name) . "')";
        if($db->query($sql)) {
            $this->id = $db->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $db;
        $sql = "UPDATE users SET ";
        $sql .= "username= '" . $db->escape_string($this->username) . "', ";
        $sql .= "password= '" . $db->escape_string($this->password) . "', ";
        $sql .= "first_name= '" . $db->escape_string($this->first_name) . "', ";
        $sql .= "last_name= '" . $db->escape_string($this->last_name) . "' ";
        $sql .= " WHERE id= " . $db->escape_string($this->id);
        $db->query($sql);
        return (mysqli_affected_rows($db->con) == 1) ? true : false;
    }

    public function delete() {
        global $db;
        $sql = "DELETE FROM users WHERE id=" . $db->escape_string($this->id) . " LIMIT 1";
        $db->query($sql);
        return (mysqli_affected_rows($db->con) == 1) ? true : false;
    }
}

?>