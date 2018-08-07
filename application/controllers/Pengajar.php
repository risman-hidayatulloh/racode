<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengajar extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengajar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $pengajar = $this->Pengajar_model->get_all_query();

        $data = array(
            'pengajar_data' => $pengajar
        );

        $this->template->load('template','pengajar_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pengajar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'id_mapel' => $row->id_mapel,
	    );
            $this->template->load('template','pengajar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengajar'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengajar/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'id_mapel' => set_value('id_mapel'),
	);
        $this->template->load('template','pengajar_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'id_mapel' => $this->input->post('id_mapel',TRUE),
	    );

            $this->Pengajar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengajar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengajar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengajar/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'id_mapel' => set_value('id_mapel', $row->id_mapel),
	    );
            $this->template->load('template','pengajar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengajar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'id_mapel' => $this->input->post('id_mapel',TRUE),
	    );

            $this->Pengajar_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengajar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengajar_model->get_by_id($id);

        if ($row) {
            $this->Pengajar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengajar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengajar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('id_mapel', 'id mapel', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengajar.xls";
        $judul = "pengajar";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mapel");

	foreach ($this->Pengajar_model->get_all_query() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mapel);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pengajar.doc");

        $data = array(
            'pengajar_data' => $this->Pengajar_model->get_all_query(),
            'start' => 0
        );
        
        $this->load->view('pengajar_doc',$data);
    }

}

/* End of file Pengajar.php */
/* Location: ./application/controllers/Pengajar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-05 18:23:48 */
/* http://harviacode.com */