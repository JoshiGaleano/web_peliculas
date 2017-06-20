<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valoraciones_model extends CI_Model {

	function guardar($data = array()){
		if( empty( $data ) )return FALSE;

		$query = $this->db->select('id')
						->where('id_cliente', $data['id_cliente'])
						->where('id_pelicula', $data['id_pelicula'])
						->get('valoraciones', 1);

		if($query->num_rows() > 0){
			return $this->db->where('id_cliente', $data['id_cliente'])
							->where('id_pelicula', $data['id_pelicula'])
							->update('valoraciones' , $data);
		}
		else{
			return $this->db->insert('valoraciones', $data);
		}
	}

	function eliminar($cliente, $pelicula){
		return $this->db->where('id_cliente', $cliente)
						->where('id_pelicula', $pelicula)
						->delete('valoraciones');
	}
}

/* End of file Articulos_model.php */
/* Location: ./application/models/Articulos_model.php */