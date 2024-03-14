<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        @if(isset($left)){{ $left }}@endif
        {{ $slot }}
        @if(isset($right)){{ $right }}@endif
    </div>
</nav>
