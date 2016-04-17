<?php
/**
 * This model contains all functions for managing users
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */

class Users_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {

    }

    /**
     * Get the list of users or one user
     * @param int $id optional id of one user
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_users($id = 0) {
        $this->db->select('users.*');
        if ($id === 0) {
            $query = $this->db->get('users');
            return $query->result_array();
        }
        $query = $this->db->get_where('users', array('users.id' => $id));
        return $query->row_array();
    }

    /**
     * Get the list of employees
     * @return array record of users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_all_employees() {
        $this->db->select('id, firstname, lastname, email');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    /**
     * Get the label of a given user id
     * @param type $id
     * @return string label
     */
    public function get_label($id) {
        $record = $this->get_users($id);
        if (count($record) > 0) {
            return $record['firstname'] . ' ' . $record['lastname'];
        }
    }

    /**
     * Check if a login can be used before creating the user
     * @param type $login login identifier
     * @return bool true if available, false otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function is_login_available($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete a user from the database
     * @param int $id identifier of the user
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete_user($id) {
        $query = $this->db->delete('users', array('id' => $id));
    }

    /**
     * Insert a new user into the database. Inserted data are coming from an
     * HTML form
     * @return string deciphered password (so as to send it by e-mail in clear)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function set_users() {
        //Hash the clear password using bcrypt
        $this->load->library('bcrypt');
        $password = $this->input->post('password');
        $hash = $this->bcrypt->hash_password($password);

        //Role field is a binary mask
        $role = 0;
        foreach($this->input->post("role") as $role_bit){
            $role = $role | $role_bit;
        }

        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'login' => $this->input->post('login'),
            'email' => $this->input->post('email'),
            'password' => $hash,
            'role' => $role
        );
        $this->db->insert('users', $data);

        return $password;
    }

    /**
     * Update a given user in the database. Update data are coming from an
     * HTML form
     * @return type
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function update_users() {

        //Role field is a binary mask
        $role = 0;
        foreach($this->input->post("role") as $role_bit){
            $role = $role | $role_bit;
        }

        if ($this->input->post('datehired') == "") {
            $datehired = NULL;
        } else {
            $datehired = $this->input->post('datehired');
        }

        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'login' => $this->input->post('login'),
            'email' => $this->input->post('email'),
            'role' => $role
        );

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('users', $data);
        return $result;
    }

    /**
     * Update a given user in the database. Update data are coming from an
     * HTML form
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function reset_password($id, $CipheredNewPassword) {
        $password = $this->randomPassword(10);

        //Hash the clear password using bcrypt (8 iterations)
        $salt = '$2a$08$' . substr(strtr(base64_encode($this->getRandomBytes(16)), '+', '.'), 0, 22) . '$';
        $hash = crypt($password, $salt);

        //Store the new password into db
        $data = array(
            'password' => $hash
        );
        $this->db->where('id', $id);
        $result = $this->db->update('users', $data);
        return $result;
    }

    /**
     * Reset a password. Generate a new password and store its hash into db.
     * @param int $id User identifier
     * @return string clear password
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function resetClearPassword($id) {
        $password = $this->randomPassword(10);

        //Hash the clear password using bcrypt (8 iterations)
        $salt = '$2a$08$' . substr(strtr(base64_encode($this->getRandomBytes(16)), '+', '.'), 0, 22) . '$';
        $hash = crypt($password, $salt);
        
        //Store the new password into db
        $data = array(
            'password' => $hash
        );
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return $password;
    }

    /**
     * Generate a random password
     * @param int $length length of the generated password
     * @return string generated password
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    private function randomPassword($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    /**
     * Check the provided credentials
     * @param string $login user login
     * @param string $password password
     * @return bool true if the user is succesfully authenticated, false otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function check_credentials($login, $password) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            //No match found
            return false;
        } else {
            $row = $query->row();
            $hash = crypt($password, $row->password);
            if ($hash == $row->password) {
                // Password does match stored password.
                if (((int) $row->role & 1)) {
                    $is_admin = true;
                }
                else {
                    $is_admin = false;
                }

                $newdata = array(
                    'login' => $row->login,
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'is_admin' => $is_admin,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                return true;
            } else {
                // Password does not match stored password.
                return false;
            }
        }
    }

    /**
     * Check the provided credentials for a REST Call
     * @param string $login user login
     * @param string $password password
     * @return int useridentifier if succesfully authenticated, -1 otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function check_authentication($login, $password) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            //No match found
            return false;
        } else {
            $row = $query->row();
            $hash = crypt($password, $row->password);
            if ($hash == $row->password) {
                // Password does match stored password.
                return $row->id;
            } else {
                // Password does not match stored password.
                return -1;
            }
        }
    }

    /**
     * Load the profile of a user
     * @param type $login user login
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function load_profile($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();
        $row = $query->row();
        // Password does match stored password.
        if (((int) $row->role & 1)) {
            $is_admin = true;
        } else {
            $is_admin = false;
        }

        $newdata = array(
            'login' => $row->login,
            'id' => $row->id,
            'firstname' => $row->firstname,
            'lastname' => $row->lastname,
            'is_admin' => $is_admin,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($newdata);
    }

    /**
     * Try to return the user information from the login field
     * @param type $login
     * @return User data row or null if no user was found
     */
    public function getUserByLogin($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            //No match found
            return null;
        } else {
            return $query->row();
        }
    }

        /*
        00000001 1  Admin
        00000010 2	User
        00000100 8	HR Officier / Local HR Manager
        00001000 16	HR Manager
        00010000 32	General Manager
        00100000 34	Global Manager
     */

    /**
     * Get the list of roles or one role
     * @param int $id optional id of one role
     * @return array record of roles
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_roles($id = 0) {
        if ($id === 0) {
            $query = $this->db->get('roles');
            return $query->result_array();
        }
        $query = $this->db->get_where('roles', array('id' => $id));
        return $query->row_array();
    }

    /**
     * Generate some random bytes by using openssl, dev/urandom or random
     * @param int $count length of the random string
     * @return string a string of pseudo-random bytes (must be encoded)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    protected function getRandomBytes($length) {
        if(function_exists('openssl_random_pseudo_bytes')) {
          $rnd = openssl_random_pseudo_bytes($length, $strong);
          if ($strong === TRUE)
            return $rnd;
        }
        $sha =''; $rnd ='';
        if (file_exists('/dev/urandom')) {
          $fp = fopen('/dev/urandom', 'rb');
          if ($fp) {
              if (function_exists('stream_set_read_buffer')) {
                  stream_set_read_buffer($fp, 0);
              }
              $sha = fread($fp, $length);
              fclose($fp);
          }
        }
        for ($i=0; $i<$length; $i++) {
          $sha  = hash('sha256',$sha.mt_rand());
          $char = mt_rand(0,62);
          $rnd .= chr(hexdec($sha[$char].$sha[$char+1]));
        }
        return $rnd;
    }
}
