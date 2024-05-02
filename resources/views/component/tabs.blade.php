<ul {{ $attributes }}>
    @foreach($tabs as $tab)
        <li class="nav-item" role="presentation">
            <button {{ $tab->attributes->class(['nav-link', 'active' => $tab->attributes->get('active', false)])->only('class') }}
                    id="{{ $tab->attributes->get('id') }}-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#{{ $tab->attributes->get('id') }}"
                    type="button"
                    role="tab"
                    aria-controls="{{ $tab->attributes->get('id') }}"
                    aria-selected="true">
                {{ $tab->attributes->get('label', \Illuminate\Support\Str::headline($tab->attributes->get('id'))) }}
            </button>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="{{ $contentId }}">
    @foreach($tabs as $tab)
        <div @class(['tab-pane', 'fade', 'show', 'active' => $tab->attributes->get('active', false)])
             id="{{ $tab->attributes->get('id') }}"
             role="tabpanel"
             aria-labelledby="{{ $tab->attributes->get('id') }}-tab">
            @if($tab->attributes->has('blade'))
                @include($tab->attributes->get('blade'), $tab->attributes->get('params', []))
            @else
                {{ $tab }}
            @endif
        </div>
    @endforeach
</div>
