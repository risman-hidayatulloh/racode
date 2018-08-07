<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mapel extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mapel_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $mapel = $this->Mapel_model->get_all();

        $data = array(
            'mapel_data' => $mapel
        );

        $this->template->load('template','mapel_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Mapel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'mapel' => $row->mapel,
	    );
            $this->template->load('template','mapel_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mapel'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mapel/create_action'),
	    'id' => set_value('id'),
	    'mapel' => set_value('mapel'),
	);
        $this->template->load('template','mapel_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'mapel' => $this->input->post('mapel',TRUE),
	    );

            $this->Mapel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mapel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mapel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mapel/update_action'),
		'id' => set_value('id', $row->id),
		'mapel' => set_value('mapel', $row->mapel),
	    );
            $this->template->load('template','mapel_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mapel'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'mapel' => $this->input->post('mapel',TRUE),
	    );

            $this->Mapel_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mapel'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mapel_model->get_by_id($id);

        if ($row) {
            $this->Mapel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mapel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mapel'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('mapel', 'mapel', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mapel.xls";
        $judul = "mapel";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Mapel");

	foreach ($this->Mapel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mapel);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mapel.doc");

        $data = array(
            'mapel_data' => $this->Mapel_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mapel_doc',$data);
    }

}

/* End of file Mapel.php */
/* Location: ./application/controllers/Mapel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-05 18:19:08 */
/* http://harviacode.com */