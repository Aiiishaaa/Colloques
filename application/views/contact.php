<?php

/***** messages vars *****/
$errName = "";
$errSurname = "";
$errEmail = "";
$errMsg = "";
$msgSent = "";
$msgSentClass = "";
/*******************************/

if (isset($_POST['submit'])) {
    /****** Contact mail needed ******/
    $toEmail = "";
    
    /* transfert des variables du POST avec htmlspecialchars */
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $msgSubject = htmlspecialchars($_POST['msg-subject']);
    $msg = htmlspecialchars($_POST['msg']);

    $valid = true; /*si une des verification du formulaire ne passe pas cette variable passera à false */
    /* verif si prenom vide*/
    if (empty($name)) {
        $errName = "Veuillez entrer votre prénom";
        $valid = false;
    }
    /* verif si nom vide */
    if (empty($surname)) {
        $errSurname = "Veuillez entrer votre nom";
        $valid = false;
    }
    /* verif du mail */
    /*si vide*/
    if (empty($email)) { 
        $errEmail = "Une adresse E-mail est requise";
        $valid = false;
    /*si non valide */
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $errEmail = "Veuillez entrer une adresse Email valide. <br>exemple : robert.razosky@unemail.com";
        $valid = false;
    }
    /* verif si message vide */
    if (empty($msg)) {
        $errMsg = "Veuillez entrer votre message";
        $valid = false;
    }

    /*verif si toute les validation sont passées */
    if ($valid != false) {
        $msg = wordwrap($msg, 70);
        $header = "MIME-version: 1.0" . "/r/n";
        $header .= "Content-type:text/html;charset=UTF-8" . "/r/n";
        $subject = "Demande de contact de " . $name . " " . $surname . " <" . $email . ">";
        $body = "<h2>Demande de contact<h2>
                <h4>Nom : </h4><p>" . $name . " " . $surname . "</p>
                <h4>Email : </h4><p>" . $email . "</p>
                <h4>Objet : </h4><p>" . $msgSubject . "</p>
                <h4>Message : </h4><p>" . $msg . "</p>";

        /*envoi du mail */
        if (mail($toEmail, $subject, $body, $header)) {
            $msgSent = "Message envoyé";
            $msgSentClass = "alert-success";
        } else {
            $msgSent = "Un problème est survenu, le message n'a pas été envoyé.";
            $msgSentClass = "alert-danger";
        }
    }
}
?>

        <div class="col-sm-6 offset-sm-3" id="contact">
            <h1>Contact</h1>
            <img src="<?= base_url("/resources/img/page-contact.jpg") ?>" />

            <div>
                <?php if ($msgSent != "") : ?>
                    <div class="alert <?php echo $msgSentClass ?>"><?php echo $msgSent; ?></div>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <option value="1">..1..</option>
                        <option value="2">..2..</option>
                        <option value="3">..3..</option>
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
