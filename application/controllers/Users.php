<?php
/**
 * This controller contains all functions for user management
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
        $this->load->model('users_model');
    }
    
    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        //$this->auth->check_is_granted('list_users');
        expires_now();
        $data = getUserContext($this);
        $data['users'] = $this->users_model->getUsers();
        $data['title'] = 'List of users';
        $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Display a for that allows updating a given user
     * @param int $id User identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($id) {
        //$this->auth->check_is_granted('edit_user');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Edit user';
        
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('role[]', 'role', 'required');
        
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            show_404();
        }

        if ($this->form_validation->run() === FALSE) {
            $data['roles'] = $this->users_model->getRoles();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->users_model->updateUsers();
            $this->session->set_flashdata('msg', 'The user has been successfully updated');
            if (isset($_GET['source'])) {
                redirect($_GET['source']);
            } else {
                redirect('users');
            }
        }
    }

    /**
     * Delete a given user
     * @param int $id User identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete($id) { 
        //$this->auth->check_is_granted('delete_user');
        //Test if user exists
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            log_message('debug', '{controllers/users/delete} user not found');
            show_404();
        } else {
            $this->users_model->deleteUser($id);
        }
        log_message('info', 'User #' . $id . ' has been deleted by user #' . $this->session->userdata('id'));
        $this->session->set_flashdata('msg', 'The user has been successfully deleted');
        redirect('users');
    }

    /**
     * Reset the password of a user
     * Can be accessed by the user itself or by admin
     * @param int $id User identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function reset($id) {
        //$this->auth->check_is_granted('change_password', $id);

        //Test if user exists
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            log_message('debug', '{controllers/users/reset} user not found');
            show_404();
        } else {
            $data = getUserContext($this);
            $data['target_user_id'] = $id;
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('users/reset', $data);
            } else {
                $this->users_model->resetPassword($id, $this->input->post('password'));
                
                //Send an e-mail to the user so as to inform that its password has been changed
                $user = $this->users_model->getUsers($id);
                $this->load->library('email');
                $this->email->set_newline("\r\n");  //Workaround FakeSMTP
                $this->load->library('parser');
                $data = array(
                    'Title' => 'Your password has been reset',
                    'Firstname' => $user['firstname'],
                    'Lastname' => $user['lastname']
                );
                $message = $this->parser->parse('emails/password_reset', $data, TRUE);
                if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE ) {
                    $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
                } else {
                    $this->email->from('do.not@reply.me', 'Karthanea');
                }
                $this->email->to($user['email']);
                $this->email->subject('[Karthanea] Your password has been reset');
                $this->email->set_mailtype("html");
                $this->email->message(htmlentities_htmltags($message));
                $this->email->send();
                
                //Inform back the user by flash message
                $this->session->set_flashdata('msg', 'The password has been succesfully changed');
                if ($this->is_admin) {
                    redirect('users');
                }
                else {
                    redirect(base_url());
                }
            }
        }
    }

    /**
     * Display the form / action Create a new user
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        //$this->auth->check_is_granted('create_user');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Create a new user';
        $data['roles'] = $this->users_model->getRoles();

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('login', 'login', 'required|callback_login_check');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('role[]', 'role', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('users/create', $data);
            $this->load->view('templates/footer');
        } else {
            $password = $this->users_model->setUsers();
            log_message('info', 'User ' . $this->input->post('login') . ' has been created by user #' . $this->session->userdata('id'));
            
            //Send an e-mail to the user so as to inform that its account has been created
            $this->load->library('email');
            $this->email->set_newline("\r\n");  //Workaround FakeSMTP
            $this->load->library('parser');
            $data = array(
                'Title' => 'Your account has been created',
                'BaseURL' => base_url(),
                'Firstname' => $this->input->post('firstname'),
                'Lastname' => $this->input->post('lastname'),
                'Login' => $this->input->post('login'),
                'Password' => $password
            );
            $message = $this->parser->parse('emails/new_user', $data, TRUE);
            if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE ) {
                $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
            } else {
               $this->email->from('do.not@reply.me', 'Karthanea');
            }
            $this->email->to($this->input->post('email'));
            $this->email->subject('[Karthanea] Your account has been created');
            $this->email->set_mailtype("html");
            $this->email->message(htmlentities_htmltags($message));
            $this->email->send();
            
            $this->session->set_flashdata('msg', 'The user has been succesfully created');
            redirect('users');
        }
    }
   
    /**
     * Form validation callback : prevent from login duplication
     * @param type $login
     * @return boolean true if the field is valid, false otherwise
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function login_check($login) {
        if (!$this->users_model->isLoginAvailable($login)) {
            $this->form_validation->set_message('login_check', 'Username already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /**
     * Ajax endpoint : check login duplication
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function check_login() {
        header("Content-Type: text/plain");
        if ($this->users_model->isLoginAvailable($this->input->post('login'))) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
