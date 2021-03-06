@extends('layouts.default')
@section('content')
<link rel="stylesheet" type="text/css" href="/css/tables.css"/>

<?php if (count($clasificados)>0 )  { ?>


	<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

		<div class="pi-section-w pi-section-white">
			<div class="pi-section">


				<hr class="pi-divider-gap-70">

				<h2 class="h4 pi-weight-700 pi-uppercase pi-has-bg pi-margin-bottom-25">
					Clasificados
				</h2>


<!-- Table -->
		<div class="pi-responsive-table-sm">
			<table class="pi-table pi-table-hovered pi-table-zebra">

				<!-- Table head -->
				<thead>

					<!-- Table row -->
					<tr>
						<!-- <th style="width: 50px;">
							<i class="icon-clock pi-tooltip pi-tooltip-base" data-placement="right" title="" data-original-title="Consectetur adipisicing elit, sed do eiusmod tempor incididunt"></i>
						</th> -->
						<th>
							Categoria
						</th>
						<th>
							Operacion
						</th>
						<th>
							Clasificado
						</th>
						<th>
							Estado
						</th>
						<th>
							Accion
						</th>

					</tr>
					<!-- End table row -->

				</thead>
				<!-- End table head -->

				<!-- Table body -->
				<tbody>




				@foreach ($clasificados as $clasificado)










					<!-- Table row -->
					<tr>
						<td>
							{{$clasificado->clasificadoscategorias_id}}
						</td>
						<td>
							{{$clasificado->operacion}}
						</td>
						<td>
							{{$clasificado->clasificado}}
						</td>
						<td>
							{{$clasificado->estado}}
						</td>
						<td>

							@if ($clasificado->estado === 'espera')
									<a href='/clasificados/{{$clasificado->id}}/publicar' class='btn btn-xs btn-primary'>Publicar</a>
							@else
									<a href='/clasificados/{{$clasificado->id}}/espera' class='btn btn-xs btn-primary'>Espera</a>
							@endif

							<a href='/clasificados/{{$clasificado->id}}/delete' class='btn btn-xs btn-primary'>Eliminar</a>
						</td>
					</tr>
					<!-- End table row -->






				@endforeach


</tbody>
<!-- End table body -->

</table>
</div>
<!-- End table -->


<div class="pi-pagenav pi-text-center">
	{{ $clasificados->links()}}
</div>



			</div>
		</div>

		<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>



		<?php
	}
	?>


	@stop
