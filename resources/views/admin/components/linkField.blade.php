<div class="fields __linkFields">
  <div class="six wide field">
    <select name="links[{{ isset($index) ? $index : 0 }}][name]" class="ui fluid search dropdown __linkName">
      <option value="">Select or Input</option>
      <option value="Blogger" {!! isset($link) ? ($link->name === 'Blogger' ? 'selected':'') : '' !!}>Blogger</option>
      <option value="Codepen" {!! isset($link) ? ($link->name === 'Codepen' ? 'selected':'') : '' !!}>Codepen</option>
      <option value="Dropbox" {!! isset($link) ? ($link->name === 'Dropbox' ? 'selected':'') : '' !!}>Dropbox</option>
      <option value="Facebook" {!! isset($link) ? ($link->name === 'Facebook' ? 'selected':'') : '' !!}>Facebook</option>
      <option value="Github" {!! isset($link) ? ($link->name === 'Github' ? 'selected':'') : '' !!}>Github</option>
      <option value="Google Drive" {!! isset($link) ? ($link->name === 'Google Drive' ? 'selected':'') : '' !!}>Google Drive</option>
      <option value="Google Play" {!! isset($link) ? ($link->name === 'Google Play' ? 'selected':'') : '' !!}>Google Play</option>
      <option value="Gulp" {!! isset($link) ? ($link->name === 'Gulp' ? 'selected':'') : '' !!}>Gulp</option>
      <option value="Instagram" {!! isset($link) ? ($link->name === 'Instagram' ? 'selected':'') : '' !!}>Instagram</option>
      <option value="jsFiddle" {!! isset($link) ? ($link->name === 'jsFiddle' ? 'selected':'') : '' !!}>jsFiddle</option>
      <option value="LinkedIn" {!! isset($link) ? ($link->name === 'LinkedIn' ? 'selected':'') : '' !!}>LinkedIn</option>
      <option value="Medium" {!! isset($link) ? ($link->name === 'Medium' ? 'selected':'') : '' !!}>Medium</option>
      <option value="npm" {!! isset($link) ? ($link->name === 'npm' ? 'selected':'') : '' !!}>npm</option>
      <option value="Pinterest" {!! isset($link) ? ($link->name === 'Pinterest' ? 'selected':'') : '' !!}>Pinterest</option>
      <option value="Quora" {!! isset($link) ? ($link->name === 'Quora' ? 'selected':'') : '' !!}>Quora</option>
      <option value="Reddit" {!! isset($link) ? ($link->name === 'Reddit' ? 'selected':'') : '' !!}>Reddit</option>
      <option value="SoundCloud" {!! isset($link) ? ($link->name === 'SoundCloud' ? 'selected':'') : '' !!}>SoundCloud</option>
      <option value="Twitter" {!! isset($link) ? ($link->name === 'Twitter' ? 'selected':'') : '' !!}>Twitter</option>
      <option value="Vimeo" {!! isset($link) ? ($link->name === 'Vimeo' ? 'selected':'') : '' !!}>Vimeo</option>
      <option value="Youtube" {!! isset($link) ? ($link->name === 'Youtube' ? 'selected':'') : '' !!}>Youtube</option>
    </select>
  </div>
  <div class="ten wide field">
    <input type="text" name="links[{{ isset($index) ? $index : 0 }}][link]" value="{{ isset($link) ? $link->link : '' }}" />
  </div>
</div>
