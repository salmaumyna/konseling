<div class="page-header">
  <h3 class="page-title">{{ $title }}</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        @if(isset($link))
      <a href="{{ $link }}">{{ $li_1 }}</a>
    @else
    {{ $li_1 }}
  @endif
      </li>
      @if(isset($link_2))
      <li class="breadcrumb-item">
      <a href="{{ $link_2 }}">
        {{ $li_2 }}
      </a>
      </li>
    @else
      <li class="breadcrumb-item active">
      {{ $li_2 }}
      </li>
    @endif
      @if (isset($li_3))
      @if(isset($link_3))
      <li class="breadcrumb-item"><a href="{{ $link_3 }}">{{ $li_3 }}</a></li>
    @else
      <li class="breadcrumb-item">{{ $li_3 }}</li>
    @endif
    @endif
      @if (isset($li_4))
      <li class="breadcrumb-item active">{{ $li_4 }}</li>
    @endif
    </ol>
  </nav>
  @if (isset($action_button))
    <div>
      {!! $action_button !!}
    </div>
  @endif
</div>