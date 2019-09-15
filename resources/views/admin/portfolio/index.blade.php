@extends('admin.portfolio.layout')

@section('content.breadcrumb')
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <div class="section active">Portfolio</div>
@endsection

@section('content.topButtons')
  <a class="ui primary button" href="{{ route('admin.portfolios.create') }}">
    Create New Portfolio
  </a>
@endsection

@section('content.content')
  <h2 class="ui header">Portfolio List</h2>
  <div class="ui segment">
    <table id="itemListTbl" class="ui very basic celled table" data-tbl-type="portfolio">
      <thead>
        <tr>
          <th width="50"></th>
          <th width="70">#</th>
          <th width="110" class="center aligned">Thumbnail</th>
          <th>Name</th>
          <th width="350" class="center aligned">Categories</th>
          <th width="200" class="center aligned">Icons</th>
          <th width="175"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($portfolios as $portfolio)
        <tr data-id="{{ $portfolio->id }}">
          <td class="center aligned">
             <i class="arrows alternate icon catcha c-cursor-pointer __dragHandle"></i>
          </td>
          <td>{{ $portfolio->id }}</td>
          <td class="">
            @component('admin.components.listItemThumbnail', [
              'picture' => image_path(get_thumbnail($portfolio->first_picture, '90x')),
              'height' => '60px'
            ])
            @endcomponent
          </td>
          <td>{{ $portfolio->name }}</td>
          <td class="center aligend">
            @foreach($portfolio->categories as $category)
              <div class="ui label grey">{{ $category->name }}</div>
            @endforeach
          </td>
          <td>
            @foreach($portfolio->icons as $icon)
              <i class="icon {{ $icon->code }} custom-icon-style"></i>
            @endforeach
          </td>
          <td class="center aligned">
            <a href="{{ route('admin.portfolios.show', $portfolio->id)}}" class="ui positive button tiny">View</a>
            <a href="{{ route('admin.portfolios.edit',$portfolio->id) }}" class="ui orange button tiny">Edit</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
      {!! $portfolios->links(); !!}
    </div>
  </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
  var sortable = new Sortable(document.querySelector('#itemListTbl tbody'), {
    ghostClass: 'dragging',
    draggable: 'tr',
    handle:'.__dragHandle',
    onUpdate: function (e) {
      var type = 'portfolio'
      var sortedIds = this.toArray()

      $.ajax({
        method: "PUT",
        url: `/admin/relocateListOrder/${type}`,
        dataType: "json",
        data: {"sortedIds[]": sortedIds},
        success: function(data){
          console.log(data);
        }
      });
    }
  })
</script>
@endpush