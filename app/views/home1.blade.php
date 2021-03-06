@extends('layouts.default')
@section('content')



<br>
<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->
	<div class="pi-section-w pi-section-white">

		<?php
		$banner = new Banner();
		$imagen = $banner->imprimir('homebig');

		?>
		@if ($imagen[0]<>"")
		<!-- Title bar -->

		<div class="pi-row">
			<div class="pi-section-w pi-center-text-xs pi-text-center">

				<a href="{{$imagen[1]}}"><img src="{{$imagen[0]}}" alt=""></a>
			</div>
		</div>

		<!-- End title bar -->
		@endif
	</div>
</div>
<br>





@if (count($articulo_tapa))



<?php

	$archivos = DB::table('archivos')
	->where('padre', '=', 'articulo')
	->where('padre_id', '=', $articulo_tapa->id)
	->first();

	if (preg_match('/^.{1,220}\b/s', $articulo_tapa->copete, $match))
	{
		$texto = $match[0] . " ...";
	}
	$categoria = Categoria::find($articulo_tapa->categorias_id);
?>



<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="tp-banner-container">
<div class="tp-banner pi-revolution-slider" >
<ul class="">

<!-- SLIDE -->
<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" >
<!-- MAIN IMAGE -->

@if ($archivos)
		<img src="/uploads/big/{{$archivos->archivo}}"  alt="imagen"  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
@endif
<!-- LAYERS -->


<!-- LAYER NR. 3 -->
<div class="tp-caption sft str"
	 data-x="25" data-hoffset="0"
	 data-y="320"
	 data-speed="500"
	 data-start="2400"
	 data-easing="Back.easeInOut"
	 data-endspeed="300"
	 style="z-index: 5; font-size: 34px; color: #21252b; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; line-height: 40px; background: rgba(255, 255, 255, 0.5); padding: 12px 16px; border-radius: 3px; box-shadow: 0 1px 1px rgba(0,0,0,0.15);">
	 {{ $articulo_tapa->articulo }}
</div>

<!-- LAYER NR. 4 -->
<div class="tp-caption sfl str"
	 data-x="25" data-hoffset="0"
	 data-y="386"
	 data-speed="500"
	 data-start="2600"
	 data-easing="Back.easeInOut"
	 data-endspeed="300"
	 style="z-index: 6; font-size: 20px; color: #fff; font-weight: 300; line-height: 28px; background: rgba(33, 37, 43, 0.6); padding: 12px 16px; border-radius: 3px;">
	 {{ $texto }} <a href="/articulos/show/{{ $articulo_tapa->url_seo }}" class="btn pi-btn-base pi-btn-small">
		Leer
	</a>

</div>


</li>



</ul>

</div>
</div>

@endif





@if (Auditoriavoto::voto())
<br>


<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

<div class="pi-section-w pi-shadow-inside-top pi-section-base">
	<div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
	<div class="pi-section">

		<!-- Row -->
		<div class="pi-row">

			<!-- Col 8 -->
			<div class="pi-col-sm-12 pi-text-left pi-center-text-sm">
				<p class="lead-30 pi-text-white">
					{{$encuesta->encuesta}} <span class="pi-weight-400">?</span>
				</p>
			</div>
			<!-- End col 8 -->

			<!-- Col 4 -->
			<div class="pi-col-sm-12 pi-center-text-sm pi-center-text-sm">
				<p>
					@foreach ($respuestas as $respuesta)
							<a href="/encuestas/votar/{{$respuesta->id}}" class="btn pi-btn-base-2 pi-btn-big">
								{{$respuesta->respuesta}}
							</a>
					@endforeach
				</p>
			</div>
			<!-- End col 4 -->

		</div>
		<!-- End row -->

	</div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>

@endif





@if (Sentry::check() && Sentry::getUser()->hasAccess('admin') && $encuesta)

<br>
<link rel="stylesheet" type="text/css" href="/css/counters.css"/>

