<?php
/**
	@author: Henry J. Fontalba
	@package: Merchant/admin
	@Objetive: Modificacion de la Clase Excel para
	Mejorar el formato de exportacion de los archivos
	de reporte de ventas en el panel administrativo
	de asiderapido.com

**/


/**Difinicion de clase**/

class Excel
{	
	
	/** Declaracion de los Atributos de la Clase **/
	
	var $_header;
	var $_table;
	var $_filename;
	

	/** Metodos de la clase **/

	public function __construct($filename=''){		
		$this->_filename = $filename;
	}
			
	/**
	 * @param 
	 * @return 
	 */

	private function modHeader(){
				
        @header("Content-type: application/vnd.ms-excel");
        @header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
                
		if (strstr($_SERVER['HTTP_USER_AGENT'],"IE")) {
			@header('Content-Disposition: inline; filename="'.$this->_filename.'"');
			@header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			@header('Pragma: public');
		} else {
			@header('Content-Disposition: attachment; filename="'.$this->_filename.'"');
			@header('Pragma: no-cache');
		}
	} /* END setHeader */
	
	
	
	
	/**	
	 *
	 * @param  $value; representa un string con toda la cabezera que contendra el reporte
	 */
	public function addCabezera($value){
		$this->_header = $value;
	}
	
		
	/**		 
	 * @param $data; representa un string con todos los datos obtenidos de la consulta a la BD
	 */
	public function createTable($data){
		$this->_table = $this->$_header.$data;
	}
	
	public function Desplegar_xls(){		
		
		$this->modHeader();
		echo $this->_table;
		
	} /* END Desplegar_xls */
	
		
	private function damp($data=''){
		echo '<pre>'; print_r($data);echo '</pre>';
	}
	
	
} /* Fin de la Clase Excel*/
?>