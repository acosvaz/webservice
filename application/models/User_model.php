<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
{
	public function __construct() {
        parent::__construct();
    }

    protected $user_app = 'users_app';

    /**
     * Use Registration
     * @param: {array} User Data
     */
    public function insert_user(array $data) {
        $this->db->insert($this->user_app, $data);
        return $this->db->insert_id();
    }

    /**
     * User Login
     * ----------------------------------
     * @param: username or email address
     * @param: password
     */
    public function user_login($username, $password)
    {
        $this->db->where('email', $username);
        $this->db->or_where('username', $username);
        $q = $this->db->get($this->user_app);

        if( $q->num_rows() ) 
        {
            $user_pass = $q->row('password');
            if(sha1($password) === $user_pass) {
                return $q->row();
            }
            return FALSE;
        }else{
            return FALSE;
        }
    }
}
