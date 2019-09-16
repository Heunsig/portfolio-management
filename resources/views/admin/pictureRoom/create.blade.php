@extends('admin.pictureRoom.layout')

@push('stylesheets')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.3/mustache.min.js"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha/cropper.min.css"/> --}}
@endpush

@section('content.breadcrumb')
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section" href="#">Image</a>
  <div class="divider"> / </div>
  <div class="section active" href="#">Create New Image</div>
@endsection

@section('content.topButtons')
@endsection

@section('content.content')
  <h2>Create New Image</h2>
  {{ Form::open(['route'=>'admin.pictureRooms.store', 'method'=>'POST', 'files'=>true, 'class'=>'ui form', 'id'=>'formFileUpload']) }}
  <div class="ui grid">
    <div class="five wide column">
      <div class="ui top header attached">
        Image information
      </div>
      <div class="ui segment attached">
        <div class="field">
          {{ Form::label('title', 'Title') }}
          {{ Form::text('title', null, ['id'=>'inputTitle']) }}
        </div>
        <div class="field">
          {{ Form::label('code', 'Code') }}
          {{ Form::text('code', null, ['id'=>'inputCode']) }}
        </div>
      </div>
    </div>
    <div class="eleven wide column">
      <div class="ui grid">
        <div class="row">
          <div class="column">
            <div class="ui top header attached">Image upload</div>
            <div class="ui segment attached">
              <div class="field">
                {{ Form::file('images[]', ['multiple'=>'', 'id'=>'inputFile'])}}
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="row">
          <div class="column">
            <div class="ui top header attached">Images ready to be uploaded</div>
            <div class="ui segment attached">
              <div class="ui four doubling cards" id="boxImagesReady">
                <div class="card">
                  <div class="image">
                    <img src="">
                  </div>
                  <div class="ui bottom attached button">
                    Resize & Crop
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
      
      <div class="catcha c-button-box">
        <div class="space"></div>
        <div class="actions">
          {{ Form::submit('Save', ['class'=>'ui button primary', 'id'=>'btnSave']) }}
        </div>
      </div>
    </div>
  </div>
  {{ Form::close() }}
@endsection

@push('scripts')
{{ Html::script('assets/admin/js/slugify.js') }}
{{ Html::script('assets/admin/js/fileReader.js') }}
<script>
  ////////////////////////////////////////////////
  // Automatically slugify name value for code. //
  ////////////////////////////////////////////////
  $('#inputTitle').on('input propertychange', e => {
    e.preventDefault()

    var value = $(e.target).val()
    $('#inputCode').val(slugify(value))
  })
  
  $('#btnSave').on('click', e => {
    e.preventDefault()
    $('#blackout').dimmer({
      closable: false,
      onShow: function () {
        $('#formFileUpload').submit()
      }
    }).dimmer('show')
  })
</script>
@endpush