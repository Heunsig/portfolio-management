@extends('admin.pictureRoom.layout')

@section('content.breadcrumb')
<a class="section">Home</a>
<div class="divider"> / </div>
<div class="section active" href="#">Picture room</div>
@endsection

@section('content.topButtons')
<a href="{{ route('admin.pictureRooms.create') }}" class="ui primary button">Create New Picture Room</a>
@endsection

@section('content.content')
<h2>Picture room List</h2>
<div class="ui five doubling cards">
  @foreach($pictureRooms as $room)
  <div class="ui card">
    @component('admin.components.cardThumbnail', [
      'picture' => image_path($room->first_picture['saved_dir'], 's3'),
      'tag' => 'a', 
      'attrs' => [
        'href' => route('admin.pictureRooms.show', $room->id)
      ]
    ])
    @endcomponent
    <div class="content">
      <a class="header" href="{{ route('admin.pictureRooms.show', $room->id) }}">{{ $room->title }}</a>
      <div class="meta">
        @component('admin.components.data', ['content' => $room->code, 'tag'=>'span'])
          No code
        @endcomponent
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection