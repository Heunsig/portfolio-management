<div class="item">
  @if ( $link->name === 'Blogger' )
    <i class="blogger icon"></i>
  @elseif ( $link->name === 'Codepen' )
    <i class="codepen icon"></i>
  @elseif ( $link->name === 'Dropbox' )
    <i class="dropbox icon"></i>
  @elseif ( $link->name === 'Facebook' )
    <i class="facebook icon"></i>
  @elseif ( $link->name === 'Github' )
    <i class="github icon"></i>
  @elseif ( $link->name === 'Google Drive' )
    <i class="google drive icon"></i>
  @elseif ( $link->name === 'Google Play' )
    <i class="google play icon"></i>
  @elseif ( $link->name === 'Gulp' )
    <i class="gulp icon"></i>
  @elseif ( $link->name === 'Instagram' )
    <i class="instagram icon"></i>
  @elseif ( $link->name === 'jsFiddle' )
    <i class="jsfiddle icon"></i>
  @elseif ( $link->name === 'LinkedIn' )
    <i class="linkedin icon"></i>
  @elseif ( $link->name === 'Medium' )
    <i class="medium icon"></i>
  @elseif ( $link->name === 'npm' )
    <i class="npm icon"></i>
  @elseif ( $link->name === 'Pinterest' )
    <i class="pinterest icon"></i>
  @elseif ( $link->name === 'Quora' )
    <i class="quora icon"></i>
  @elseif ( $link->name === 'Reddit' )
    <i class="reddit icon"></i>
  @elseif ( $link->name === 'SoundCloud' )
    <i class="soundcloud icon"></i>
  @elseif ( $link->name === 'Twitter' )
    <i class="twitter icon"></i>
  @elseif ( $link->name === 'Vimeo' )
    <i class="vimeo icon"></i>
  @elseif ( $link->name === 'Youtube' )
    <i class="youtube icon"></i>
  @else
    <i class="linkify icon"></i>
  @endif
  <div class="content">
    <div class="header">{{ $link->name }}</div>
    <a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a>
  </div>
</div>