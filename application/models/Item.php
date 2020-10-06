<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item extends CI_Model
{


	public const TYPE_SON = "son" ;
	public const TYPE_LIEN = "lien-externe" ;
	public const TYPE_IMAGE = "image" ;
	public const TYPE_VIDEO = "video" ;
	public const TYPE_PDF = "pdf" ;
	public const TYPE_TEXTE = "texte" ;

	// attributs de chaque instance de la classe
	private $type ; // type de la ressource (voir types ci-dessus)
	private $id ; // id de la ressource
	private $name ; // nom de la ressource
	private $description ; // description rattachée à la ressource
	private $url ; // url pour télécharger la ressource
	private $thematiques ; // tableau contenant les id des thématiques de la ressource
	private $timeline_id ; // id de la conférence (timeline==conférence) de laquelle est issue la ressource
	private $user ; // inutilisé
	private $creationtime ; // inutilisé
	private $updatetime ; // inutilisé
	private $position ; // inutilisé
	private $participants ; // tableau contenant les id des contributeurs/participants
	private $representation ; //servira pour les recherches
	private $date ; // date de la conférence de laquelle est issue la ressource
	private $edition ; // == année du colloque

	/********************************************
	 * Item constructor.
	 * @param null $item tableau contenant les infos d'une ressources à partir du fichier json d'origine
	 * @param null $thematiques guide de toutes les thématiques existantes
	 * @param null $timeline guide de toutes les timelines (conférences) existantes
	 * @param null $timelineDB informations rattachées aux timeline existantes en DB
	 */
	public function __construct($item = null, $thematiques=null, $timeline=null, $timelineDB=null)
	{
		parent::__construct();
		if (isset($item) && isset($thematiques) && isset($timeline))
		{
			$this->id = remove_accents($item["_id"]) ;
			$this->type = $item["type"] ;
			$this->name = $item["name"] ;
			$this->description = $item["description"] ;
			$this->position = $item["_pos"] ;
			$this->timeline_id = remove_accents($item["timeline"]) ;
			$this->timeline = $timeline[$this->timeline_id] ;
			if (isset($item["_creationTime"])) $this->creationtime = trim($item["_creationTime"]) ;
			if (isset($item["_updateTime"])) $this->updatetime = trim($item["_updateTime"]) ;
			$this->user = $item["_user"] ;
			$this->url = $item["url"] ;
			$this->thematiques = array() ;
			$this->participants = array() ;
			$this->representation = $this->type." ".$this->name." ".$this->description." ".$this->timeline ; // on ajoute les infos importantes à la représentation de la ressource

			// on parcourt les thématiques de la ressources
			foreach ($item["thematique"]  as $thematique) {
				$id_thematique = remove_accents($thematique);
				$label = $thematiques[$id_thematique] ;
				$this->representation .= " ".$label ; // on ajoute les thématiques à la représentation textuelle de la ressource
				$label = preg_replace('#[0-9]*\.[0-9]*#', '', $label) ;
				$this->thematiques[$id_thematique] = trim($label) ;

				if (strpos($label, "6.") !== false) // les thématiques commençants par 6. sont en réalité les contributeurs
				{
					$label = preg_replace('#[0-9]*\.[0-9]*#', '', $label) ;
					$this->participants[$id_thematique] = trim($label) ;
				}
			}

			// rajout des infos liées aux conférences (timeline) :
			if (! is_null($timelineDB) && isset($timelineDB[$this->timeline_id]))
			{
				$this->representation .= " ". $timelineDB[$this->timeline_id]["date"]. " ". $timelineDB[$this->timeline_id]["edition"] ;
				$this->edition = $timelineDB[$this->timeline_id]["edition"] ;
				$this->date = $timelineDB[$this->timeline_id]["date"] ;
			}
			$this->representation = strtolower(remove_accents($this->representation)) ; // pour améliorer la recherche on retire les accents et on passe tout en minuscules
		}


	}


	/******************************************************************
	 * FONCTIONS SUR LES DATES - a priori on ne les utilisera pas
	 *******************************************************************/

	public function getCreationDateYear()
	{
		if (isset($this->creationtime))
		{
			$date = self::parse_iso_8601($this->creationtime);
			return $date->format("Y");
		}
		return null ;
	}

	public function getCreationDateJourneeDu()
	{
		if (isset($this->creationtime))
		{
			setlocale(LC_TIME, "fr_FR");
			$date = self::parse_iso_8601($this->creationtime);
			$date->setTimezone(new DateTimeZone('Europe/Paris'));
			return utf8_encode(strftime("%d %B", $date->getTimestamp()));
		}
		return null ;
	}

	public function getCreationDateFull()
	{
		if (isset($this->creationtime))
		{
			setlocale(LC_TIME, "fr_FR");
			$date = self::parse_iso_8601($this->creationtime);
			$date->setTimezone(new DateTimeZone('Europe/Paris'));
			return utf8_encode(strftime("%d %B %Y", $date->getTimestamp()));
		}
		return null ;
	}

	public function getUpdateDate()
	{
		if (isset($this->updatetime))
		{
			$date = self::parse_iso_8601($this->updatetime);
			$date->setTimezone(new DateTimeZone('Europe/Paris'));
			return $date->format(DateTime::ISO8601);
		}
		return null ;
	}

	private static function parse_iso_8601($iso_8601_string) {
		$results = array();
		$results[] = \DateTime::createFromFormat("Y-m-d\TH:i:s",$iso_8601_string);
		$results[] = \DateTime::createFromFormat("Y-m-d\TH:i:s.u",$iso_8601_string);
		$results[] = \DateTime::createFromFormat("Y-m-d\TH:i:s.uP",$iso_8601_string);
		$results[] = \DateTime::createFromFormat("Y-m-d\TH:i:sP",$iso_8601_string);
		$results[] = \DateTime::createFromFormat(DATE_ATOM,$iso_8601_string);

		$success = array_values(array_filter($results));
		if(count($success) > 0) {
			return $success[0];
		}
		return false;
	}







	/********************************************************************
	 * GETTERS AND SETTERS - ces méthodes sont générées automatiquement
	 ********************************************************************/

	/**
	 * @return string
	 */
	public function getRepresentation(): string
	{
		return $this->representation;
	}

	/**
	 * @param string $representation
	 */
	public function setRepresentation(string $representation): void
	{
		$this->representation = $representation;
	}

	public function getParticipants()
	{
		return $this->participants;
	}

	/**
	 * @return mixed
	 */
	public function getTimelineId()
	{
		return $this->timeline_id;
	}

	/**
	 * @param mixed $timeline_id
	 */
	public function setTimelineId($timeline_id): void
	{
		$this->timeline_id = $timeline_id;
	}

	/**
	 * @return mixed
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * @param mixed $position
	 */
	public function setPosition($position): void
	{
		$this->position = $position;
	}



	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType($type): void
	{
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id): void
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name): void
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description): void
	{
		$this->description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl($url): void
	{
		$this->url = $url;
	}

	/**
	 * @return mixed
	 */
	public function getThematiques()
	{
		return $this->thematiques;
	}

	/**
	 * @param mixed $thematiques
	 */
	public function setThematiques($thematiques): void
	{
		$this->thematiques = $thematiques;
	}

	/**
	 * @return mixed
	 */
	public function getTimeline()
	{
		return $this->timeline;
	}

	/**
	 * @param mixed $timeline
	 */
	public function setTimeline($timeline): void
	{
		$this->timeline = $timeline;
	}

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser($user): void
	{
		$this->user = $user;
	}

	/**
	 * @return mixed
	 */
	public function getCreationtime()
	{
		return $this->creationtime;
	}

	/**
	 * @param mixed $creationtime
	 */
	public function setCreationtime($creationtime): void
	{
		$this->creationtime = $creationtime;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatetime()
	{
		return $this->updatetime;
	}

	/**
	 * @param mixed $updatetime
	 */
	public function setUpdatetime($updatetime): void
	{
		$this->updatetime = $updatetime;
	}

	/**
	 * @return mixed
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @param mixed $date
	 */
	public function setDate($date): void
	{
		$this->date = $date;
	}

	/**
	 * @return mixed
	 */
	public function getEdition()
	{
		return $this->edition;
	}

	/**
	 * @param mixed $edition
	 */
	public function setEdition($edition): void
	{
		$this->edition = $edition;
	}


}
