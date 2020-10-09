<?php
	$icon_ressource = "fa fa-microphone" ;
?>
<div class="container my-5">
	<div class="row">
		<div class="col-12 my-4">
			<div class="custom-icon d-lg-inline-block mb-2"><i class="<?= $icon_ressource ?>"></i></div>
			<h1 class="title h2 my-2 ml-2 mb-0 custom-title"><?= $name ?></h1>
		</div>
	</div>
	<div class="row">
		<?php $this->load->view('templates/sidebar-conference'); ?>
		<div class="col-12 col-lg-8 offset-lg-1 order-lg-1">
			<!-- ECOUTE INTEGRALE DE LA CONFERENCE -->
			<div class="row">
				<?php foreach ($ressources as $item) {
					if (FALSE !== strpos(remove_accents(strtolower($item->getName())), "ecoute integrale")) {?>
				<figure class="col-12">
					<figcaption><?= $item->getDescription() ?></figcaption>
					<audio controls	src="<?= $url_resources."files/".$item->getId().".MP3" ?>">
						Your browser does not support the <code>audio</code> element.
					</audio>
				</figure>
				<?php }
				}?>
			</div>
			<!-- FIN ECOUTE INTEGRALE DE LA CONFERENCE -->
			<div class="row">
				<!-- AFFICHAGE DES RESSOURCES -->
			<?php foreach ($ressources as $item) { ?>
				<div class="col-12 col-md-6 col-xl-4">
				<?php
					$datas = array();
					$datas["ressource"] = $item ;
					$this->load->view('templates/card', $datas);
				?>
				</div>
			<?php } ?>
				<!-- FIN AFFICHAGE DES RESSOURCES -->
			</div>
		</div>
	</div>