<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-parallax" style="background-image: url(img_external/gallery/modern-skyscraper.jpg);">
	<div class="pi-texture pi-section-overlay-base"></div>
	<div class="pi-section pi-padding-top-50 pi-padding-bottom-20">

		<div class="pi-text-center pi-padding-bottom-20">
			<h6 class="pi-uppercase pi-letter-spacing-3">
				{{$encuesta->encuesta}}
			</h6>
		</div>

		<?php $votos = DB::table('auditoriavotos')->where('encuestas_id', $encuesta->id)->count(); ?>


		@if ($votos > 0)
						<!-- Row -->
						<div class="pi-row pi-grid-small-margins pi-text-center">

							<?php $i=intval(12 / count($respuestas)); ?>

							@foreach ($respuestas as $respuesta)

							<?php

							$voto = DB::table('auditoriavotos')->where('respuestas_id', $respuesta->id)->count();

							$voto = number_format(($voto * 100 / $votos),2);

							?>

							<!-- Col 3 -->
							<div class="pi-col-sm-{{$i}} pi-col-2xs-6 pi-padding-bottom-20">
								<div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="230" data-easing="easeInCirc" data-duration="1000" data-frames-per-second="0">
									<div class="pi-counter-count pi-counter-count-big pi-text-white pi-weight-600 pi-text-shadow">

										<p>
											<i class="icon-thumbs-up"></i>
										</p>
										<div class="pi-counter-number">{{$voto}} %</div>

									</div>
									<p class="lead-18">{{$respuesta->respuesta}}</p>
								</div>
							</div>
							<!-- End col 3 -->

							@endforeach


						</div>
						<!-- End row -->
			@endif
	</div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->












@endif





<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

	<div class="pi-section-w pi-section-white">
		<div class="pi-section">
			<div class="pi-row pi-padding-bottom-10 isotope" data-isotope-mode="masonry">
				@foreach ($articulos as $articulo)
				<?php
				$texto = $articulo->texto;
				$archivos = DB::table('archivos')
				->where('padre', '=', 'articulo')
				->where('padre_id', '=', $articulo->id)
				->first();

				if (preg_match('/^.{1,460}\b/s', $articulo->copete, $match))
				{ $texto = $match[0]; }
				$categoria = Categoria::find($articulo->categorias_id);
				?>

				<div class="pi-col-sm-4 pi-col-xs-6 isotope-item">
					<div class="pi-portfolio-item pi-portfolio-item-round-corners">
						@if (count($archivos)>0 )
						<div class="pi-img-w pi-img-round-corners pi-img-hover-zoom">
							<a href="/articulos/show/{{ $articulo->url_seo }}">
								<img src="/uploads/big/{{ $archivos->archivo }}" alt="">
							</a>
						</div>
						@endif
						<div class="pi-portfolio-description pi-portfolio-description-round-corners-all" style="border-top-width: 1px;">
							<ul class="pi-portfolio-cats">
								<li><i class="icon-clock"></i>{{ $articulo->created_at }}</li>
								@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
								<li><a href="/articulos/{{$articulo->id}}/edit">Editar</a></li>
								@endif
							</ul>
							<h2 class="h4"><a href="/articulos/show/{{ $articulo->url_seo }}" class="pi-link-no-style">{{ $articulo->articulo }}</a>
							</h2>
							<p>{{ $texto }} ...</p>
							<a href="/articulos/show/{{ $articulo->url_seo }}" class="btn pi-btn-base pi-btn-small">
							Leer
						</a><br>
							<b>{{ $articulo->visitas }} visitas</b>

						</div>
					</div>
					<hr class="pi-divider pi-divider-dashed pi-divider-big">

				</div>



				@endforeach

			</div>

			<div class="pi-pagenav pi-text-center">
				{{ $articulos->links()}}
			</div>

		</div>

	</div>



<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

	<!-- Title bar -->
	<div class="pi-section-w pi-section-base pi-section-base-gradient">
		<div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
		<div class="pi-section" style="padding: 15px 40px 12px;">

			<div class="pi-row">
				<div class="pi-col-sm-8 pi-center-text-xs"><a href="http://vender.virasorovirtual.com">
					<h1 class="h2 pi-weight-300 pi-margin-bottom-5">Clasificados</h1>
				</a>
				</div>
			</div>

		</div>
	</div>
	<!-- End title bar -->



<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->
<div class="pi-section-w pi-section-white piTooltips">
	<div class="pi-section pi-padding-bottom-80">

		<div class="pi-row pi-grid-small-margins">

			<div class="pi-col-md-12">


								<a href="http://vender.virasorovirtual.com">
										<img src="/publicidades/vendervirasorovirtual.gif" alt="">
								</a>

</div>

		</div>

	</div>
</div>
<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>




<?php

$fecha=date("Y-m-d");

$turno = DB::table('turnos')
					->where('fecha', '=', $fecha)
					->first();
if ($turno) {

?>

<!-- Title bar -->
<div class="pi-section-w pi-section-base pi-section-base-gradient">
	<div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
	<div class="pi-section" style="padding: 15px 40px 12px;">

		<div class="pi-row">
			<div class="pi-col-sm-8 pi-center-text-xs">
				<h1 class="h2 pi-weight-300 pi-margin-bottom-5">
					Farmacia de Turno: {{ $turno->turno }}
				</h1>
			</div>
		</div>

	</div>
</div>
<!-- End title bar -->

<?php
				}
