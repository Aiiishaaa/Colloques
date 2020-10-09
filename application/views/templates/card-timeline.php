
<!--Card timeline-->
<div class="card my-2 card-custom">
    <div class="card-body pb-2">
        <h5 class="card-title mb-1 font-weight-bold"><?= $timeline_name ?></h5>
		<p class="card-text card-custom-infos my-1">
			<?php foreach ($thematiques as $thematique) {?>
				<a href="<?= base_url((strpos($thematique["id"], "6") !== false ? "intervenant/" : "thematique/").$thematique["id"]) ?>" class="card-link card-custom-theme m-0">#<?= $thematique["name"] ?></a>
			<?php } ?>
		</p>
    </div>

    <div class="card-custom-img-block">
		<div style="background-image: url(<?= $url_resources."img/timeline/".$timeline_id.".JPG" ?>)" alt="<?= $timeline_name ?>" class="card-img card-custom-img"></div>
		<a href="<?= base_url("/conference/".$timeline_id) ?>" class="card-custom-link" >
            <i class="fa fa-microphone card-custom-link-icon"></i>
            <span class="card-custom-link-text">Conférence complète</span>
        </a>

    </div>
</div>
<!---->
