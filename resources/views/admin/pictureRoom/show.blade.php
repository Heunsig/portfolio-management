@extends('admin.pictureRoom.layout')

@section('content.breadcrumb')
<a class="section">Home</a>
<div class="divider"> / </div>
<a class="section" href="#">Picture room</a>
<div class="divider"> / </div>
<div class="section active" href="#">View picture room: {{ $pictureRoom->id }}</div>
@endsection

@section('content.topButtons')
<a class="ui grey button" href="{{ route('admin.pictureRooms.index') }}">Back to list</a>
<a class="ui orange button" href="{{ route('admin.pictureRooms.edit', $pictureRoom->id) }}">Edit</a>
@endsection

@section('content.content')
<h2>View Image</h2>
<div class="ui grid">
  <div class="four wide column">
    <div class="ui header top attached">Picture Room Information</div>
    <div class="ui segment attached">
      <div class="ui grid">
        <div class="row">
          <div class="column">
            <div class="ui tiny header">Title</div>
            <p>{{ $pictureRoom->title }}</p>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <div class="ui tiny header">Code</div>
            @component('admin.components.data', ['content'=>$pictureRoom->code])
              No code
            @endcomponent
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="twelve wide column">
    <div class="ui header top attached">Pictures</div>
    <div class="ui segment attached">
      @if(count($pictureRoom->pictures))
        <div class="ui five doubling cards">
          @foreach($pictureRoom->pictures()->orderBy('order_number','asc')->get() as $picture)
            <div class="card">
              @component('admin.components.cardThumbnail', [
                'picture' => image_path(get_thumbnail($picture, '300x')),
                'attrs' => [
                  'class' => 'c-cursor-pointer __btnExpandImage',
                  'data-img-src' => image_path($picture->saved_dir)
                ]
              ])
              @endcomponent
              {{-- @component('admin.components.cardThumbnail', [
                'picture' => image_path(get_thumbnail($picture, '300x'), 'local'), 
                'attrs' => [
                  'class' => 'c-cursor-pointer __btnExpandImage',
                  'data-img-src' => image_path($picture->saved_dir)
                ]
              ])
              @endcomponent --}}
              <div class="content">
                <div>{{ $picture->orig_name }}</div>
                <div class="meta">
                  <span>{{ humanFileSize($picture->size) }}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        @component('admin.components.data')
          No images
        @endcomponent
      @endif
    </div>
  </div>
</div>

<div id="modalExpandImage" class="ui basic modal" style="width: auto;">
  <div class="content"></div>
</div>
@endsection

@push('scripts')
<script>
  $('.__btnExpandImage').on('click', e => {
    e.preventDefault()
    $('#modalExpandImage').modal({
      onShow: () => {
        var src = e.currentTarget.dataset['imgSrc']
        $('#modalExpandImage > .content').html(`<img src="${src}" style="max-width: 1000px;"/>`)
      }
    }).modal('show')
  })
</script>
@endpush