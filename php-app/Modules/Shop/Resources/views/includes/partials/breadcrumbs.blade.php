@if($breadcrumbs)
<div class="c-subheader px-3 breadcrumbs">
    <ol class="breadcrumb border-0 m-0">
        @foreach($breadcrumbs as $breadcrumb)
            @if($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item text-bold"><a href="{{ $breadcrumb->url }}" class="text-muted">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">
                    @if(isset($breadcrumb->link))
                        <a class="text-bold text-black" href="{{$breadcrumb->link}}">{!! $breadcrumb->title !!}</a>
                    @else
                        <span class="text-bold text-black">{!! $breadcrumb->title !!}</span>
                    @endif
                </li>
                @if(isset($breadcrumb->lable))
                　<li class="badge badge-secondary p-2">{!! $breadcrumb->lable !!}</li>
                @endif
            @endif
        @endforeach

        @yield('shop::breadcrumb-links')
    </ol>
    @yield('shop::breadcrumb-buttons')
</div>
@endif
