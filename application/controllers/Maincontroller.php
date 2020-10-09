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
		$this->datas["url_resources"] = $this->config->item('base_url_ressource');
		$this->datas["description_SEO"] = "Bienvenue sur le site du colloque CERISY • TERRITOIRES SOLIDAIRES EN COMMUN" ;

		/***** PARTAGE DANS LES RESEAUX SOCIAUX */
		$meta_infos = array();
		$meta_infos["titre"] = "" ;
		$meta_infos["image"] = $this->datas["url_resources"]."img/mentions-legales.JPG" ;
		$this->datas["meta_infos"] = $meta_infos ;
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
		$this->datas["meta_infos"]["titre"] = "Accueil" ;
		$this->datas["titre"] = "Accueil" ;
		$this->load->view('templates/header', $this->datas);
		$this->load->view('index', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	public function page()
	{

		$this->load->view('templates/header', $this->datas);
		$this->load->view('page', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	public function mentionslegales()
	{
		$this->datas["meta_infos"]["titre"] = "Mentions légales" ;
		$this->datas["titre"] = "Mentions légales" ;
		$this->load->view('templates/header', $this->datas);
		$this->load->view('mentionslegales', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	public function contact()
	{

		// le traitement du formulaire doit être fait ici et non pas dans la vue
		$this->datas["meta_infos"]["titre"] = "Contact" ;
		$this->datas["titre"] = "Contact" ;


		/***** messages vars *****/
		$errName = "";
		$errSurname = "";
		$errEmail = "";
		$errMsg = "";
		$msgSent = "";
		$msgSentClass = "";
		/*******************************/

		if (isset($_POST['submit'])) {
			/****** Contact mail needed ******/
			$toEmail = "contact@territoires-solidaires-en-commun.com"; // mettre autre chose pour tester

			/* transfert des variables du POST avec htmlspecialchars */
			$name = htmlspecialchars($_POST['name']);
			$surname = htmlspecialchars($_POST['surname']);
			$email = htmlspecialchars($_POST['email']);
			$msgSubject = htmlspecialchars($_POST['msg-subject']);
			$msg = htmlspecialchars($_POST['msg']);

			$valid = true; /*si une des verification du formulaire ne passe pas cette variable passera à false */
			/* verif si prenom vide*/
			if (empty($name)) {
				$errName = "Veuillez entrer votre prénom";
				$valid = false;
			}
			/* verif si nom vide */
			if (empty($surname)) {
				$errSurname = "Veuillez entrer votre nom";
				$valid = false;
			}
			/* verif du mail */
			/*si vide*/
			if (empty($email)) {
				$errEmail = "Une adresse E-mail est requise";
				$valid = false;
				/*si non valide */
			} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errEmail = "Veuillez entrer une adresse Email valide. <br>exemple : robert.razosky@unemail.com";
				$valid = false;
			}
			/* verif si message vide */
			if (empty($msg)) {
				$errMsg = "Veuillez entrer votre message";
				$valid = false;
			}

			/*verif si toute les validation sont passées */
			if ($valid != false) {
				$msg = wordwrap($msg, 70);
				$header = "MIME-version: 1.0" . "/r/n";
				$header .= "Content-type:text/html;charset=UTF-8" . "/r/n";
				$subject = "[Territoire solidaire en commun] ".$msgSubject." de " . $name . " " . $surname . " <" . $email . ">";
				$body = "<h2>Demande de contact<h2>
                <h4>Nom : </h4><p>" . $name . " " . $surname . "</p>
                <h4>Email : </h4><p>" . $email . "</p>
                <h4>Objet : </h4><p>" . $msgSubject . "</p>
                <h4>Message : </h4><p>" . $msg . "</p>";

				/*envoi du mail - on utilise le meiler GMAIL pour plus de facilité, on peut revenir sur la fonction mail à tout moment si le serveur est bien configuré */
				if (send_mail($toEmail, $subject, $body)) {
					//if (mail($toEmail, $subject, $body, $header)) {
					$msgSent = "Message envoyé";
					$msgSentClass = "alert-success";
				} else {
					$msgSent = "Un problème est survenu, le message n'a pas été envoyé.";
					$msgSentClass = "alert-danger";
				}
			}
		}

		$this->datas["errName"] = $errName ;
		$this->datas["errSurname"] = $errSurname ;
		$this->datas["errEmail"] = $errEmail ;
		$this->datas["errMsg"] = $errMsg ;
		$this->datas["msgSent"] = $msgSent ;
		$this->datas["msgSentClass"] = $msgSentClass ;
		$this->load->view('templates/header', $this->datas);
		$this->load->view('contact', $this->datas);
		$this->load->view('templates/footer', $this->datas);
	}

	public function thematique($thematique_id)
	{
		// préparation des données
		$this->datas["thematique"] = $this->db_json->getThematique($thematique_id) ;
		$this->datas["titre"] = "Thématique ".$this->datas["thematique"] ;
		$this->datas["ressources"] = $this->db_json->getRessourcesByThematique($thematique_id) ;
		$this->datas["meta_infos"]["titre"] = $this->datas["titre"] ;

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
		$this->datas["meta_infos"]["titre"] = $this->datas["titre"] ;
		$this->datas["name"] = $this->datas["ressource"]->getName() ;
		$this->datas["meta_infos"]["image"] = $this->datas["url_resources"]. "img/timeline/".$this->datas["ressource"]->getTimelineId().".JPG" ;
		$this->datas["description_SEO"] = strip_tags($this->datas["ressource"]->getDescription()) ;
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
		$this->datas["meta_infos"]["titre"] = $this->datas["titre"] ;

		$timelineDB = new TimelineDB();
		$timeline_array = $timelineDB->get_timeline($timeline_id) ;

		// appel aux vues en leur transmettant les données préparées
		$this->datas["timeline_id"] = $timeline_id ;
		$this->datas["timeline"] = $this->db_json->getTimeline($timeline_id) ;
		$this->datas["edition"] = $timeline_array["edition"] ;
		$this->datas["date"] = $timeline_array["date"] ;
		$this->datas["meta_infos"]["image"] = $this->datas["url_resources"]. "img/timeline/".$timeline_id.".JPG" ;

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
		$this->datas["meta_infos"]["titre"] = $this->datas["titre"] ;
		$intervenant = new IntervenantDB();
		$this->datas["biographie"] = $intervenant->get_intervenant($intervenant_id)["biographie"] ;
		$this->datas["meta_infos"]["image"] = $this->datas["url_resources"]. "img/intervenants/".$intervenant_id.".JPG" ;

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
		$this->datas["meta_infos"]["titre"] = $this->datas["titre"] ;
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
