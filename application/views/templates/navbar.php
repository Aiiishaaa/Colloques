<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar">
                    <a href="<?= base_url("/") ?>"><img class="img-cerisy" src="<?= base_url("/resources/img/img-1.jpg") ?>" alt="Les colloques CERISY"></a>
                    <form class="form-inline" action="<?= base_url("/rechercher") ?>" method="GET">
                        <p class="title-search">Recherche</p>
                        <input type="search" name="search" class="form-control" placeholder="Date, intervenant, titre..." aria-label="Recherche">
                        <button class="btn-search btn " type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </nav>
            </div>
        </div>
    </div>
</header>
