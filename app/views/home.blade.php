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


		<!-- - - - - - - - - - SECTION - - - - - - - - - -->

		<div class="pi-section-w pi-section-white piCaptions">

			<!-- Portfolio gallery -->
			<div id="isotope" class="pi-row pi-liquid-col-xs-2 pi-liquid-col-sm-3 pi-gallery pi-stacked pi-no-margin-bottom pi-text-center isotope pi-column-fix">


				<!-- - - - - - - - - - SECTION - - - - - - - - - -->

				<div class="pi-section-w pi-section-white">
					<div id="isotope" class="pi-row pi-grid-no-margins pi-padding-bottom-20 isotope" data-isotope-mode="masonry">

						<?php foreach ($articulos_tapa as $articulo) {
							$texto = $articulo->texto;
							$archivos = DB::table('archivos')
							->where('padre', '=', 'articulo')
							->where('padre_id', '=', $articulo->id)
							->first();

							if (preg_match('/^.{1,260}\b/s', $articulo->texto, $match))
							{ $texto = $match[0]; }
							$categoria = Categoria::find($articulo->categorias_id);
							?>


							<div class="Photography pi-col-md-4 pi-col-sm-4 pi-col-xs-6 isotope-item">
								<div class="pi-img-w pi-img-hover-zoom">
									<?php if (count($archivos)>0 )  { ?>
										<img src="/uploads/crop/{{ $archivos->archivo }}" alt="">
										<?php } ?>
										<div class="pi-img-overlay pi-img-overlay-darker">
											<div class="pi-caption-centered">
												<div>
													<?php if (count($archivos)>0 )  { ?>
														<a href="/uploads/big/{{ $archivos->archivo }}" class="pi-colorbox">
															<?php } ?>
															<span class="pi-caption-icon pi-caption-scale icon-search"></span>
														</a>
														<h3 class="h4 pi-weight-300"><a href="/articulos/show/{{ $articulo->url_seo }}" class="pi-link-white">{{ $articulo->articulo }}</a></h3>
														<ul class="pi-caption-links">
															<li><i class="icon-tag"></i>{{ $categoria->categoria }}</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>

									<? } ?>

								</div>
							</div>
						</div>
						<!-- - - - - - - - - - END SECTION - - - - - - - - - -->
					</div>
					<!-- End portfolio gallery -->
					<? } ?>
				</div>
				<?php } ?>


			</div>
		</div>
	</div>

	<?php } ?>
	@stop
