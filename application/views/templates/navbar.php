<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar w-100 d-flex flex-row justify-content-between">
                    <a href="<?= base_url("/") ?>"><img class="img-cerisy" src="<?= base_url("/resources/img/img-1.jpg") ?>" alt="Les colloques CERISY"></a>
					<span class="h6 d-none d-md-block text-uppercase font-weight-bold">Territoire solidaire en commun</span>
                    <form class="form-inline d-flex flex-row flex-nowrap" action="<?= base_url("/rechercher") ?>" method="GET">
                        <p class="title-search d-none d-sm-block">Recherche</p>
                        <input type="search" name="search" class="form-control d-none d-sm-block" placeholder="Date, intervenant, titre..." aria-label="Recherche">
                        <div class="btn-search btn" id="mobile-search-btn"><i class="fa fa-search"></i></div>
                    </form>
                </nav>

            </div>
			<!-- Barre de recherche uniquement pour le mobile -->
			<div class="col-12 d-sm-none d-block">
				<form class="form-inline d-flex flex-row flex-nowrap" action="<?= base_url("/rechercher") ?>" method="GET">
					<input id="mobile-search-bar" type="search" name="search" class="w-100 form-control" placeholder="Date, intervenant, titre..." aria-label="Recherche">
				</form>
			</div>
        </div>
    </div>
</header>
