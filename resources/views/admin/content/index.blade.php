@extends('admin.content.layout')

@section('title','- Content')

@section('content.breadcrumb')
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <div class="section active">Content</div>
@endsection

@section('content.topButtons')
  <a class="ui primary button" href="{{ route('admin.contents.create') }}">
    Create New Content
  </a>
@endsection

@section('content.content')
  <h2 class="ui header">Content</h2>
  @if(count($contents))
    <div class="ui four doubling cards">
      @foreach($contents as $content)
        <a class="ui teal card" href="{{ route('admin.contents.show', $content->id) }}">
          <div class="content">
            <div class="header">{{ $content->title }}</div>
            <div class="meta">
              @component('admin.components.data', ['content'=>$content->subtitle, 'tag'=>'span'])
                No sub title
              @endcomponent
            </div>
            <div class="description">
              @component('admin.components.data', ['content'=>strip_tags(preg_replace('/\[(.[^\[\]\(\)]+)\]\((.[^\[\]\(\)]+)\)/uim', '<a href="${2}" target="__blank">${1}</a>', $content->content))])
                No content
              @endcomponent
            </div>
          </div>
        </a>
      @endforeach
    </div>
  @else
    @component('admin.components.data')
      No content
    @endcomponent
  @endif
@endsection