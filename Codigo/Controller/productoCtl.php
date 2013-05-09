<?php

/**
 * @package mvc
 * @subpackage controller
 * @author
 */

//Este controlador require tener acceso al modelo
include_once('Model/productoBss.php');

//La clase controlador

class productoCtl{

	public $modelo;

	//Cuando se crea el controlador crea el modelo de usuario
	function __construct(){
		$this -> modelo = new productoBss();
	}

	function ejecutar(){
		global $smarty;
		//Si no tengo parametros, listo los productos
		if( !isset($_REQUEST['action']) ){
			//Obtengo los datos que se van a listar
			$producto = $this->modelo->listar();
			
			//Muestro los datos
			include('View/productoListaView.php');
		}
		else switch($_REQUEST['action']){
			case 'insertar'://solo el encargado de inventario puede insertar
				include('validaciones.php');
				if( isset($_SESSION['mail']) && $_SESSION['tipo'] == 3 ){
					if(isset($_REQUEST['nombre']) && isset($_REQUEST['precio']) && isset($_REQUEST['existencia']) ){
					
					if(isNombre($_REQUEST['nombre']) && isEstatus($_REQUEST['estatus']) && isPrecio($_REQUEST['precio']) && isExistencia($_REQUEST['existencia'])){
						$producto = $this->modelo->insertar($_REQUEST['nombre'],$_REQUEST['estatus'],$_REQUEST['precio'],$_REQUEST['existencia'], $_REQUEST['imagen'], $_REQUEST['categoria']);
						if ( is_object($producto) )
							include('View/productoInsertadoView.php');
						else
							echo ' Error no se pudo insertar';
							//include('View/usuarioError.php');
					}
					else {
						echo 'Datos no validos. Porfavor revise la sintaxis';
					}
					}
					else
					{
						ob_start();
						  require 'templates/registrar_producto.tpl';
						  $panel = ob_get_clean();
						  $smarty->assign('titulocontenido','');
						  $smarty->assign('contenido',$panel);
					}
					
				}
				else {
					echo 'No tienes permisos para realizar esta accion';
				}
				break;
			case 'listar'://cualquiera puede listar los productos
					$producto = $this->modelo->listar();
					if(is_array($producto))
						include('View/productoListaView.php');		
					else
						echo 'Error no se pudo listar';	
					break;
				
				
				
			case 'consultarDato'://cualquiera puede consultar un producto
						include('validaciones.php');
						if(isProductoAD($_REQUEST['atributo'],$_REQUEST['dato'])){
							$producto = $this->modelo->consultarDato($_REQUEST['dato'],$_REQUEST['atributo']);
							if(is_object($producto))
								include('View/productoListaView.php');		
							else
								echo 'Error no se pudo listar';	
						}
						else {
							echo 'Datos no validos. Porfavor revise la sintaxis';
						}
						break;
			case 'modificarDato'://solo el encargado de ventas e inventario pueden realizar esta accion
						if( isset($_SESSION['mail']) && $_SESSION['tipo'] != 1  ){
							include('validaciones.php');
							if(isset($_REQUEST['nombre']) && isset($_REQUEST['precio']) && isset($_REQUEST['existencia']) ){
							if(isId($_REQUEST['id']) && isProductoAD($_REQUEST['atributo'],$_REQUEST['dato'])){
								$producto = $this->modelo->modificarDato($_REQUEST['id'],$_REQUEST['dato'],$_REQUEST['atributo']);
								if($producto == TRUE)
									echo 'El campo fue modificado exitosamente';
								else {
									echo 'El campo no pudo ser modificado';
								}
							}
							else {
								echo 'Datos no validos. Porfavor revise la sintaxis';
							}
							}
							else
							{
								ob_start();
						  require 'templates/modificar_producto.tpl';
						  $panel = ob_get_clean();
						  $smarty->assign('titulocontenido','');
						  $smarty->assign('contenido',$panel);
							}
						}
						else {
							echo 'No tienes permisos para realizar esta accion';
						}
						break;
		}				
		
		
	}
}

?>
