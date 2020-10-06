<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maincontroller extends CI_Controller
{


	/***********************************
	 * CECI EST LE CONTROLER DU SITE
	 * Toutes les requetes arrivent ici
	 * Les "routes" (url acceptées) définies dans le fichier config/route.php
	 * sont tratées ici
	 **********************************/
	private $db_json ;
	private $datas ;
	public function __construct()
	{
		parent::__construct();
		$this->datas = array();
		$this->load->model("Json", false);
		$this->load->model("DatabaseJSON", false);
		$this->load->model("Item", false);
		$this->load->model("IntervenantDB", false);
		$this->load->model("TimelineDB", false);
		$this->db_json = new DatabaseJSON(base_url("/resources/datas/cerisy.json"), base_url("/resources/datas/cerisy_schema.json")) ;
		$this->datas["db"] = $this->db_json ;
		$this->datas["titre"] = "" ;
		$this->datas["url_resources"] = $this->config->item('base_url_ressource'); ;
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('index');
		$this->load->view('templates/footer');
	}

	public function page()
	{

		$this->load->view('templates/header');
		$this->load->view('page');
		$this->load->view('templates/footer');
	}

	public function mentionslegales()
	{

		$this->load->view('templates/header');
		$this->load->view('mentionslegales');
		$this->load->view('templates/footer');
	}

	public function contact()
	{
		// le traitement du formulaire doit être fait ici et non pas dans la vue
		$this->load->view('templates/header');
		$this->load->view('contact');
		$this->load->view('templates/footer');
	}

	public function thematique($thematique_id)
	{
		// préparation des données
		$this->datas["thematique"] = $this->db_json->getThematique($thematique_id) ;
		$this->datas["titre"] = "Thématique ".$this->datas["thematique"] ;
		$this->datas["ressources"] = $this->db_json->getRessourcesByThematique($thematique_id) ;

		// appel aux vues en leur transmettant les données préparées
		$this->load->view('templates/header', $this->datas);
		$this->load->view('templates/thematique_searchbar');
		$this->load->view('thematique', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	public function ressource($ressource_id)
	{
		// préparation des données
		$this->datas["ressource"] = $this->db_json->getRessourceById($ressource_id) ;
		$this->datas["titre"] = $this->datas["ressource"]->getName() ;
		$this->datas["name"] = $this->datas["ressource"]->getName() ;
		$has_contributors = false ;
		foreach ($this->datas["ressource"]->getThematiques() as $key => $value) {
			if (strpos($key, "6") !== false) {
				$has_contributors = true ;
			}
		}
		$has_thematiques = false ;
		foreach ($this->datas["ressource"]->getThematiques() as $key => $value) {
			if (strpos($key, "6") === false) {
				$has_thematiques = true ;
			}
		}
		$this->datas["has_contributors"] = $has_contributors ;
		$this->datas["has_thematiques"] = $has_thematiques ;

		// appel aux vues en leur transmettant les données préparées
		$this->load->view('templates/header', $this->datas);
		$this->load->view('ressource', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	// fonction qui génère le contenu propre à une conférence (élément de timeline)
	public function conference($timeline_id)
	{
		// préparation des données
		$this->datas["ressources"] = $this->db_json->getRessourcesByTimeline($timeline_id) ;
		$this->datas["name"] = $this->db_json->getTimeline($timeline_id) ;
		$this->datas["type_ressource"] = "son" ;
		$this->datas["titre"] = $this->db_json->getTimeline($timeline_id) ;

		$timelineDB = new TimelineDB();
		$timeline_array = $timelineDB->get_timeline($timeline_id) ;

		// appel aux vues en leur transmettant les données préparées
		$this->datas["timeline_id"] = $timeline_id ;
		$this->datas["timeline"] = $this->db_json->getTimeline($timeline_id) ;
		$this->datas["edition"] = $timeline_array["edition"] ;
		$this->datas["date"] = $timeline_array["date"] ;

		// appel aux vues en leur transmettant les données préparées
		$this->load->view('templates/header', $this->datas);
		$this->load->view('conference', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}


	// fonction qui génère le contenu propre à un intervenant/contributeur
	public function intervenant($intervenant_id)
	{
		// préparation des données
		$this->datas["id"] = $intervenant_id ;
		$this->datas["ressources"] = $this->db_json->getRessourcesByThematique($intervenant_id) ;
		$this->datas["name"] = $this->db_json->getThematique($intervenant_id) ;
		$this->datas["type_ressource"] = "" ;
		$this->datas["titre"] = $this->datas["name"] ;
		$intervenant = new IntervenantDB();
		$this->datas["biographie"] = $intervenant->get_intervenant($intervenant_id)["biographie"] ;

		// appel aux vues en leur transmettant les données préparées
		$this->load->view('templates/header', $this->datas);
		$this->load->view('intervenant', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	public function search()
	{

		$keywords = "" ;

		// on récupère le paramètre "search" passé en paramètre
		if (isset($_GET["search"]))
		{
			$keywords = htmlentities(htmlspecialchars(strip_tags(addslashes($_GET["search"])))) ;
		}
		// préparation des données
		$this->datas["thematique"] = "Résultats de la recherche pour \"".$keywords."\"" ;
		$this->datas["titre"] = "Résultats de la recherche pour \"".$keywords."\"" ;
		$this->datas["icon"] = "fas fa-search" ;
		$this->datas["ressources"] = $this->db_json->search($keywords) ; // on effectue la recherche sur la DB et on transmet le résultat à la vue

		// appel aux vues en leur transmettant les données préparées
		$this->load->view('templates/header', $this->datas);
		$this->load->view('thematique', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	public function test()
	{
		$this->load->view('test', $this->datas);
	}
}
