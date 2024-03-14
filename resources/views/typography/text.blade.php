<p {{ $attributes }}>
@isset($type) <{{ $type }}> @endisset
{{ $slot }}
@isset($type) </{{ $type }}> @endisset
</p>
