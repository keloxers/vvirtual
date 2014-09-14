@extends('layouts.default')
@section('content')



@if (count($articulo_tapa))



<?php

$archivos = DB::table('archivos')
->where('padre', '=', 'articulo')
->where('padre_id', '=', $articulo_tapa->id)
->first();

if (preg_match('/^.{1,160}\b/s', $articulo_tapa->copete, $match))
{
	$texto = $match[0] . " ...";
}
$categoria = Categoria::find($articulo_tapa->categorias_id);
?>

?>



<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

	<div class="pi-section-w pi-section-parallax piCounter piTabs piTooltips" style="background-image: url('/uploads/big/{{ $archivos->archivo }}');">
		<div class="pi-texture" style="background: rgba(24, 28, 32, 0.8);"></div>
		<div class="pi-section pi-padding-top-100 pi-padding-bottom-80 pi-text-center">
			<br><br>
			<h2 class="h1 pi-text-shadow pi-has-border pi-has-tall-border pi-has-base-border pi-has-short-border" style="font-size: 40px;">
				{{ $articulo_tapa->articulo }}
			</h2>

			<p class="lead-14 pi-weight-300 pi-margin-bottom-30 pi-p-half">
				{{ $texto }}
			</p>
			<p>
				<a href="/articulos/show/{{ $articulo_tapa->url_seo }}" class="btn pi-btn-base pi-btn-small">
					Leer
				</a>
			</p>

		</div>
	</div>
</div>
<!-- - - - - - - - - - END SECTION - - - - - - - - - -->






@endif



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

				if (preg_match('/^.{1,260}\b/s', $articulo->texto, $match))
				{ $texto = $match[0]; }
				$categoria = Categoria::find($articulo->categorias_id);
				?>

				<div class="pi-col-sm-4 pi-col-xs-6 isotope-item">
					<div class="pi-portfolio-item pi-portfolio-item-round-corners">
						@if (count($archivos)>0 )
						<div class="pi-img-w pi-img-round-corners pi-img-hover-zoom">
							<a href="/uploads/big/{{ $archivos->archivo }}" class="pi-colorbox cboxElement">
								<img src="/uploads/big/{{ $archivos->archivo }}" alt="">

								<div class="pi-img-overlay pi-no-padding pi-img-overlay-dark">
									<div class="pi-caption-centered">
										<div>
											<span class="pi-caption-icon pi-caption-icon-dark pi-caption-scale icon-search"></span>
										</div>
									</div>
								</div>
							</a>
						</div>
						@endif
						<div class="pi-portfolio-description pi-portfolio-description-round-corners-all" style="border-top-width: 1px;">
							<ul class="pi-portfolio-cats">
								<li><i class="icon-clock"></i>{{ $articulo->created_at }}</li>
								<li><i class="icon-eye"></i>{{ $articulo->visitas }} visitas</li>
								@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
								<li><a href="/articulos/{{$articulo->id}}/edit">Editar</a></li>
								@endif
							</ul>
							<h2 class="h4"><a href="/articulos/show/{{ $articulo->url_seo }}" class="pi-link-no-style">{{ $articulo->articulo }}</a>
							</h2>
							<p>{{ $texto }}...</p>
						</div>
					</div>
				</div>


				<?php
				$banner = new Banner();
				$imagen = $banner->imprimir('homesmall');
				?>
				@if ($imagen[0]<>"")


				<div class="pi-col-sm-4 pi-col-xs-6 isotope-item">
					<div class="pi-img-w pi-img-round-corners pi-img-hover-zoom">
						@if ($imagen[1]<>"")
						<a href="{{$imagen[1]}}">
							@endif
							<img src="{{$imagen[0]}}" alt="">
						</a>
					</div>
				</div>
				@endif




				@endforeach






			</div>

			<div class="pi-pagenav pi-text-center">
				{{ $articulos->links()}}
			</div>

		</div>

	</div>

</div>














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

@stop
