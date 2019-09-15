@php
  $class = 'image catcha c-image-thumbnail';
  $style = 'background:url(' . $picture . ');';
  $styleForEmpty = '';

  isset($height) && $height ? $style .= 'height:' .  $height .';' : 'height:50px;';
  isset($height) && $height ? $styleForEmpty .= 'height:' . $height .';' : 'height:50px;';
@endphp

@if(isset($picture) && $picture)
  <{{ isset($tag) && $tag ? $tag : 'div' }} 
    @if(isset($attrs) && $attrs)
      @foreach($attrs as $key => $value)
        @if ($key === 'class')
          @php
            $class .= ' ' . $value
          @endphp
        @elseif ($key === 'style')
          @php
            $style .= ' ' . $value
          @endphp
        @else
          {{ $key }}="{{$value}}"
        @endif
      @endforeach()
    @endif
    
    class='{{ $class }}'
    style='{{ $style }}'
  >
  </{{ isset($tag) && $tag ? $tag : 'div' }}>
@else
  <{{ isset($tag) && $tag ? $tag : 'div' }} 
    class="catcha c-image-empty"
    style='{{ $styleForEmpty }}'
  >
    <i class="ui icon image outline"></i>
  </{{ isset($tag) && $tag ? $tag : 'div' }}>
@endif