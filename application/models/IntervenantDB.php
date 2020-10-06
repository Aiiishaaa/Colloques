<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IntervenantDB extends CI_Model{

	private $mysql ;

	function __construct() {
		$this->mysql = $this->load->database("default", TRUE);
	}

	/************************************
	 * Renvoie l'ensemble des intervenants trouvés en base de données
	 * *********************************/
	public function get_all_intervenants ($limit=null)
	{
		if ($limit != null)
		{
			$this->mysql->limit($limit, 0);
		}
		$this->mysql->order_by("id", "asc");
		$query = $this->mysql->get('intervenants');

		if($query->num_rows() > 0)
		{
			return $query->result_array() ;
		}
		else
		{
			return null ;
		}
	}


	/***************************************
	 * Renvoie les données d'un intervenant spécifique en base de données
	 * ***************************************/
	public function get_intervenant ($id)
	{
		$this->mysql->where('id', $id);
		$query = $this->mysql->get('intervenants');

		if($query->num_rows() > 0)
		{

			foreach ($query->result_array() as $row)
			{
				return $row ;
			}
		}
		else
		{
			return null ;
		}
	}

}
