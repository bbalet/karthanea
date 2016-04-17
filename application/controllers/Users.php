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
        $this->lang->load('users', $this->language);
        $this->lang->load('global', $this->language);
    }
    
    /**
     * Display the list of all users
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        $this->auth->check_is_granted('list_users');
        expires_now();
        $data = getUserContext($this);
        $data['users'] = $this->users_model->get_users();
        $data['title'] = lang('users_index_title');
        $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Display the modal pop-up content of the list of employees
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function employees() {
        $this->auth->check_is_granted('list_users');
        expires_now();
        $data = getUserContext($this);
        $data['employees'] = $this->users_model->get_all_employees();
        $data['title'] = lang('employees_index_title');
        $this->load->view('users/employees', $data);
    }
    
    /**
     * Display a for that allows updating a given user
     * @param int $id User identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($id) {
        $this->auth->check_is_granted('edit_user');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = lang('users_edit_html_title');
        
        $this->form_validation->set_rules('firstname', lang('users_edit_field_firstname'), 'required');
        $this->form_validation->set_rules('lastname', lang('users_edit_field_lastname'), 'required');
        $this->form_validation->set_rules('login', lang('users_edit_field_login'), 'required');
        $this->form_validation->set_rules('email', lang('users_edit_field_email'), 'required');
        $this->form_validation->set_rules('role[]', lang('users_edit_field_role'), 'required');
        
        $data['users_item'] = $this->users_model->get_users($id);
        if (empty($data['users_item'])) {
            show_404();
        }

        if ($this->form_validation->run() === FALSE) {
            $data['roles'] = $this->users_model->get_roles();
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->users_model->update_users();
            $this->session->set_flashdata('msg', lang('users_edit_flash_msg_success'));
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
        $this->auth->check_is_granted('delete_user');
        //Test if user exists
        $data['users_item'] = $this->users_model->get_users($id);
        if (empty($data['users_item'])) {
            log_message('debug', '{controllers/users/delete} user not found');
            show_404();
        } else {
            $this->users_model->delete_user($id);
        }
        log_message('info', 'User #' . $id . ' has been deleted by user #' . $this->session->userdata('id'));
        $this->session->set_flashdata('msg', lang('users_delete_flash_msg_success'));
        redirect('users');
    }

    /**
     * Reset the password of a user
     * Can be accessed by the user itself or by admin
     * @param int $id User identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function reset($id) {
        $this->auth->check_is_granted('change_password', $id);

        //Test if user exists
        $data['users_item'] = $this->users_model->get_users($id);
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
                $this->users_model->reset_password($id, $this->input->post('password'));
                
                //Send an e-mail to the user so as to inform that its password has been changed
                $user = $this->users_model->get_users($id);
                $this->load->library('email');
                $this->load->library('polyglot');
                $usr_lang = $this->polyglot->code2language($user['language']);
                $this->lang->load('email', $usr_lang);

                $this->load->library('parser');
                $data = array(
                    'Title' => lang('email_password_reset_title'),
                    'Firstname' => $user['firstname'],
                    'Lastname' => $user['lastname']
                );
                $message = $this->parser->parse('emails/' . $user['language'] . '/password_reset', $data, TRUE);
                if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE ) {
                    $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
                } else {
                    $this->email->from('do.not@reply.me', 'Sokun');
                }
                $this->email->to($user['email']);
                $this->email->subject(lang('email_password_reset_subject'));
                $this->email->set_mailtype("html");
                $this->email->message(htmlentities_htmltags($message));
                $this->email->send();
                
                //Inform back the user by flash message
                $this->session->set_flashdata('msg', lang('users_reset_flash_msg_success'));
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
        $this->auth->check_is_granted('create_user');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = lang('users_create_title');
        $data['roles'] = $this->users_model->get_roles();

        $this->form_validation->set_rules('firstname', lang('users_create_field_firstname'), 'required');
        $this->form_validation->set_rules('lastname', lang('users_create_field_lastname'), 'required');
        $this->form_validation->set_rules('login', lang('users_create_field_login'), 'required|callback_login_check');
        $this->form_validation->set_rules('email', lang('users_create_field_email'), 'required');
        $this->form_validation->set_rules('password', lang('users_create_field_password'), 'required');
        $this->form_validation->set_rules('role[]', lang('users_create_field_role'), 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('users/create', $data);
            $this->load->view('templates/footer');
        } else {
            $password = $this->users_model->set_users();
            log_message('info', 'User ' . $this->input->post('login') . ' has been created by user #' . $this->session->userdata('id'));
            
            //Send an e-mail to the user so as to inform that its account has been created
            $this->load->library('email');
            $this->load->library('polyglot');
            $usr_lang = $this->polyglot->code2language($this->input->post('language'));
            $this->lang->load('email', $usr_lang);
            
            $this->load->library('parser');
            $data = array(
                'Title' => lang('email_user_create_title'),
                'BaseURL' => base_url(),
                'Firstname' => $this->input->post('firstname'),
                'Lastname' => $this->input->post('lastname'),
                'Login' => $this->input->post('login'),
                'Password' => $password
            );
            $message = $this->parser->parse('emails/' . $this->input->post('language') . '/new_user', $data, TRUE);
            if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE ) {
                $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
            } else {
               $this->email->from('do.not@reply.me', 'Sokun');
            }
            $this->email->to($this->input->post('email'));
            $this->email->subject(lang('email_user_create_subject'));
            $this->email->set_mailtype("html");
            $this->email->message(htmlentities_htmltags($message));
            $this->email->send();
            
            $this->session->set_flashdata('msg', lang('users_create_flash_msg_success'));
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
        if (!$this->users_model->is_login_available($login)) {
            $this->form_validation->set_message('login_check', lang('users_create_login_check'));
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
        if ($this->users_model->is_login_available($this->input->post('login'))) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * Action: export the list of all users into an Excel file
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function export() {
        expires_now();
        $this->auth->check_is_granted('export_user');
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle(lang('users_export_title'));
        $this->excel->getActiveSheet()->setCellValue('A1', lang('users_export_thead_id'));
        $this->excel->getActiveSheet()->setCellValue('B1', lang('users_export_thead_firstname'));
        $this->excel->getActiveSheet()->setCellValue('C1', lang('users_export_thead_lastname'));
        $this->excel->getActiveSheet()->setCellValue('D1', lang('users_export_thead_email'));
        
        $this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $users = $this->users_model->get_users();
        $line = 2;
        foreach ($users as $user) {
            $this->excel->getActiveSheet()->setCellValue('A' . $line, $user['id']);
            $this->excel->getActiveSheet()->setCellValue('B' . $line, $user['firstname']);
            $this->excel->getActiveSheet()->setCellValue('C' . $line, $user['lastname']);
            $this->excel->getActiveSheet()->setCellValue('D' . $line, $user['email']);
            $line++;
        }

        $filename = 'users.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }
}