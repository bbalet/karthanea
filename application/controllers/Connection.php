<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bills extends CI_Controller {

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('bills/index');
		$this->load->view('common/footer');
	}

	/**
	 * Login form
	 * @author Benjamin BALET <benjamin.balet@gmail.com>
	 */
	public function login() {
			$this->load->helper('form');
			$this->load->library('form_validation');
			//Note that we don't receive the password as a clear string
			$this->form_validation->set_rules('login', 'login', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
			if ($this->form_validation->run() === FALSE) {
					$data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
					$this->load->view('common/header', $data);
					$this->load->view('connection/login', $data);
					$this->load->view('common/footer');
			} else {
					$this->load->model('users_model');
					$loggedin = $this->users_model->check_credentials($this->input->post('login'), $this->input->post('password'));

					if ($loggedin == FALSE) {
							log_message('error', '{controllers/session/login} Invalid login id or password for user=' . $this->input->post('login'));
							$this->session->set_flashdata('msg', lang('connection_login_flash_bad_credentials'));
							$data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
							$this->load->view('common/header', $data);
							$this->load->view('connection/login', $data);
							$this->load->view('common/footer');
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
}
