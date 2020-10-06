<?php
	$icon_ressource = "" ;
	$type_ressource = "fa fa-microphone" ;
	if (isset($ressource))
	{
		$type_ressource = $ressource->getType() ;
		if (isset($type_ressource))
		{
			if (strtolower($type_ressource) == "son")
			{
				$icon_ressource = "fa fa-music" ;
			}
			else if (strtolower($type_ressource) == "pdf")
			{
				$icon_ressource = "fa fa-book" ;
			}
			else if (strtolower($type_ressource) == "image")
			{
				$icon_ressource = "fa fa-image" ;
			}
			else if (strtolower($type_ressource) == "texte")
			{
				$icon_ressource = "fa fa-book" ;
			}
			else if (strtolower($type_ressource) == "video")
			{
				$icon_ressource = "fa fa-video" ;
			}
			else if (strtolower($type_ressource) == "lien-externe")
			{
				$icon_ressource = "fa fa-link" ;
			}
		}
	}

?>
<div class="container my-5">
	<div class="row">
		<div class="col-12 my-4">
			<div class="custom-icon d-lg-inline-block mb-2"><i class="<?= $icon_ressource ?>"></i></div>
			<h1 class="title h2 my-2 ml-2 mb-0 custom-title"><?= $name ?></h1>
		</div>
	</div>

	<div class="row">
		<?php $this->load->view('templates/sidebar'); ?>

		<div class="col-12 col-lg-8 offset-lg-1 order-lg-1">
			<div class="row">

				<?php if ($type_ressource == "pdf") {
					/******* code à inclure pour voir les pdf  ********/?>
					<embed src="<?= $url_resources."files/".$ressource->getId().".pdf" ?>" width="100%" height="800" type='application/pdf'/>

				<?php /********** fin code PDF ************************/

				} else if ($type_ressource == "video" || FALSE !== strpos($ressource->getUrl(), "youtube")) {
					/**********  code à inclure pour voir les videos ********/
					$is_youtube = false ;
					if (FALSE !== strpos($ressource->getUrl(), "youtube"))
					{
						$is_youtube = true ;
					}
					?>
					<figure class="col-12">
						<?php if ($is_youtube) { ?>
							<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= explode("v=", $ressource->getUrl())[1] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<?php } else { ?>
							<video controls width="100%">
								<source src="<?= $url_resources."files/".$ressource->getId().".webm" ?>" type="video/webm">
								<source src="<?= $url_resources."files/".$ressource->getId().".MTS" ?>" type="video/mts">
								Sorry, your browser doesn't support embedded videos.
							</video>
							</php>
						<?php } ?>
						<figcaption><?= $ressource->getDescription() ?></figcaption>
					</figure>

				<?php } /********** fin code vidéo ************************/


				else if ($type_ressource == "son") {
					/*********** code à inclure pour écouter les captures audio ******/?>
					<figure class="col-12">
						<figcaption><?= $ressource->getDescription() ?></figcaption>
						<audio
								controls
								src="<?= $url_resources."files/".$ressource->getId().".MP3" ?>">
							Your browser does not support the <code>audio</code> element.
						</audio>
					</figure>
				<?php
				/********** fin code son ************************/

				} else if ($type_ressource == "image") {
				/*********** code à inclure pour écouter les captures audio ******/?>
				<div class="image-ressource col-12" style='background-image: url("<?= $url_resources."files/".$ressource->getId().".JPG" ?>");' >
				</div>
				<figcaption><?= $ressource->getDescription() ?></figcaption>
				<?php }  /********** fin code son ************************/ ?>
			</div>
			<div class="row">
				<div class="col-12">
					<h1 class="title h3 mt-4 mb-0 custom-title">Ressources liées</h1>
					<div class="row">
						<?php foreach ($db->getRessourcesByTimeline($ressource->getTimelineId()) as $item) { ?>
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
		</div>
	</div>