?>



<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->
	<div class="pi-section-w pi-section-white">
		<div class="pi-section">
			<div class="pi-row pi-padding-bottom-10 isotope" data-isotope-mode="masonry">
				@foreach ($banners_smalls as $banners_small)


						<div class="pi-col-sm-4 pi-col-xs-6 isotope-item">
							<div class="pi-img-w pi-img-round-corners pi-img-hover-zoom">
								@if ($banners_small->link <> "")
										<a href="{{ $banners_small->link }}">
								@endif


								<img src="/publicidades/{{ $banners_small->file }}" alt="">


								@if ($banners_small->link <> "")
									</a>
								@endif


							</div>
						</div>


				@endforeach

			</div>
		</div>
	</div>
</div>



<br>
<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

	<!-- Title bar -->
	<div class="pi-section-w pi-section-base pi-section-base-gradient">
		<div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
		<div class="pi-section" style="padding: 15px 40px 12px;">

			<div class="pi-row">
				<div class="pi-col-sm-8 pi-center-text-xs">
					<h1 class="h2 pi-weight-300 pi-margin-bottom-5">Pronostico del tiempo</h1>
				</div>
			</div>

		</div>
	</div>
	<!-- End title bar -->


	<div class="pi-section-w pi-section-white">

		<div class="pi-row">
			<div class="pi-section-w pi-center-text-xs pi-text-center">
				<br>
				<div align="center" >
					<div id="cont_16c6d6472b04ecc46ddb420b74655790">
					<span id="h_16c6d6472b04ecc46ddb420b74655790"><a id="a_16c6d6472b04ecc46ddb420b74655790" href="http://www.tiempo.com/" target="_blank" style="color:#656565;font-family:Arial;font-size:14px;">Predicci&oacute;n 14 d&iacute;as</a></span>
					<script type="text/javascript" src="http://www.tiempo.com/wid_loader/16c6d6472b04ecc46ddb420b74655790"></script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>








<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->



	<!-- Title bar -->
	<div class="pi-section-w pi-section-base pi-section-base-gradient">
		<div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
		<div class="pi-section" style="padding: 15px 40px 12px;">

			<div class="pi-row">
				<div class="pi-col-sm-8 pi-center-text-xs">
					<h1 class="h2 pi-weight-300 pi-margin-bottom-5">Más vistas de la semana</h1>
				</div>
			</div>

		</div>
	</div>
	<!-- End title bar -->







	<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

		<div class="pi-section-w pi-section-white">
			<div class="pi-section">

				<!-- Row -->
				<div class="pi-row">



					@foreach ($articulos_masvistos as $articulo)
					<?php
					$texto = $articulo->texto;
					$archivos = DB::table('archivos')
					->where('padre', '=', 'articulo')
					->where('padre_id', '=', $articulo->id)
					->first();

					if (preg_match('/^.{1,110}\b/s', $articulo->texto, $match))
					{ $texto = $match[0]; }
					$categoria = Categoria::find($articulo->categorias_id);
					?>




					<!-- Col 4 -->
					<div class="pi-col-xs-3">

						<!-- Post item -->
						<div class="pi-img-w pi-img-round-corners pi-img-shadow">
							<a href="/articulos/show/{{ $articulo->url_seo }}">
								@if (count($archivos)>0 )
								<img src="/uploads/crop/{{ $archivos->archivo }}" alt="">
								@endif
								<span class="pi-img-overlay pi-img-overlay-white">
								</span>
							</a>
						</div>

						<h2 class="h5 pi-margin-bottom-5">
							<a href="/articulos/show/{{ $articulo->url_seo }}" class="pi-link-dark">{{ $articulo->articulo }}</a>
						</h2>
						<ul class="pi-meta pi-margin-bottom-10">
							<li><i class="icon-clock"></i>{{ $articulo->created_at }}</li>
							<li><i class="icon-eye"></i>{{ $articulo->visitas }} visitas</li>
						</ul>
						<p>
							{{ $texto }}... <a href="/articulos/show/{{ $articulo->url_seo }}" class="pi-italic">Leer</a>
						</p>
						<!-- End post item -->

					</div>
					<!-- End col 4 -->


					@endforeach
				</div>
				<!-- End row -->
			</div>
		</div>
	</div>























</div>
</div>
</div>

<script src="/scripts/pi.counter.js"></script>
<script src="/scripts/pi.init.counter.js"></script>


@stop
