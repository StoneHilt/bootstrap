<form {{ $attributes }}>
    @if ($spoofMethod()) <input type="hidden" name="_method" value="{{ $method }}" /> @endif
    @if ($includeCsrf()) {{ csrf_field() }} @endif
    {{ $slot }}
</form>
