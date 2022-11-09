<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ManageAccount extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('MainModel');
        $this->load->database();
    }

    public function addDepartment()
    {
        $message = '';
        $query = $this->db->query("
                 SELECT * FROM department WHERE dept_code='" . $this->input->post('dept_code') . "'
                 OR department='" . $this->input->post('department') . "'
        ");
        if ($query->num_rows() > 0) {
            $message = 'Department already exist';
        } else {
            $insertDepartment = array(
                'dept_code' => $this->input->post('dept_code'),
                'department' => $this->input->post('department')
            );
            $this->db->insert('department', $insertDepartment);
        }
        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function addPosition()
    {
        $message = '';
        $query = $this->db->query("
                 SELECT * FROM position WHERE position_code='" . $this->input->post('position_code') . "'
                 OR position_details='" . $this->input->post('position') . "'
        ");
        if ($query->num_rows() > 0) {
            $message = 'Position already exist';
        } else {
            $insertPosition = array(
                'position_code' => $this->input->post('position_code'),
                'position_details' => $this->input->post('position')
            );
            $this->db->insert('position', $insertPosition);
        }
        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function exportAccount()
    {
        require_once 'vendor/autoload.php';
        $account = $this->MainModel->exportAccount();
        $objReader = IOFactory::createReader('Xlsx');
        $fileName = 'Account.xlsx';

        $spreadsheet = $objReader->load(FCPATH . '/assets/template/' . $fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $startRow = 8;
        $currentRow = 8;
        foreach ($account as $val) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow + 1, 1);
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $currentRow, $val['generated_id'])
                ->setCellValue('B' . $currentRow, $val['l_name'] . ', ' . $val['f_name'] . ' ' . $val['m_name'])
                ->setCellValue('C' . $currentRow, $val['department'])
                ->setCellValue('D' . $currentRow, $val['position'])
                ->setCellValue('E' . $currentRow, $val['is_active'])
                ->setCellValue('F' . $currentRow, $val['created_at']);
            $currentRow++;
        } //end of foreach
        $spreadsheet->getActiveSheet()->removeRow($currentRow, 1);
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
        header('Content-Disposition: attachment;filename="' . $fileName . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function printAccount()
    {
        require_once 'vendor/autoload.php';
        $data['account'] = $this->MainModel->exportAccount();
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);
        $mpdf->showImageErrors = true;
        $html = $this->load->view('print_account', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
