<div class="ui top fixed menu" id="mainNav">
  <div class="item">
  	<a class="ui teal medium header" href="{{ route('admin.main') }}">Catcha Portfolio</a>
    {{-- <img src="https://semantic-ui.com/images/logo.png"/> --}}
  </div>
  <a class="item" href="{{ route('admin.content.index') }}">Content</a>
  <a class="item" href="{{ route('admin.portfolio.index') }}">Portfolio</a>
  <a class="item" href="{{ route('admin.category.index') }}">Category</a>
  <a class="item" href="{{ route('admin.icon.index') }}">Icon</a>
  <div class="right menu">
  	<a class="item" href="{{ route('admin.message.index') }}">Message</a>
    <a class="item" href="{{ route('admin.account.index') }}">Account</a>
    <a class="item" href="{{ route('admin.logout') }}">Sign out</a>
  </div>
</div>