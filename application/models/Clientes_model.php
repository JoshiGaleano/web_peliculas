<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

	function getClientes(){
		$query = $this->db->get("clientes");

		return $query->result();
	}
}

/* End of file Articulos_model.php */
/* Location: ./application/models/Articulos_model.php */