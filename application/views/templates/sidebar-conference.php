<div class="col-12 col-lg-3">
    <div class="aside">
        <div class="aside__header d-none d-lg-block">
            <img src="<?= $url_resources."img/timeline/".$timeline_id.".JPG" ?>" alt="" class="aside__thumbnail">
        </div>
        <div class="aside__infos">
            <div class="aside__icon">
                <i class="fa fa-share"></i>
            </div>
            <div class="aside__content">
                <div class="aside__edition font-weight-bold">Édition <?= $edition ?></div>
                <div class="aside__date">journée du <?= $date ?></div>
            </div>
        </div>
		<div class="aside__infos">
			<div class="aside__icon">
				<i class="fa fa-microphone"></i>
			</div>
			<div class="aside__content">
				<div class="aside__date"><a href="<?= base_url("/conference/".$timeline_id) ?>"><?= $timeline ?></a></div>
			</div>
		</div>
        <div class="aside__footer">
            <button class="aside__share custom-btn btn btn-outline-secondary">
                <i class="fa fa-share"></i>Partager</button>
        </div>
    </div>
</div>
