@if($attributes->has('href'))
    <a {{ $attributes->class(['navbar-brand']) }}>@if(isset($image)){{ $image }}@endif{{ $slot }}</a>
@else
    <span {{ $attributes->class(['navbar-brand mb-0 h1']) }}>@if(isset($image)){{ $image }}@endif{{ $slot }}</span>
@endif
