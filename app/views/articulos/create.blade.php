@extends('layouts.default')

@section('content')




<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->
<div class="pi-section-w pi-section-white piICheck piStylishSelect">
	<div class="pi-section pi-padding-bottom-80">

		<div class="pi-text-center pi-margin-bottom-60">
			<h1 class="pi-uppercase pi-weight-700 pi-has-border pi-has-tall-border pi-has-short-border pi-margin-bottom-70">
				Agregar Noticia
			</h1>
		</div>


		<!-- Row -->
		<div class="pi-row">

			<!-- Col 6 -->
			<div class="pi-col-xs-8">

				<h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
					Ingrese la nueva publicacion por favor
				</h4>

				<hr class="pi-divider-gap-10">

				<!-- Forms -->
				{{ Form::open(array('route' => 'articulos.store', 'class' => 'panel-body wrapper-lg')) }}

					<!-- First name form -->
					<div class="form-group">
						<label for="titular">Titular</label>

						<div class="pi-input-with-icon">
							<div class="pi-input-icon"><i class="icon-pencil"></i></div>
							{{ Form::text('articulo', '', array('class' => 'form-control', 'id' => 'articulo', 'placeholder' => 'Ingrese el titular')) }}
						</div>
					</div>
					<!-- End first name form -->

					<!-- Message -->
					<div class="form-group">
						<label for="copete">Copete</label>

						<div class="pi-input-with-icon">
							<div class="pi-input-icon"><i class="icon-pencil"></i></div>
							<textarea class="form-control" id="copete" name="copete" placeholder="Copete" rows="4"></textarea>
						</div>
					</div>
					<!-- End message form -->


					<!-- Message -->
					<div class="form-group">
						<label for="articulo">Articulo</label>

						<div class="pi-input-with-icon">
							<div class="pi-input-icon"><i class="icon-pencil"></i></div>
							<textarea class="form-control" id="texto" name="texto" placeholder="texto del articulo?" rows="16"></textarea>
						</div>
					</div>
					<!-- End message form -->

					<!-- Message -->
					<div class="form-group">
						<label for="exampleInputMessage-3">Tipo</label>

							{{ Form::select('tipo', array('principal' => 'Principal', 'secundaria' => 'Secundaria'), 'secundaria', array('class' => 'form-control input-lg', 'id' =>'tipo')) }}

					</div>
					<!-- End message form -->

					<!-- Message -->
					<div class="form-group">
						<label for="exampleInputMessage-3">Categoria</label>


								{{ Form::select( 'categorias_id', Categoria::All()->
										lists('categoria', 'id'), Input::get('categoria'), array( "placeholder" => "", 'class' => 'form-control input-lg')) }}

					</div>
					<!-- End message form -->

					<!-- Message -->
					<div class="form-group">
						<label for="exampleInputMessage-3">Permitir comentarios</label>

							{{ Form::select('comentarios', array('si' => 'Si', 'no' => 'No'), 'si', array('class' => 'form-control input-lg', 'id' =>'comentarios')) }}

					</div>
					<!-- End message form -->

					<!-- First name form -->
					<div class="form-group">
						<label for="titular">Tags</label>

						<div class="pi-input-with-icon">
							<div class="pi-input-icon"><i class="icon-pencil"></i></div>
							{{ Form::text('tags', '#VirasoroVirtual', array('class' => 'form-control', 'id' => 'tags', 'name' => 'tags', 'placeholder' => 'Ingrese Tags')) }}
						</div>
					</div>
					<!-- End first name form -->


					<hr class="pi-divider-gap-10">

					<!-- Submit button -->
					<p>
						<button type="submit" class="btn pi-btn-base pi-btn-big pi-uppercase pi-weight-700 pi-letter-spacing">
							<i class="icon-check pi-icon-left"></i>Enviar noticia
						</button>
					</p>
					<!-- End submit button -->

				</form>
				<!-- End forms -->

			</div>
			<!-- End col 6 -->


	</div>
</div>
<!-- - - - - - - - - - END SECTION - - - - - - - - - -->





@stop
