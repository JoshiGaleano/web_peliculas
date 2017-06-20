<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peliculas_model extends CI_Model {

	function getPeliculas($id){
		$query = $this->db->select('peliculas.*, categorias.categoria')
						->from('peliculas')
						->join('categorias', 'categorias.id = peliculas.id_categoria')
						->order_by("peliculas.nombre", "asc")
						->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$query2 = $this->db->select('valoracion')
								->where("id_cliente", $id)
								->where("id_pelicula", $row->id)
								->get('valoraciones', 1);

				$valoracion = $query2->row();

				if (isset($valoracion)){
				    $row->calificacion = $valoracion->valoracion;
				}
				else{
					$row->calificacion = '';
				}

				$query3 = $this->db->select('valoracion')
								->where("id_pelicula", $row->id)	
								->get('valoraciones');

				if($query3->num_rows() > 0){
					$nclientes = 0;
					$suma = 0;
					foreach ($query3->result() as $row3) {
						$valor = $row3->valoracion;
						$nclientes++;
						$suma = $suma + $row3->valoracion;;
					}
					$row->nclientes = $nclientes;
					$row->media = $suma / $nclientes;

					$peliculas[] = $row;
				}
				else{
					$row->nclientes = '';
					$row->media = '';

					$peliculas[] = $row;
				}
			}
		} 

		return $peliculas;
	}
}

/* End of file Articulos_model.php */
/* Location: ./application/models/Articulos_model.php */