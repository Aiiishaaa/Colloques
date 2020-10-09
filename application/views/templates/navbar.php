<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar w-100 d-flex flex-row justify-content-between">
                    <a href="<?= base_url("/") ?>"><img class="img-cerisy" src="<?= base_url("/resources/img/img-1.jpg") ?>" alt="Les colloques CERISY"></a>
                    <form class="form-inline d-flex flex-row flex-nowrap" action="<?= base_url("/rechercher") ?>" method="GET">
                        <p class="title-search d-none d-sm-block">Recherche</p>
                        <input type="search" name="search" class="form-control d-none d-sm-block" placeholder="Date, intervenant, titre..." aria-label="Recherche">
                        <button class="btn-search btn " type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </nav>
            </div>
        </div>
    </div>
</header>
