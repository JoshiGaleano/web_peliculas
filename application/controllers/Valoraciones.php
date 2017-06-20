<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valoraciones extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function guardar()
	{
		//require_once '/vendor/autoload.php';
		require_once(FCPATH.'vendor/autoload.php');

		$cliente = @$this->input->post('cliente',true);
    	$pelicula = @$this->input->post('pelicula',true);
    	$valoracion = @$this->input->post('valoracion',true);

    	if( $valoracion == ""
		    OR  $cliente == ""
		    OR  $pelicula == ""
		    ){
		    die( json_encode( array( 'status'=>0, 'msj' =>'Datos incompletos' ) ) );
	    }

	    $this->load->model('Valoraciones_model');

	    $data_valoracion = array(
			"id_cliente" => $cliente,
			"id_pelicula" => $pelicula,
			"valoracion" => $valoracion,
			"fecha" => date('Y-m-d H:i:s')
		);

		if( ! $this->Valoraciones_model->guardar( $data_valoracion ) ){
			die( json_encode( array( 'status'=>0, 'msj' =>'Error al guardar valoración' ) ) );
		}

		$logger = new Katzgrau\KLogger\Logger(FCPATH.'/valoraciones');
		$logger->info('Valoraciones');
		$logger->debug('Valoración guardadad en la base de datos.', $data_valoracion);

		echo json_encode( array( 'status'=>1, 'msj' =>'Valoración guardada correctamente!' ) );
	}

	public function eliminar()
	{
		$cliente = @$this->input->post('cliente',true);
    	$pelicula = @$this->input->post('pelicula',true);

    	if( $pelicula == ""
		    OR  $cliente == ""
		    ){
		    die( json_encode( array( 'status'=>0, 'msj' =>'Datos incompletos' ) ) );
	    }

	    $this->load->model('Valoraciones_model');

		if( ! $this->Valoraciones_model->eliminar( $cliente, $pelicula ) ){
			die( json_encode( array( 'status'=>0, 'msj' =>'Error al eliminar valoración' ) ) );
		}

		echo json_encode( array( 'status'=>1, 'msj' =>'Valoración eliminada correctamente!' ) );
	}
}
