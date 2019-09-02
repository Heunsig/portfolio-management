@extends('admin.main')

@section('title','- Create Template')

@push('stylesheets')
{{ Html::style('assets/admin/lib/select2/select2.min.css') }}
@endpush

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.template.index') }}">Template</a></li>
			<li class="active">Create</li>
		</ol>
	</div>
	<div class="col-md-12">	
		{{ Form::open(['route'=>'admin.template.store', 'method'=>'POST', 'files'=>true]) }}
		
		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', null, ['class'=>'form-control']) }}
		
		{{ Form::label('link', 'Link:', ['class'=>'space-margin-top']) }}
		{{ Form::text('link', null, ['class'=>'form-control']) }}
		
		{{ Form::label('cateogries[]', 'Category:',['class'=>'space-margin-top']) }}
		{{ Form::select('categories[]', $categories, null, ['class'=>'form-control select-form-multiple', 'multiple'=>'']) }}

		{{ Form::label('icons[]', 'Support:',['class'=>'space-margin-top']) }}
		{{ Form::select('icons[]', $icons, null, ['class'=>'form-control select-form-multiple', 'multiple'=>'']) }}

		{{ Form::label('explanation', 'Explanation:', ['class'=>'space-margin-top']) }}
		{{ Form::textarea('explanation', null, ['class'=>'form-control']) }}
		
		{{ Form::label('images[]', 'Images:', ['class'=>'space-margin-top']) }}
		{{ Form::file('images[]', ['multiple'=>''])}}
		                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
		{{ Form::submit('Save', ['class'=>'btn btn-block btn-success space-margin-top']) }}

		{{ Form::close() }}
	</div>
</div>

@endsection

@push('scripts')
{{ Html::script('assets/admin/lib/select2/select2.min.js') }}
<script type="text/javascript">
	$(".select-form-multiple").select2();
</script>
@endpush