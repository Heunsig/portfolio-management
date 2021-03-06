@extends('admin.portfolio.layout')

@section('title', '- Portfolio ')

@section('content.breadcrumb')
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section" href="{{ route('admin.portfolios.index') }}">Portfolio</a>
  <div class="divider"> / </div>
  <div class="section active">View portfolio: {{ $portfolio->id }}</div>
@endsection

@section('content.topButtons')
  <a class="ui grey button" href="{{ route('admin.portfolios.index') }}">
    Back to list
  </a>
  <a class="ui orange button" href="{{ route('admin.portfolios.edit', $portfolio->id) }}">
    Edit
  </a>
  {{ Form::open(['route'=>['admin.portfolios.destroy', $portfolio->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formToDelete']) }}
    <button class="ui red button" id="btnDelete">Delete</button>
  {{ Form::close() }}
@endsection

@section('content.content')
  <h2 class="ui header">View portfolio</h2>
  <div class="ui grid">
    <div class="seven wide column">
      <div class="ui grid">
        <div class="row">
          <div class="column">
            <h3 class="ui header top attached">
              Portfolio #{{ $portfolio->id }}
            </h3>
            <div class="ui segment attached">     
              <div class="ui grid">
                <div class="row">
                  <div class="four wide column">
                    <div class="ui tiny header">ID</div>
                    @component('admin.components.data', ['content'=>$portfolio->id])
                      No id
                    @endcomponent
                  </div>
                  <div class="five wide column">
                    <div class="ui tiny header">Created at</div>
                    @component('admin.components.data', ['content'=>$portfolio->created_at])
                      No created at
                    @endcomponent
                  </div>
                  <div class="five wide column">
                    <div class="ui tiny header">Updated at</div>
                    @component('admin.components.data', ['content'=>$portfolio->updated_at])
                      No updated at
                    @endcomponent
                  </div>
                </div>
                <div class="row">
                  <div class="column">
                    <div class="ui tiny header">Name</div>
                    @component('admin.components.data', ['content'=>$portfolio->name])
                      No name
                    @endcomponent
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <h3 class="ui header top attached">
              Categories & Icons
            </h3>
            <div class="ui segment attached">
              <div class="ui grid">
                <div class="eight wide column">
                  <div class="ui tiny header">Categories</div>
                  <p>
                    @if(count($portfolio->categories))
                      @foreach($portfolio->categories as $category)
                        <div class="ui label grey">{{ $category->name }}</div>
                      @endforeach
                    @else
                      @component('admin.components.data')
                        No categories
                      @endcomponent
                    @endif
                  </p>
                </div>
                <div class="eight wide column">
                  <div class="ui tiny header">Icons</div>
                  <p>
                    @if(count($portfolio->icons))
                      @foreach($portfolio->icons as $icon)
                        <i class="ui icon {{$icon->code}}"></i>
                      @endforeach
                    @else
                      @component('admin.components.data')
                        No icons
                      @endcomponent
                    @endif
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <h3 class="ui header top attached">
              Links
            </h3>
            <div class="ui segment attached">
              <div class="ui list large">
                @if(count($portfolio->links))
                  @foreach($portfolio->links as $link)
                    @component('admin.components.link', ['link'=>$link])
                    @endcomponent
                  @endforeach
                @else
                  @component('admin.components.data')
                    No links
                  @endcomponent
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <h3 class="ui header top attached">
              Explanation
            </h3>
            <div class="ui segment attached">
              @component('admin.components.data', ['content'=>$portfolio->explanation])
                No explanation
              @endcomponent
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="nine wide column">
      <h3 class="ui header top attached">
        Uploaded images
      </h3>
      <div class="ui segment attached">
        <div class="ui grid">
          <div class="row">
            <div class="sixteen wide column">
              @if(count($portfolio->files))
                <div class="ui five doubling cards">
                  @foreach($portfolio->files()->orderBy('order_number','asc')->get() as $file)
                    <div class="card">
                      @component('admin.components.cardThumbnail', [
                        'picture' => image_path(get_thumbnail($file, '300x')),
                        'attrs' => [
                          'class' => 'c-cursor-pointer __btnExpandImage',
                          'data-img-src' => image_path($file->saved_dir)
                        ]
                      ])
                      @endcomponent
                      <div class="content">
                        <div>{{ $file->orig_name }}</div>
                        <div class="meta">
                          <span>{{ humanFileSize($file->size) }}</span>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @else
                @component('admin.components.data')
                  No images
                @endcomponent
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@component('admin.components.modals.checkingModal')
  @slot('id')
    modalDeletePortfolio
  @endslot
  @slot('title')
    Warning
  @endslot
  Do you want to delete this portfolio?
@endcomponent

<div class="ui basic modal __modalExpandImage" style="width: auto;">
  <div class="content"></div>
</div>
@endsection

@push('scripts')
<script>

$('#btnDelete').on('click', e => {
  e.preventDefault()

  $('#modalDeletePortfolio').modal({
    closable: false,
    onApprove: () => {
      $('#modalDeletePortfolio > .actions > button').addClass('loading disabled')
      $('#formToDelete').submit()
      return false
    }
  }).modal('show')
})

$('.__btnExpandImage').on('click', e => {
  e.preventDefault()
  $('.ui.modal.__modalExpandImage').modal({
    onShow: () => {
      var src = e.currentTarget.dataset['imgSrc']
      $('.ui.modal.__modalExpandImage > .content').html(`<img src="${src}"/>`)
    }
  }).modal('show')
})

</script>
@endpush