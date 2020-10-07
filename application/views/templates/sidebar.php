<div class="col-12 col-lg-3">
    <div class="aside">
        <div class="aside__header d-none d-lg-block">
            <img src="<?= $url_resources. "img/timeline/".$ressource->getTimelineId().".JPG" ?>" alt="" class="aside__thumbnail">
        </div>
        <div class="aside__infos">
            <div class="aside__icon">
                <i class="fa fa-share"></i>
            </div>
            <div class="aside__content">
                <div class="aside__edition font-weight-bold">Édition <?= $ressource->getEdition() ?></div>
                <div class="aside__date">journée du <?= $ressource->getDate() ?></div>
            </div>
        </div>
		<div class="aside__infos">
			<div class="aside__icon">
				<i class="fa fa-microphone"></i>
			</div>
			<div class="aside__content">
				<div class="aside__date"><a href="<?= base_url("/conference/".$ressource->getTimelineId()) ?>"><?= $ressource->getTimeline() ?></a></div>
			</div>
		</div>
		<?php if ($has_thematiques) { ?>
        <div class="aside__themes">
            <div class="aside__icon">
                <i class="fa fa-tag"></i>
            </div>
            <div class="aside__content">
			<?php foreach ($ressource->getThematiques() as $key => $value) {
				if (substr($key, 0,1) != "6") { // il ne s'agit pas d'un intervenant ?>
				<a href="<?= base_url((strpos($key, "6") !== false ? "intervenant/" : "thematique/").$key) ?>" class="aside__theme">#<?= $value ?></a>
			<?php }
			} ?>
            </div>
        </div>
		<?php } ?>


		<?php if ($has_contributors) { ?>
        <div class="aside__contributors">
            <div class="aside__content">
				<?php foreach ($ressource->getThematiques() as $key => $value) {
					if (substr($key, 0,1) == "6") { // il ne s'agit pas d'un intervenant ?>
						<div class="aside__contributor">
							<img src="<?= $url_resources. "img/intervenants/".$key ?>.JPG" alt="" class="aside__picture">
							<a href="<?= base_url((strpos($key, "6") !== false ? "intervenant/" : "thematique/").$key) ?>" class="aside__theme">
								<div class="aside__name"><?= $value ?></div>
							</a>
						</div>
				<?php }
				} ?>
				<!--
                <div class="aside__contributor aside__contributor--more">
                    <div class="aside__picture"><i class="fa fa-user"></i></div>
                    <a href="#" class="aside__name">...12 autres participants</a>
                </div>
                -->
            </div>
        </div>
		<?php } ?>

		<?php if (! ($ressource->getType() == "video" && FALSE !== strpos($ressource->getUrl(), "youtube"))) { ?>
		<div class="aside__footer">
			<a href="<?= $ressource->getUrl() ?>/download">
				<button class="aside__share custom-btn btn btn-outline-secondary">
					<i class="fa fa-share"></i>Télécharger</button>
			</a>
		</div>
		<?php } ?>

        <div class="aside__footer">
            <button class="aside__share custom-btn btn btn-outline-secondary">
                <i class="fa fa-share"></i>Partager</button>
        </div>
    </div>
</div>
