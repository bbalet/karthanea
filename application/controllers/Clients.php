<?php

/**
 * This controller contains all functions for displaying clients and their
 * related objects (bills, contracts, etc.).
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {
    
    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
    }

    /**
     * Display the bills of a client, whatever the contract is
     * @param int $clientId identifier of the client
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function bills($clientId) {
        $data = getUserContext($this);
        $data['title'] = 'Client / Bills';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('clients/bills', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Display the contracts of a client, whatever the contract is
     * @param int $clientId identifier of the client
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function contracts($clientId) {
        $data = getUserContext($this);
        $data['title'] = 'Client / Contracts';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('clients/contracts', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Display a comprehensive view containing all information of a client
     * @param int $clientId identifier of the client
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function dashboard($clientId) {
        $data = getUserContext($this);
        $data['title'] = 'Client / Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('clients/dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Return a JSON encoded string representing the bills and contracts
     * @param int $clientId identifier of the client
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function dashboardTree($clientId) {
        $data = "[" .
                "{ \"id\" : \"demo_root_1\", \"text\" : \"General information\", \"type\" : \"root\" }, " .
                "{ \"id\" : \"demo_root_2\", \"text\" : \"Recents calls\", \"type\" : \"root\" }," .
                "\"Contracts for House\", " .
                "	{ " .
                "		\"id\" : \"demo_child_1\", \"text\" : \"Contracts for car\", \"children\" : " .
                "[" .
                "{ \"id\" : \"demo_child_2\", \"text\" : \"Car 1245XY12\", \"type\" : \"file\" } " .
                "]" .
                "}, " .
                "	{ " .
                "		\"id\" : \"demo_child_3\", \"text\" : \"Contracts for motorbikes\", \"children\" : " .
                "[" .
                "{ \"id\" : \"demo_child_4\", \"text\" : \"Moto 125BC45\", \"type\" : \"file\" } " .
                "]" .
                "} " .
                "]";
        expires_now();
        $this->output
                ->set_content_type('application/json')
                ->set_output($data);
    }

    /**
     * Display a Search form.
     * Seaching for a client from various filters (name, plate, etc.)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function search() {
        $data = getUserContext($this);
        $data['title'] = 'Client / Search';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('clients/search', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Display a client creation form.
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        $data = getUserContext($this);
        $data['title'] = 'Client / Search';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('clients/create', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Display a client edit form.
     * @param int $clientId identifier of the client
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($clientId) {
        $data = getUserContext($this);
        $data['title'] = 'Client / Search';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('clients/edit', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Display a Search result (after a search from a POST).
     * Seaching for a client from various filters (name, plate, etc.)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function doSearch() {
        $data = getUserContext($this);
        $data['title'] = 'Client / Search';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('clients/results', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Seach for a client from various filters (name, plate, etc.).
     * Return a list of matches encoded in JSON.
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function ajaxSearch() {
        //Analyse POST values
        //Return JSON
    }

}
