<?php
include "./templates/header.php";
?>

<?php for ($i = 0; $i < 3; $i++) {?>
    <div class="custom-edition my-5">
        <div class="row">
            <div class="col-12">
                <div class="custom-date text-center">
                    <p>Année</p>
                    <h3 class="title">Ajouter date ici</h3>
                </div>
            </div>
        </div>
        <?php for ($j = 0; $j < 3; $j++) {?>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <?php include "./templates/card.php"?>
                </div>
            </div>
        <?php }?>
    </div>
<?php }?>
<?php
include "./templates/footer.php";
?>