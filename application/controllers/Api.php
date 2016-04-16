<?php
/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();

        // http://localhost/sokun/api/tests?login=bbalet&password=bbalet
    }

    /**
     * REST End Point : Display the list of the tests (whatever the campaign)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getTests() {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->check_authentication($login, $password);
            if ($user_id != -1) {
                $this->load->model('tests_model');
                $this->expires_now();
                header("Content-Type: application/json");
                $tests = $this->tests_model->get_tests();
                echo json_encode($tests);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }

    /**
     * REST End Point : Get the steps of a test
     * @param int $id identifier of a test
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getSteps($id) {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->check_authentication($login, $password);
            if ($user_id != -1) {
                $this->load->model('tests_model');
                $this->expires_now();
                header("Content-Type: application/json");
                $steps = $this->tests_model->get_steps($id);
                echo json_encode($steps);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }

    /**
     * REST End Point : Get the latest execution status of a test
     * @param int $id identifier of a test
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getLatestExecutionStatus($id) {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->check_authentication($login, $password);
            if ($user_id != -1) {
                $this->load->model('executions_model');
                $this->expires_now();
                header("Content-Type: application/json");
                $status = $this->executions_model->last_execution_status($id);
                echo json_encode($status);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }


}
