
<!--Card timeline-->
<div class="card my-2 card-custom">
    <div class="card-body pb-2">
        <h5 class="card-title mb-1 font-weight-bold"><?= $timeline_name ?></h5>
    </div>

    <div class="card-custom-img-block">
		<div style="background-image: url(<?= $url_resources."img/timeline/".$timeline_id.".JPG" ?>)" alt="<?= strip_slashes($timeline_name) ?>" class="card-img card-custom-img"></div>
		<a href="<?= base_url("/ressource/".$ressource->getId()) ?>" class="card-custom-link" >
            <i class="fa fa-microphone card-custom-link-icon"></i>
            <span class="card-custom-link-text">Conférence complète</span>
        </a>

    </div>
</div>
<!---->
