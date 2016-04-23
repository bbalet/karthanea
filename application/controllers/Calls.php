<?php

/**
 * This controller contains all functions for displaying bills
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Calls extends CI_Controller {
    
    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
    }

    /**
     * Displays the list of unlinked calls
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        $data = getUserContext($this);
        $data['title'] = 'List of calls';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('calls/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Displays the list of unlinked calls
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function unlinked() {
        $data = getUserContext($this);
        $data['title'] = 'List of unlinked calls';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('calls/unlinked', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Create a new call
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        $data = getUserContext($this);
        $data['title'] = 'Create a new call';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('calls/create', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Edit an existing call
     * @param int $callId identifier of the call
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($callId) {
        $data = getUserContext($this);
        $data['title'] = 'Edit a call';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('calls/edit', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Search for a call
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function search() {
        $data = getUserContext($this);
        $data['title'] = 'Search for a call';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('calls/search', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Search for a call
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function results() {
        $data = getUserContext($this);
        $data['title'] = 'Search results';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('calls/results', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * View an existing call
     * @param int $callId identifier of the call
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function view($callId) {
        $data = getUserContext($this);
        $data['title'] = 'View a call';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bills/view', $data);
        $this->load->view('templates/footer', $data);
    }

}
