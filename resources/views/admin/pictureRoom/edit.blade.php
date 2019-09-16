@extends('admin.pictureRoom.layout')

@section('content.breadcrumb')
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section" href="#">Picture Room</a>
  <div class="divider"> / </div>
  <a class="section" href="#">View Picture Room: {{ $pictureRoom->id }}</a>
  <div class="divider"> / </div>
  <div class="section active" href="#">Edit</div>
@endsection

@section('content.topButtons')
  <a href="{{ route('admin.pictureRooms.show', $pictureRoom->id)}}" class="ui grey button">Back to View Page</a>
@endsection

@section('content.content')
  <h2>Edit Picture Room</h2>
  {{ Form::model($pictureRoom, ['route'=>['admin.pictureRooms.update', $pictureRoom->id], 'method'=>'PUT', 'files'=>true, 'class'=>'ui form', 'id'=>'formFileUpload']) }}
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
        <div class="row">
          <div class="column">
            <div class="ui top header attached">Uploaded Pictures</div>
            <div class="ui segment attached">
              @php
                $pictures = $pictureRoom->pictures()->orderBy('order_number','asc')->get()
              @endphp 
              @if(count($pictures))
              <div class="ui five doubling cards" id="uploadedImages" data-pictureroom-id="{{ $pictureRoom->id }}">
                @foreach($pictures as $picture)
                  <div class="ui link card" data-id="{{ $picture->id }}">
                    @component('admin.components.cardThumbnail', [
                      'picture' => image_path(get_thumbnail($picture, '300x'), 'local'), 
                      'attrs' => [
                        'class' => 'c-cursor-pointer'
                      ]
                    ])
                    @endcomponent
                    <div class="content">
                      <div>{{ $picture->orig_name }}</div>
                      <div class="meta">
                        <span class="date">{{ humanFileSize($picture->size) }}</span>
                      </div>
                    </div>
                    <div class="extra content">
                      <button data-id="{{ $picture->id }}" type="button" class="ui mini red basic button __btnDelete">Delete</button>  
                    </div>
                  </div>
                @endforeach
              </div>
              @else
                @component('admin.components.data', ['tag'=>'div'])
                  No images upladed
                @endcomponent
              @endif
            </div>
          </div>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
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

  $(".__btnDelete").on('click', e => {
    var input = document.createElement('input')
    input.setAttribute('type', 'hidden')
    input.setAttribute('name', 'images_to_delete[]')
    input.value = e.target.dataset['id']

    $('form').append(input)
    $(e.target).parents('.ui.link.card').remove()
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

  var uploadedImages = document.querySelector('#uploadedImages')
  if (uploadedImages) {
    var sortable = new Sortable(uploadedImages, {
      ghostClass: 'dragging',
      draggable: '.ui.link.card',
      onUpdate: function (e) {
        var pictureRoomId = this.el.dataset['pictureroomId']
        var sortedIds = this.toArray()

        $.ajax({
          method: "POST",
          url: `/admin/pictureRooms/${pictureRoomId}/resortImages`,
          dataType: "json",
          data: { "sortedIds[]": sortedIds }
        });
      }
    })
  }
</script>
@endpush