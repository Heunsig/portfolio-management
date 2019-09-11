<div class="ui top fixed menu" id="mainNav">
  <div class="item">
  	<a class="ui teal medium header" href="{{ route('admin.main') }}">Catcha Portfolio</a>
    {{-- <img src="https://semantic-ui.com/images/logo.png"/> --}}
  </div>
  <a class="item" href="{{ route('admin.contents.index') }}">Content</a>
  <a class="item" href="{{ route('admin.portfolios.index') }}">Portfolio</a>
  <a class="item" href="{{ route('admin.categories.index') }}">Category</a>
  <a class="item" href="{{ route('admin.icons.index') }}">Icon</a>
  <a class="item" href="{{ route('admin.pictureRooms.index') }}">Picture Room</a>
  <div class="right menu">
  	<a class="item" href="{{ route('admin.messages.index') }}">Message</a>
    <a class="item" href="{{ route('admin.account.index') }}">Account</a>
    {{-- <a class="item" href="{{ route('admin.account.index') }}">Sign out</a> --}}
    {{-- {{ Form::open(['route'=>'admin.logout', 'method'=>'POST']) }} --}}
    <button type="button" id="btnLogout" class="item catcha c-cursor-pointer c-button-cleanness">Sign out</button>
    {{-- {{ Form::close() }} --}}
  </div>
</div>