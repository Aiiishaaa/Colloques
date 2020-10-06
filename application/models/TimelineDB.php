<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TimelineDB extends CI_Model{

	private $mysql ;

	function __construct() {
		$this->mysql = $this->load->database("default", TRUE);
	}

	/************************************
	 * Renvoie l'ensemble des timeline/conférences trouvées en base de données
	 * @param false $only_shown
	 * @return array|null
	 ***************************************/
	public function get_all_timelines ($only_shown=false)
	{
		if ($only_shown)
		{
			$this->mysql->where("showintimeline", 1);
		}
		$this->mysql->order_by("order", "asc");
		$query = $this->mysql->get('timeline');

		$res = array() ;
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $result)
			{
				$res[$result["id"]] = $result ;
			}
			return $res ;
		}
		else
		{
			return null ;
		}

	}

	/***************************************
	 * Renvoie les données d'une timeline/conférences spécifique en base de données
	 * @param $id
	 * @return mixed|null
	 ***************************************/
	public function get_timeline ($id)
	{
		$this->mysql->where('id', $id);
		$query = $this->mysql->get('timeline');

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
