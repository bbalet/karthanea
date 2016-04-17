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
	 * Displays the list of unlinked calls
	 * @author Benjamin BALET <benjamin.balet@gmail.com>
	 */
	public function unlinked()
	{
		$data['title'] = 'List of unlinked calls';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('bills/index', $data);
		$this->load->view('templates/footer', $data);
	}

	/**
	 * Create a new call
	 * @author Benjamin BALET <benjamin.balet@gmail.com>
	 */
	public function create()
	{
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
	public function edit($callId)
	{
		$data['title'] = 'Edit a call';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('bills/edit', $data);
		$this->load->view('templates/footer', $data);
	}

	/**
	 * View an existing call
	 * @param int $callId identifier of the call
	 * @author Benjamin BALET <benjamin.balet@gmail.com>
	 */
	public function view($callId)
	{
		$data['title'] = 'View a call';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('bills/view', $data);
		$this->load->view('templates/footer', $data);
	}

}
