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

    public static function verify_user() {
        global $db;
        $username = $db->escape_string($username);
        $password = $db->escape_string($password);
        $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
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
}

?>