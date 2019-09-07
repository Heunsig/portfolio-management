@if(isset($content) && $content)
  @if(isset($tag))
    <{{$tag}}>{!! $content !!}</{{$tag}}>
  @else
    <p>{!! $content !!}</p>
  @endif
@else
  @if(isset($tag))
    <{{$tag}} class="catcha c-text-noContent">{{ $slot }}</{{$tag}}>
  @else
    <p class="catcha c-text-noContent">{{ $slot }}</p>
  @endif
@endif