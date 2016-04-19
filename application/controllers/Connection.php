<?php
/**
 * This controller contains all functions for login/logout actions
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {

    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Login form
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function login() {
        $data['title'] = 'Login to the application';
        $this->load->helper('form');
        $this->load->library('form_validation');
        //Note that we don't receive the password as a clear string
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
            $this->load->view('templates/header', $data);
            $this->load->view('connection/login', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('users_model');
            $loggedin = $this->users_model->check_credentials($this->input->post('login'), $this->input->post('password'));
            
            if ($loggedin == FALSE) {
                log_message('error', '{controllers/session/login} Invalid login id or password for user=' . $this->input->post('login'));
                $this->session->set_flashdata('msg', 'Bad credentials');
                $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
                $this->load->view('templates/header', $data);
                $this->load->view('connection/login', $data);
                $this->load->view('templates/footer');
            } else {
                //If the user has a target page (e.g. link in an e-mail), redirect to this destination
                if ($this->session->userdata('last_page') != '') {
                    redirect($this->session->userdata('last_page'));
                } else {
                    redirect(base_url());
                }
            }
        }
    }

    /**
     * Logout the user and destroy the session data
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('connection/login');
    }
    
    /**
     * Send the password by e-mail to a user requesting it
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function forgetpassword() {
        expires_now();
        $this->output->set_content_type('text/plain');
        $login = $this->input->post('login');
        $this->load->model('users_model');
        $user = $this->users_model->getUserByLogin($login);
        if (is_null($user)) {
            echo "UNKNOWN";
        } else {
            //Generate random password and store its hash into db
            $password = $this->users_model->resetClearPassword($user->id);
            
            //Send an e-mail to the user requesting a new password
            $this->load->library('email');
            $this->email->set_newline("\r\n");  //Workaround FakeSMTP
            $this->load->library('parser');
            $data = array(
                'Title' => 'Your password has been reset',
                'BaseURL' => base_url(),
                'Firstname' => $user->firstname,
                'Lastname' => $user->lastname,
                'Login' => $user->login,
                'Password' => $password
            );
            $message = $this->parser->parse('emails/password_forgotten', $data, TRUE);
            if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE ) {
                $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
            } else {
               $this->email->from('do.not@reply.me', 'Karthanea');
            }
            $this->email->to($user->email);
            $this->email->subject('[sokun] Your password has been reset');
            $this->email->set_mailtype("html");
            $this->email->message($message);
            $this->email->send();
            echo "OK";
        }
    }
}
