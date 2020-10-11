	<div class="container text-center">
<?php
foreach ($timelines as $date_array) {
    $edition = $date_array[0]["edition"];
    $date = $date_array[0]["date"];
    ?>

	<div class="custom-edition my-5">
		<div class="row custom-edition-row">
			<div class="col-12">
				<div class="custom-date text-center">
					<p><?=$edition?></p>
					<h3 class="title"><?=$date?></h3>
				</div>
			</div>
		</div>
		<?php foreach ($date_array as $conference) {?>
		<div class="row justify-content-center custom-card-row">
			<div class="col-12 col-md-6 col-lg-4 col-xl-3">
				<?php
$datas = array();
        $datas["timeline_id"] = $conference["id"];
        $datas["timeline_name"] = $conference["nom"];
        $datas["thematiques"] = array();
        if (isset($db->getThematiquesByTimeline()[$conference["id"]])) {
            $datas["thematiques"] = $db->getThematiquesByTimeline()[$conference["id"]];
        }

        $this->load->view('templates/card-timeline', $datas);?>
	</div>
</div>
    <?php }?>
	</div>
<?php
}
?>
	</div>


