@extends('layouts.default')
@section('content')



<?php if (count($articulos_tapa)) { ?>

	<!-- Title bar -->
	<div class="pi-section-w pi-section-base pi-section-base-gradient">
		<div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
		<div class="pi-section" style="padding: 15px 40px 12px;">

			<div class="pi-row">
				<div class="pi-col-sm-8 pi-center-text-xs">
					<h1 class="h2 pi-weight-300 pi-margin-bottom-5">Noticias de tapa</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End title bar -->




	<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->
		<div class="pi-section-w pi-section-white piCaptions">

			<!-- Portfolio gallery -->
			<div id="isotope" class="pi-row pi-liquid-col-xs-2 pi-liquid-col-sm-3 pi-gallery pi-stacked pi-no-margin-bottom pi-text-center isotope pi-column-fix">


				<!-- - - - - - - - - - SECTION - - - - - - - - - -->

				<div class="pi-section-w pi-section-white">
					<div id="isotope" class="pi-row pi-grid-no-margins pi-padding-bottom-20 isotope" data-isotope-mode="masonry">

						<?php
						foreach ($articulos_tapa as $articulo) {
							$texto = $articulo->texto;
							$archivos = DB::table('archivos')
							->where('padre', '=', 'articulo')
							->where('padre_id', '=', $articulo->id)
							->first();

							if (preg_match('/^.{1,260}\b/s', $articulo->texto, $match)) {
								$texto = $match[0];
							}
							$categoria = Categoria::find($articulo->categorias_id);
							?>



						</div>
						<!-- - - - - - - - - - END SECTION - - - - - - - - - -->
					</div>
					<!-- End portfolio gallery -->
					<? } ?>
				</div>










			</div>
		</div>
	</div>

<?php } ?>

@stop
