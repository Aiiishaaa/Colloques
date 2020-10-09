
<?php
	foreach ($timelines as $date_array) {
		$edition = $date_array[0]["edition"] ;
		$date = $date_array[0]["date"] ;
?>
			<div class="custom-edition my-5">
				<div class="row">
					<div class="col-12">
						<div class="custom-date text-center">
							<p><?= $edition ?></p>
							<h3 class="title"><?= $date ?></h3>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 col-lg-4 col-xl-3">
						<?php
							foreach ($date_array as $conference) {
								$datas = array();
								$datas["timeline_id"] = $conference["id"];
								$datas["timeline_name"] = $conference["nom"];
								$this->load->view('templates/card-timeline', $datas);
							}
						?>
					</div>
				</div>
			</div>
<?php
	}
?>


