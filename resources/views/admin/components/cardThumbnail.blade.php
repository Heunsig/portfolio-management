@php
  $class = 'image catcha c-image-card-thumbnail';
  $style = 'background:url(' . $picture . ');';
  $styleForEmpty = '';

  isset($height) && $height ? $style .= 'height:' .  $height .';' : 'height:150px;';
  isset($height) && $height ? $styleForEmpty .= 'height:' . $height .';' : 'height:150px;';
@endphp

@if(isset($picture) && $picture)
  <{{ isset($tag) && $tag ? $tag : 'div' }} 
    @if(isset($attrs) && $attrs)
      @foreach($attrs as $key => $value)
        @if($key === 'class')
          @php
            $class .= ' ' . $value
          @endphp
        @elseif($key === 'style')
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

    {{-- height="{{ isset($height) && $height ? $height : '200px' }}" --}}
  >
  </{{ isset($tag) && $tag ? $tag : 'div' }}>
@else
  <{{ isset($tag) && $tag ? $tag : 'div' }} 
    class="catcha c-image-empty-card"
    style='{{ $styleForEmpty }}'
    {{-- height="{{ isset($height) && $height ? $height : '200px' }}" --}}
  >
    <i class="ui icon image outline"></i>
  </{{ isset($tag) && $tag ? $tag : 'div' }}>
@endif