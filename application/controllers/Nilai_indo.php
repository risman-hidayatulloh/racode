<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai_indo extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Nilai_indo_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $nilai_indo = $this->Nilai_indo_model->get_all_query();

        $data = array(
            'nilai_indo_data' => $nilai_indo
        );

        $this->template->load('template','nilai_indo_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Nilai_indo_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_siswa' => $row->nama_siswa,
		'ulangan' => $row->ulangan,
		'uts' => $row->uts,
		'uas' => $row->uas,
	    );
            $this->template->load('template','nilai_indo_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_indo'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('nilai_indo/create_action'),
	    'id' => set_value('id'),
	    'nama_siswa' => set_value('nama_siswa'),
	    'ulangan' => set_value('ulangan'),
	    'uts' => set_value('uts'),
	    'uas' => set_value('uas'),
	);
        $this->template->load('template','nilai_indo_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_siswa' => $this->input->post('nama_siswa',TRUE),
		'ulangan' => $this->input->post('ulangan',TRUE),
		'uts' => $this->input->post('uts',TRUE),
		'uas' => $this->input->post('uas',TRUE),
	    );

            $this->Nilai_indo_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('nilai_indo'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Nilai_indo_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('nilai_indo/update_action'),
		'id' => set_value('id', $row->id),
		'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
		'ulangan' => set_value('ulangan', $row->ulangan),
		'uts' => set_value('uts', $row->uts),
		'uas' => set_value('uas', $row->uas),
	    );
            $this->template->load('template','nilai_indo_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_indo'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_siswa' => $this->input->post('nama_siswa',TRUE),
		'ulangan' => $this->input->post('ulangan',TRUE),
		'uts' => $this->input->post('uts',TRUE),
		'uas' => $this->input->post('uas',TRUE),
	    );

            $this->Nilai_indo_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nilai_indo'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Nilai_indo_model->get_by_id($id);

        if ($row) {
            $this->Nilai_indo_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('nilai_indo'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_indo'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
	$this->form_validation->set_rules('ulangan', 'ulangan', 'trim|required');
	$this->form_validation->set_rules('uts', 'uts', 'trim|required');
	$this->form_validation->set_rules('uas', 'uas', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "nilai_indo.xls";
        $judul = "nilai_indo";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Siswa");
	xlsWriteLabel($tablehead, $kolomhead++, "Ulangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Uts");
	xlsWriteLabel($tablehead, $kolomhead++, "Uas");

	foreach ($this->Nilai_indo_model->get_all_query() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_siswa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ulangan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->uts);
	    xlsWriteNumber($tablebody, $kolombody++, $data->uas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=nilai_indo.doc");

        $data = array(
            'nilai_indo_data' => $this->Nilai_indo_model->get_all_query(),
            'start' => 0
        );
        
        $this->load->view('nilai_indo_doc',$data);
    }

}

/* End of file Nilai_indo.php */
/* Location: ./application/controllers/Nilai_indo.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-05 20:13:02 */
/* http://harviacode.com */