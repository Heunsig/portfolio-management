<div class="fields __linkFields">
  <div class="five wide field">
    <select name="links[{{ isset($index) ? $index : 0 }}][name]" class="ui fluid search dropdown __linkName">
      <option value="">Name</option>
      <option value="Github" {!! isset($link) ? ($link->name === 'Github' ? 'selected':'') : '' !!}>Github</option>
      <option value="Facebook" {!! isset($link) ? ($link->name === 'Facebook' ? 'selected':'') : '' !!}>Facebook</option>
      <option value="Instagram" {!! isset($link) ? ($link->name === 'Instagram' ? 'selected':'') : '' !!}>Instagram</option>
      <option value="LinkedIn" {!! isset($link) ? ($link->name === 'LinkedIn' ? 'selected':'') : '' !!}>LinkedIn</option>
    </select>
  </div>
  <div class="eleven wide field">
    <input type="text" name="links[{{ isset($index) ? $index : 0 }}][link]" value="{{ isset($link) ? $link->link : '' }}" />
  </div>
</div>
