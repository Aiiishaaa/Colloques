
<div class="container my-5">
	<div class="row">
		<div class="col-12 my-4">
			<div class="custom-icon d-lg-inline-block mb-2"><i class="<?= isset($icon) ? $icon : "fa fa-tag" ?>"></i></div>
			<h1 class="title h2 my-2 ml-2 mb-0 custom-title"><?= $thematique ?></h1>
		</div>
	</div>

	<div class="row">

		<?php foreach ($ressources as $ressource) {
			// data-type va servir pour filtrer les ressources en JS
		?>
			<div class="col-12 col-md-6 col-lg-4 col-xl-3 ressource-card" data-type="<?= $ressource->getType() ?>">
				<?php
					$datas = array();
					$datas["ressource"] = $ressource ;
					$this->load->view('templates/card', $datas);
				?>
			</div>
		<?php } ?>

	</div>
