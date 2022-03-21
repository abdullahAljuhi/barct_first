<?php
// class conected to database
require_once './db/connected.php';

/**
 * [ User Model]
 */

class User
{   
    // stoe conection
    private static $db;

    private $email;
    private $name;
    private $password;
    private $wallet;


    public function __construct()
    {

        $db = new connectedDb();
        self::$db = $db->concted();

    }

    /* 
     * @param mixed $name
     * @param mixed $email
     * @param mixed $pass
     * 
     * @return [user]
     */
    public function create($name, $email, $pass)
    {

        // Create new user
        $this->name = $name;
        $this->email = $email;
        $this->password = $pass;
        $query = 'INSERT INTO users (name, email ,password) '
            . 'VALUES ("' . $name . '", "' . $email . '","' . $pass . '")';

        self::$db->query($query);
        $id = mysqli_insert_id(self::$db);
        $this->wallet = new Wallet($id,0,'');
    }

    // get All users
    /**
     * @return [array]
     */
    public function getAll()
    {
        $q = "select * users";
        $users = self::$db->query($q);
        return $users;
    }

    /**
     * @param mixed $id
     * @param mixed $name
     * @param mixed $email
     * @param mixed $pass
     * 
     * @return [bool]
     */
    public function update($id, $name, $email, $pass)
    {
        // Update existing user
        if (self::getUser($id)) {
        
            $sql = 'UPDATE users SET name="' . $name . '",email="' . $email . '" password="' . $pass . '" WHERE id=' . $id;
            
            $update = self::$db->query($sql);
            
            return $update;
        } else {

            return false;
        }
    }

    /**delete User
     * 
     * @param mixed $id
     * 
     * 
     * @return [bool]
     */
    public function delete($id)
    {
        if (self::getUser($id)) {
            $q = "delete from users where id=$id";
            $del = self::$db->query($q);
            return $del;
        } else {
            return false;
        }
    }

    /**
     * @param mixed $email
     * @param mixed $pass
     * 
     * @return [user OR bool]
     */
    public static function checkUser($email, $pass)
    {
        $db = new connectedDb();
        self::$db = $db->concted();
        $q = "SELECT * FROM users
									WHERE
                                        email = '$email'
									AND
										Password ='$pass' ";
            // check user existe
        if ($user = self::$db->query($q)) {
    
            $user = mysqli_fetch_assoc($user);

            return $user;
        } else {
            return false;
        }

    }
}
