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
     * REST End Point : Get a client record based on its ID
     * @param int $clientId identifier of a client
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getClient($id) {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->checkAuthenticationFromRest($login, $password);
            if ($user_id != -1) {
                expires_now();
                header("Content-Type: application/json");
                $client = new stdClass;
                $client->Firstname = 'Georges';
                $client->Lastname = 'DURAND';
                echo json_encode($client);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }

    /**
     * REST End Point : Get the list of all clients
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getClients() {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->checkAuthenticationFromRest($login, $password);
            if ($user_id != -1) {
                expires_now();
                header("Content-Type: application/json");
                $clientA = new stdClass;
                $clientA->Firstname = 'Georges';
                $clientA->Lastname = 'DURAND';
                $clientB = new stdClass;
                $clientB->Firstname = 'Benjamin';
                $clientB->Lastname = 'BALET';
                $clients = array($clientA, $clientB);
                echo json_encode($clients);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }
}
