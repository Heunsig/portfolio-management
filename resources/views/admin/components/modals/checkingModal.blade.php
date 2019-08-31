<div class="ui tiny modal" id="{{ $id }}">
  <div class="header">{{ $title }}</div>
  <div class="content">
    <p class="">{{ $slot }}</p>
  </div>
  <div class="actions">
    <button type="button" class="ui red basic cancel button">
      <i class="remove icon"></i>
      No
    </button>
    <button type="button" class="ui green ok button">
      <i class="checkmark icon"></i>
      Yes
    </button>
  </div>
</div>