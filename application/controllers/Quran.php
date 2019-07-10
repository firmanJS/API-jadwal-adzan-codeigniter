<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quran extends CI_Controller {

	public function index()
	{
		$this->load->view('quran');
	}

	public function getList()
	{
		if($this->input->is_ajax_request()){

		$urlApi = 'https://al-quran-8d642.firebaseio.com/data.json?print=pretty'; //Url API

		$ch = curl_init(); //set curl
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $urlApi);  // Ambil Data dari API Url
		$output = curl_exec($ch);   

		$decodeData = json_decode($output); // decode data json dari api

		curl_close($ch);
		
		$data['list'] = $decodeData;
		$html  = $this->load->view('V_quran',$data,true);
		header('Content-Type: application/json');
		echo json_encode(array('html' => $html));
		}else{
			redirect('quran');
		}
	}
}
