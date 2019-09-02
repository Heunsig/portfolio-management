<div class="ui top fixed menu" id="mainNav">
  <div class="item">
  	<h1 class="ui teal header">Catcha Portfolio</h1>
    {{-- <img src="https://semantic-ui.com/images/logo.png"/> --}}
  </div>
  <a class="item" href="#">About me</a>
  <a class="item" href="{{ route('admin.portfolio.index') }}">Portfolio</a>
  <a class="item" href="{{ route('admin.type.index') }}">Type</a>
  <a class="item" href="{{ route('admin.icon.index') }}">Icon</a>
  <div class="right menu">
  	<a class="item" href="{{ route('admin.message.index') }}">Message</a>
    <a class="item" href="{{ route('admin.logout') }}">Sign Out</a>
  </div>
</div>