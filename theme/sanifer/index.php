<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>VESTA || SANIFER</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="theme/sanifer/images/favicon.ico" />
	<link rel="stylesheet" href="theme/sanifer/plugins/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="theme/sanifer/plugins/bootstrap/responsive.bootstrap.min.css">	
	<link rel="stylesheet" href="theme/sanifer/plugins/themify-icons/themify-icons.css">
	<link href="theme/sanifer/assets/style.css" rel="stylesheet" media="screen" />
	<link rel="stylesheet" href="theme/sanifer/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="theme/sanifer/plugins/jquery/jquery-ui.css">
</head>

<body>
	<div id="loading">
      <img id="loading-image" src="theme/sanifer/images/chargement.gif" alt="Chargement..." />
    </div> 
	<header class="banner overlay bg-cover" data-background="theme/sanifer/images/banner.jpg">
		<nav class="navbar navbar-fixed-top navbar-expand-lg p-0">
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" width="100%" id="navbarNav">
	         
	        </div>
	        <a class="nav-item mr-3 nav-link p-3" href="index.php"><img title="Se déconnecter" alt="Se déconnecter" class="deconnexion" src="theme/sanifer/images/deconnexion.png"></a>
	    </nav>
		<div class="container section header_">
			<div class="row">
				<div class="col-lg-8 text-center mx-auto margin_t">
					<h1 class="text-white mb-3">VESTA</h1>
					<div class="position-relative">
						<input id="search" class="form-control" placeholder="Réf.; Desc.; CB; Ref fourn..."><i class="ti-search search-icon"></i>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section>
		
				<div class="col-12">
					<div class="section px-3 bg-white shadow text-right">
						<form action="./tcpdf/sanifer/impression.php" method="post" >
							<table class="table table-hover table-fixed">
							  <thead>
							    <tr>
							      <th>N°</th>
							      <th>Désignation</th>
							      <th>Famille</th>
							      <th>Ref Fournisseur</th>
							      <th>Prix de vente</th>
							      <th>Qte</th>
							      <th>Total</th>
							      <th class="S1">Stock S1</th>
							      <th class="S2">Stock S2</th>
							      <th class="S3">Stock S3</th>
							      <th class="S4">Stock S4</th>
							      <th>Cmde Fournisseur</th>
							      <th>Date dernière cmde</th>
							      <th></th>
							    </tr>
							  </thead>
							  <tbody class="articles_">							    
							  </tbody>
							  <tfoot>
						        <tr>
						        	<th></th>
						        	<th></th>
						        	<th></th>
						        	<th></th>
						        	<th></th>
						            <th></th>
						            <td class="somme" align="right"></td>
						            <th></th>
						        	<th></th>
						        	<th></th>
						        	<th></th>
						        	<th></th>
						        	<th></th>
						        	<th></th>
						        </tr>
						   	  </tfoot>
							</table>
							<a class="btn btn-primary reactualiser" >REACTUALISER</a>
							<button class="btn btn-success imprimer" >Imprimer</button>
							<button class="btn btn-danger hidden-print supprimer_tout" >Supprimer tout</button>
						</form>
					</div>
				</div>
		
	</section>

	<div class="modal fade Articlemodal-lg" tabindex="-1" role="dialog" aria-labelledby="Listes articles SANIFER" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="ModalCenterTitle">Listes des articles SANIFER</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
		    <div class="modal-body">
		    	<table id="datatable_" class="table table-striped table-bordered dt-responsive nowrap">
					<thead>
						<tr>
						   	<th scope="col">N°</th>
						    <th scope="col">Désignation</th>
						    <th scope="col">Famille</th>
						    <th scope="col">Ref fournisseur</th>
						</tr>
					</thead>
					<tbody class="resultat">
					</tbody>
				</table>
		    </div>
		    <div class="modal-footer">
		    </div>
		</div>
	</div>

	<footer class="section pb-4">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12 text-md-right text-center">
					<p class="mb-md-0 mb-4">Copyright © 2022 <a href="https://www.sanifer.mg/">SANIFER</a></p>
				</div>
			</div>
		</div>
	</footer>

	<div id="dialog" title="ALERTE">
	  <h5 class="alert_">Le nombre maximum de ligne d'articles est 10 !!</h5>
	</div>

	<input type="hidden" id="site" value="<?php echo !empty($_SESSION['site']) ? $site : '';?>">

	<script src="theme/sanifer/plugins/jquery/jquery-1.12.4.js"></script>
	<script src="theme/sanifer/plugins/bootstrap/bootstrap.min.js"></script>
	<script src="theme/sanifer/plugins/bootstrap/datatables.min.js"></script>
	<script src="theme/sanifer/plugins/match-height/jquery.matchHeight-min.js"></script>
	<script src="theme/sanifer/plugins/jquery/jquery-ui.js"></script>
	<script src="theme/sanifer/assets/script.js"></script>
</body>

</html>