@php
  $class = 'image catcha c-image-card-thumbnail';
  $style = 'background:url(' . $picture . ');background-size:cover;background-position:center;';
@endphp

@if(isset($picture))
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
  >
  </{{ isset($tag) && $tag ? $tag : 'div' }}>
@else
  <{{ isset($tag) && $tag ? $tag : 'div' }} class="catcha c-image-empty-card">
    <i class="ui icon image outline"></i>
  </{{ isset($tag) && $tag ? $tag : 'div' }}>
@endif