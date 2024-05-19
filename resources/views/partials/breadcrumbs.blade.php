 @unless ($breadcrumbs->isEmpty())
     <ol class="breadcrumb mb-1">
         @foreach ($breadcrumbs as $breadcrumb)
             @if (!is_null($breadcrumb->url) && !$loop->last)
                 <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
             @else
                 <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
             @endif
         @endforeach
     </ol>
     <h1 class="fw-bold mb-0">{{ $breadcrumb->title }}</h1>
 @endunless
