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

