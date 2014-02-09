@section('main')

	<div class="row">

		{{ Former::vertical_open()->method('PATCH')->action('admin/'.$model->view.'/'.$model->id)->role('form')->class('col-sm-6') }}
			@include('news.admin._form')
		{{ Former::close() }}

		<div class="col-sm-6">
		@include('files.admin._list', array('files' => $model->files))
		</div>

	</div>

@stop