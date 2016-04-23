<?php

/**
 * This controller contains all functions for displaying contracts
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contracts extends CI_Controller {

    /**
     * View an existing contract
     * @param int $contractId identifier of the contract
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function view($contractId) {
        $data['title'] = 'Contract / View';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('contracts/view', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Create a new contract
     * @param int $contractId identifier of the contract
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        $data['title'] = 'Contract / Create';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('contracts/create', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * View the bills associated to a contract
     * @param int $contractId identifier of the contract
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function bills($contractId) {
        $data['title'] = 'Contract / Bills';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('contracts/bills', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Export a contract to a PDF
     * We use FPDF lib : http://www.fpdf.org/
     * @param int $billId identifier of the contract
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function export($billId) {
        require_once(APPPATH . 'third_party/fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $fontSize = 16;
        $pdf->SetFont('Arial', 'B', $fontSize);
        $pdf->Cell(40, 10, 'Contract of Georges DURAND');
        $pdf->MultiCell(75, $fontSize, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.', 0, 'J');
        $pdf->Output();
    }

}
