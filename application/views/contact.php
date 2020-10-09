
	<div class="container">
		<div class="row">
			<div class="col-12" id="contact">
				<h1>Contact</h1>
				<img src="<?= base_url("/resources/img/page-contact.jpg") ?>" />

				<div>
					<?php if ($msgSent != "") : ?>
						<div class="alert <?php echo $msgSentClass ?>"><?php echo $msgSent; ?></div>
					<?php endif; ?>
					<form action="<?= base_url("/contact") ?>" method="post">
						<div class="row">
							<div class="col-sm-6 input-surname m-0">
								<label for="surname"><small><strong>Nom</strong> (requis)</small></label><br>
								<input id="surname" type="text" name="surname" value="<?php echo isset($_POST["surname"]) ? $_POST["surname"] : "" ?>">
								<?php if ($errSurname != "") : ?>
									<div class="alert alert-danger"><?php echo $errSurname; ?></div>
								<?php endif; ?>
							</div>
							<div class="col-sm-6 input-name m-0">
								<label for="name"><small><strong>Prénom</strong> (requis)</small></label><br>
								<input id="name" type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>">
								<?php if ($errName != "") : ?>
									<div class="alert alert-danger"><?php echo $errName; ?></div>
								<?php endif; ?>
							</div>
						</div>
						<label for="email"><small><strong>Couriel</strong> (requis)</small></label><br>
						<input id="email" type="email" name="email" placeholder="exemple : robert.razosky@unemail.com" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>">
						<?php if ($errEmail != "") : ?>
							<div class="alert alert-danger"><?php echo $errEmail; ?></div>
						<?php endif; ?>
						<hr />
						<label for="msg-subject"><small><strong>Objet</strong></small></label><br>
						<select id="msg-subject" name="msg-subject" value="<?php echo isset($_POST["msg-subject"]) ? $_POST["msg-subject"] : "" ?>">
							<option value="Demande d'informations">Demande d'informations</option>
						</select><br>
						<label for="msg"><small><strong>Message</strong> (requis)</small></label><br>
						<textarea id="msg" name="msg"><?php echo isset($_POST["msg"]) ? $_POST["msg"] : "" ?></textarea>
						<?php if ($errMsg != "") : ?>
							<div class="alert alert-danger"><?php echo $errMsg; ?></div>
						<?php endif; ?>
						<div>
							<br>
							<div class="d-flex justify-content-center">
								<button id="submit" name="submit" type="submit" value="Submit"><i class="fas fa-arrow-right"></i> Envoyer ce message</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
