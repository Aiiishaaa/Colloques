<div class="container my-5">
	<div class="row">
		<div class="col-12 col-lg-3 my-4">
			<div class="intervenant__pic" style="background-image: url(<?= $url_resources."img/intervenants/".$id.".JPG" ?>);" ></div>
		</div>
	</div>

	<div class="row">
		<?php $this->load->view('templates/aside-intervenant'); ?>
		<div class="col-12 offset-lg-1 col-lg-8">
			<div class="row">
				<?php foreach ($ressources as $item) { ?>
					<div class="col-12 col-md-6 col-xl-4">
						<?php
						$datas = array();
						$datas["ressource"] = $item ;
						$this->load->view('templates/card', $datas);
						?>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
