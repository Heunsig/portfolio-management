@extends('admin.main')

@section('title','- Content')

@section('content')
<div class="ui grid">
  <div class="sixteen wide column">
    <div class="ui grid catcha c-header-main">
      <div class="twelve wide column">
        <h1 class="ui header catcha c-header-title">Content</h1>
        <div class="ui breadcrumb">
          <a class="section">Home</a>
          <div class="divider"> / </div>
          <div class="section active">Content</div>
        </div>
      </div>
      <div class="four wide column right aligned">
        <a class="ui primary button" href="{{ route('admin.contents.create') }}">
          Create New Content
        </a>
      </div>
    </div>
  </div>
  <div class="sixteen wide column">
    <h2 class="ui header">Content</h2>
    <div class="ui four doubling cards">
      @if(count($contents))
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
      @else
        No content
      @endif
    </div>
  </div>
</div>
@endsection