<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class DatabaseJSON extends CI_Model
{


	private $database ; // la base de données finale et complète
	private $ressources_by_id ; // tableau contenant toutes les ressources indexées par leur id
	private $ressources_by_participants ;// tableau contenant toutes les ressources par contributeur
	private $ressources_by_thematique ;// tableau contenant toutes les ressources d'après une thématique
	private $ressources_by_timeline ;// tableau contenant toutes les ressources appartenant à une timeline/conférence
	private $thematiques_by_timeline ;// tableau contenant toutes les thematiques appartenant à une timeline/conférence
	private $ressources_son ; // tableau contenant toutes les ressources du type son
	private $ressources_pdf ; // tableau contenant toutes les ressources du type pdf
	private $ressources_image ; // tableau contenant toutes les ressources du type image
	private $ressources_lien ; // tableau contenant toutes les ressources du type lien
	private $ressources_video ; // tableau contenant toutes les ressources du type vidéo
	private $thematiques ;  // tableau contenant le guide de toutes les thématiques
	private $timeline ;  // tableau contenant le guide de toutes les conférences /timeline
	private $participants ;  // tableau contenant le guide de tous les contributeurs
	private $table_infos_timeline ; // tableau contenant les infos complémentaires stockées en DB SQL sur les timelines/conférences


	public function __construct($json_filename=null, $json_schema_filename=null)
	{
		parent::__construct();
		if (isset($json_filename) && isset($json_schema_filename))
		{

			// initialisation des tableaux
			$this->database = array() ;
			$this->ressources_son = array() ;
			$this->ressources_pdf = array() ;
			$this->ressources_image = array() ;
			$this->ressources_lien = array() ;
			$this->ressources_video = array() ;
			$this->ressources_texte = array() ;
			$this->thematiques = array() ;
			$this->timeline = array() ;
			$this->ressources_by_id = array() ;
			$this->ressources_by_participants = array() ;
			$this->ressources_by_thematique = array() ;
			$this->ressources_by_timeline = array() ;
			$this->thematiques_by_timeline = array() ;
			$this->participants = array() ;

			/************************************************************
			 * CHARGEMENT DES INFOS SUR LA TIMELINE EN DB MYSQL
			 ************************************************************/
			$timelineDB = new TimelineDB();
			$this->table_infos_timeline = $timelineDB->get_all_timelines() ;

			/************************************************************
			 * ANALYSE DU SCHEMA DE LA BASE DE DONNEES
			 ************************************************************/
			$json_schema = file_get_contents($json_schema_filename);
			$json_schema = rtrim (trim($json_schema), ","); // on modifie le json généré en enelevant le ',' final pour le rendre compatible
			$array_schema = Json::decode($json_schema, TRUE);
			//var_dump($array_schema);

			foreach ($array_schema["schema"]["attributes"] as $item) {
				if ($item["name"] == "thematique")
				{
					foreach ($item["type"]["values"] as $thematique) {
						$titre = $thematique["label"] ;
						$titre = preg_replace('#[0-9]*\.[0-9]*#', '', $titre) ;
						$id = remove_accents($thematique["value"]) ;
						$this->thematiques[$id] = ucfirst(trim($titre)) ;

						// si la thématique commence par "6." alors c'est un contributeur
						if (strpos($titre, "6.") !== false)
						{
							$titre = preg_replace('#[0-9]*\.[0-9]*#', '', $titre) ;
							$this->participants[$id] = trim($titre) ;
						}
					}
				}
				else if ($item["name"] == "timeline")
				{
					foreach ($item["type"]["values"] as $timeline) {
						$titre = $timeline["label"] ;
						$id = remove_accents($timeline["value"]) ;
						$this->timeline[$id] = $titre ;
					}
				}
			}

			/************************************************************
			 * ANALYSE DE LA BASE DE DONNEES
			 ************************************************************/
			$json_data = file_get_contents($json_filename);
			$json_data = str_replace("ISODate(", "", $json_data); // on modifie le json généré pour le rendre compatible
			$json_data = str_replace("\")", "\"", $json_data);
			$array_items = Json::decode($json_data, TRUE);

			foreach ($array_items as $item) {
				$ressource = new Item($item, $this->thematiques, $this->timeline, $this->table_infos_timeline) ;
				array_push($this->database, $ressource);
				$this->ressources_by_id[$ressource->getId()] = $ressource;

				$timeline_id = $ressource->getTimelineId() ;
				if (! isset($this->ressources_by_timeline[$timeline_id]))
				{
					$this->ressources_by_timeline[$timeline_id] = array() ;
				}
				array_push($this->ressources_by_timeline[$timeline_id], $ressource) ;


				foreach ($ressource->getThematiques() as $key => $value) {
					// on recherche dans les thématiques les participants dont la thématique commence par "6."
					if (strpos($key, "6") !== false)
					{
						if (! isset($this->ressources_by_participants[$key]))
						{
							$this->ressources_by_participants[$key] = array() ;
						}
						array_push($this->ressources_by_participants[$key], $ressource) ; // on ajoute la ressource à l'auteur
					}
					if (! isset($this->ressources_by_thematique[$key]))
					{
						$this->ressources_by_thematique[$key] = array() ;
					}
					array_push($this->ressources_by_thematique[$key], $ressource) ; // on ajoute la ressource à la thematique

					$timeline_id = $ressource->getTimelineId() ;
					if (! isset($this->thematiques_by_timeline[$timeline_id]))
					{
						$this->thematiques_by_timeline[$timeline_id] = array() ;
					}
					$thematique = array();
					$thematique["id"] = $key ;
					$thematique["name"] = $value ;
					$this->thematiques_by_timeline[$timeline_id][$key] = $thematique ; // on ajoute la thematique à la timeline
				}


				if ($ressource->getType() == Item::TYPE_SON){
					array_push($this->ressources_son, $ressource) ;
				}
				else if ($ressource->getType() == Item::TYPE_IMAGE){
					array_push($this->ressources_image, $ressource) ;
				}
				else if ($ressource->getType() == Item::TYPE_LIEN){
					array_push($this->ressources_lien, $ressource) ;
				}
				else if ($ressource->getType() == Item::TYPE_PDF){
					array_push($this->ressources_pdf, $ressource) ;
				}
				else if ($ressource->getType() == Item::TYPE_VIDEO){
					array_push($this->ressources_video, $ressource) ;
				}
				else if ($ressource->getType() == Item::TYPE_TEXTE){
					array_push($this->ressources_texte, $ressource) ;
				}
			}


		}

	}


	/***************************************************************
	 * FONCTIONS DE RECHERCHE
	 ***************************************************************/
	public function findResources($thematique=null, $type=null, $keyword=null)
	{
		$results = array() ;
		foreach ($this->database as $ressource) {
			$is_match = true ;
			if (isset($type))
			{
				$is_match &= strtolower($ressource->getType()) == strtolower($type) ;
			}
			if (isset($thematique))
			{
				$found = false ;
				foreach ($ressource->thematiques as $ressource_thematique) {
					if (strpos(strtolower($ressource_thematique), strtolower($thematique)) !== false)
					{
						$found = true ;
					}
				}
				$is_match &= $found  ;
			}
			if (isset($keyword))
			{
				$is_match &= (strpos(strtolower($ressource->getName()." ".$ressource->getDescription()), strtolower($keyword)) !== false)  ;
			}
			if ($is_match)
			{
				array_push($results, $ressource) ;
			}
		}
		return $results ;

	}

	/*********************
	 * @param $keywords_string chaine contenant un ou plusieurs mots clés
	 * @return array tableau de ressources contenant les résultats
	 */
	public function search ($keywords_string)
	{
		$keywords = explode(" ", strtolower(trim(remove_accents($keywords_string)))) ;
		$results = array() ;
		if (count($keywords) > 0)
		{
			foreach ($this->database as $ressource)  // on parcourt toutes les ressources
			{
				$is_match = true ;
				foreach ($keywords as $keyword) // pour chaque ressource on check l'ensemble des mots clés
				{

					if ($keyword != "" && strpos($ressource->getRepresentation(), $keyword) === false)
					{
						$is_match = false ;
					}

				}
				if ($is_match)
				{
					array_push($results, $ressource) ;
				}
			}
		}

		return $results ;
	}


	public function getRessourceById($id)
	{
		return $this->ressources_by_id[$id] ;
	}

	public function  getRessourcesByThematique ($idThematique)
	{
		return $this->ressources_by_thematique[$idThematique] ;
	}

	public function  getRessourcesByTimeline ($idTimeline)
	{
		return $this->ressources_by_timeline[$idTimeline] ;
	}

	/***************************************************************************
	 * GETTERS
	 ***************************************************************************/
	public function getDatabase() {
		return $this->database ;
	}

	public function getAllSons() {
		return $this->ressources_son ;
	}

	public function getAllPDFs() {
		return $this->ressources_pdf ;
	}

	public function getAllImages() {
		return $this->ressources_image ;
	}

	public function getAllVideos() {
		return $this->ressources_video ;
	}

	public function getAllLiens() {
		return $this->ressources_lien ;
	}

	public function getThematique ($id)
	{
		return $this->thematiques[$id] ;
	}

	public function getTimeline ($id)
	{
		return $this->timeline[$id] ;
	}

	/**
	 * @return array
	 */
	public function getRessourcesById(): array
	{
		return $this->ressources_by_id;
	}

	/**
	 * @param array $ressources_by_id
	 */
	public function setRessourcesById(array $ressources_by_id): void
	{
		$this->ressources_by_id = $ressources_by_id;
	}

	/**
	 * @return array
	 */
	public function getRessourcesByParticipants(): array
	{
		return $this->ressources_by_participants;
	}

	/**
	 * @param array $ressources_by_participants
	 */
	public function setRessourcesByParticipants(array $ressources_by_participants): void
	{
		$this->ressources_by_participants = $ressources_by_participants;
	}

	/**
	 * @return array
	 */
	public function getRessourcesSon(): array
	{
		return $this->ressources_son;
	}

	/**
	 * @param array $ressources_son
	 */
	public function setRessourcesSon(array $ressources_son): void
	{
		$this->ressources_son = $ressources_son;
	}

	/**
	 * @return array
	 */
	public function getRessourcesPdf(): array
	{
		return $this->ressources_pdf;
	}

	/**
	 * @param array $ressources_pdf
	 */
	public function setRessourcesPdf(array $ressources_pdf): void
	{
		$this->ressources_pdf = $ressources_pdf;
	}

	/**
	 * @return array
	 */
	public function getRessourcesImage(): array
	{
		return $this->ressources_image;
	}

	/**
	 * @param array $ressources_image
	 */
	public function setRessourcesImage(array $ressources_image): void
	{
		$this->ressources_image = $ressources_image;
	}

	/**
	 * @return array
	 */
	public function getRessourcesLien(): array
	{
		return $this->ressources_lien;
	}

	/**
	 * @param array $ressources_lien
	 */
	public function setRessourcesLien(array $ressources_lien): void
	{
		$this->ressources_lien = $ressources_lien;
	}

	/**
	 * @return array
	 */
	public function getRessourcesVideo(): array
	{
		return $this->ressources_video;
	}

	/**
	 * @param array $ressources_video
	 */
	public function setRessourcesVideo(array $ressources_video): void
	{
		$this->ressources_video = $ressources_video;
	}

	/**
	 * @return array
	 */
	public function getThematiques(): array
	{
		return $this->thematiques;
	}

	/**
	 * @param array $thematiques
	 */
	public function setThematiques(array $thematiques): void
	{
		$this->thematiques = $thematiques;
	}

	/**
	 * @return array
	 */
	public function getParticipants(): array
	{
		return $this->participants;
	}

	/**
	 * @param array $participants
	 */
	public function setParticipants(array $participants): void
	{
		$this->participants = $participants;
	}

	/**
	 * @return array
	 */
	public function getThematiquesByTimeline(): array
	{
		return $this->thematiques_by_timeline;
	}

	/**
	 * @param array $thematiques_by_timeline
	 */
	public function setThematiquesByTimeline(array $thematiques_by_timeline): void
	{
		$this->thematiques_by_timeline = $thematiques_by_timeline;
	}

	/**
	 * @return array|null
	 */
	public function getTableInfosTimeline(): ?array
	{
		return $this->table_infos_timeline;
	}

	/**
	 * @param array|null $table_infos_timeline
	 */
	public function setTableInfosTimeline(?array $table_infos_timeline): void
	{
		$this->table_infos_timeline = $table_infos_timeline;
	}



}
