<?php

/**
 * @package mvc
 * @subpackage controller
 * @author
 */

//Este controlador require tener acceso al modelo
include_once ('Model/categoriaBss.php');

//La clase controlador

class categoriaCtl {

	public $modelo;

	//Cuando se crea el controlador crea el modelo de venta
	function __construct() {
		$this -> modelo = new categoriaBss();
	}

	function ejecutar() {
		
		if (!isset($_REQUEST['action'])) {

			//Obtengo los datos que se van a listar
			$categoria = $this -> modelo -> listar();
			//Muestro los datos
			include ('View/listaCategoria.php');

		} else
			switch($_REQUEST['action']) {
				case 'insertar' :
					include('validaciones.php');
					if( isset($_REQUEST['nombre']) ){
						if( isNombre( $_REQUEST['nombre'] ) ){
							$categoria = $this -> modelo -> insertar($_REQUEST['nombre']);
							if (is_object($categoria))
								include ('View/listaCategoria.php');
							else
								echo 'error al desplegar';
								//include ('View/categoriaError.php');
						}
						else{
							echo 'Datos no validos. Porfavor revise la sintaxis';
						}
					}
					
						

					break;

				case 'modificar' :
					// solo encargado de ventas modifica facturas
						include('validaciones.php');
						if( isId($_REQUEST['id']) && isNombre($_REQUEST['nombre']) ){
							$categoria = $this -> modelo -> modificarDato($_REQUEST['id'], $_REQUEST['nombre']);
							if($categoria == TRUE)
								echo 'El campo fue modificado exitosamente';
							else {
								echo 'El campo no pudo ser modificado';
							}
						}
						

					break;

				case 'listar' :

					$categoria = $this -> modelo -> listar();
					if (is_array($categoria))
						include ('View/listaCategoria.php');
					else
						echo 'no se pudo desplegar';
						//include ('View/facturaError.php');

					break;

				case 'consulta' :
						include('validaciones.php');
						if( isCategoriaAD($_REQUEST['atributo'], $_REQUEST['dato'] ) ){
							$categoria = $this -> modelo -> consultarDato($_REQUEST['dato'], $_REQUEST['atributo'] );
								if (is_object($categoria) )
									include ('View/listaCategoria.php');
								else
									echo 'no se pudo desplegar';
									//include ('View/facturaError.php');
						}
						
						
						break;
			}

	}

}
?>