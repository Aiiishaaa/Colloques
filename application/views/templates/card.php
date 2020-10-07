<?php
$icon_ressource = "" ;
$verbe = "" ;
$type_ressource = $ressource->getType() ;
if (isset($type_ressource))
{
	if (strtolower($type_ressource) == "son")
	{
		$icon_ressource = "fa fa-music" ;
		$verbe = "Ecouter" ;
	}
	else if (strtolower($type_ressource) == "pdf")
	{
		$icon_ressource = "fa fa-book" ;
		$verbe = "lire" ;
	}
	else if (strtolower($type_ressource) == "image")
	{
		$icon_ressource = "fa fa-image" ;
		$verbe = "Voir" ;
	}
	else if (strtolower($type_ressource) == "texte")
	{
		$icon_ressource = "fa fa-book" ;
		$verbe = "Lire" ;
	}
	else if (strtolower($type_ressource) == "video")
	{
		$icon_ressource = "fas fa-film" ;
		$verbe = "Voir" ;
	}
	else if (strtolower($type_ressource) == "lien-externe")
	{
		$icon_ressource = "fa fa-link" ;
		$verbe = "Suivre" ;
	}
}
?>
<!--Card-->
<div class="card border-0 card-custom"">
    <div class="card-body px-0 pb-2">
        <h5 class="card-title mb-1 font-weight-bold"><?= $ressource->getName() ?></h5>
        <!--&bull; ci-dessous est le code du point qui sépare la date et le nom de la conférence-->
		<p class="card-text card-custom-infos my-1">2019 &bull; <a href="<?= base_url("conference/".$ressource->getTimelineId()) ?>"><?= $ressource->getTimeline() ?></a></p>
        <p class="card-text card-custom-infos my-1">
			<?php foreach ($ressource->getThematiques() as $key => $value) {?>
				<a href="<?= base_url((strpos($key, "6") !== false ? "intervenant/" : "thematique/").$key) ?>" class="card-link card-custom-theme m-0">#<?= $value ?></a>
			<?php } ?>
        </p>
    </div>

    <div class="card-custom-img-block">
        <img src="<?= $url_resources."img/timeline/".$ressource->getTimelineId().".JPG" ?>" alt="placeholder" class="card-img card-custom-img">

		<?php if ($type_ressource == "video" && FALSE !== strpos($ressource->getUrl(), "youtube")) { ?>
			<a href="<?= $ressource->getUrl() ?>" target="_blank" class="card-custom-link">
				<i class="fa <?= $icon_ressource ?> card-custom-link-icon"></i>
				<span class="card-custom-link-text">Youtube</span>
			</a>
		<?php } else { ?>
			<a href="<?= $ressource->getUrl() ?>/download" class="card-custom-link">
				<i class="fa fa-download card-custom-link-icon"></i>
				<span class="card-custom-link-text">Télécharger</span>
			</a>
		<?php } ?>
		<a href="<?= base_url("/ressource/".$ressource->getId()) ?>" class="card-custom-link" >
            <i class="fa <?= $icon_ressource ?> card-custom-link-icon"></i>
            <span class="card-custom-link-text"><?= $verbe ?></span>
        </a>

    </div>
</div>
<!---->
