<?php

/**
 * This controller contains all functions for displaying bills
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills extends CI_Controller {
    
    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
    }

    /**
     * Displays the list of bills
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        $data = getUserContext($this);
        $data['title'] = 'List of bills';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bills/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Create a new bill
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        $data = getUserContext($this);
        $data['title'] = 'Create a new bill';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bills/create', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Edit an existing bill
     * @param int $billId identifier of the contract
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($billId) {
        $data = getUserContext($this);
        $data['title'] = 'Edit a bill';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bills/edit', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * View an existing bill
     * @param int $billId identifier of the contract
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function view($billId) {
        $data = getUserContext($this);
        $data['title'] = 'View a bill';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bills/view', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Export a bill to a PDF
     * We use FPDF lib : http://www.fpdf.org/
     * @param int $billId identifier of the contract
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function export($billId) {
        require_once(APPPATH . 'third_party/fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Bill of Georges DURAND');
        $pdf->Cell(40, 30, 'Amount is 10 $');
        $pdf->Cell(60, 60, 'Powered by FPDF.', 0, 1, 'C');
        $pdf->Output();
    }

}
