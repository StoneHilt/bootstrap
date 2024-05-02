{{--
Simple slot based implementation of Tabs navigation mechanism
 @package x-bootstrap::component.tabs
 @var array<string, string> $tabs [TabId => TabContent]
--}}
<x-bootstrap::component.tabs>
    @foreach($tabs as $tabId => $tabContent)
        <x-slot:tabs :active="$loop->first" :id="$tabId">{{ $tabContent }}</x-slot:tabs>
    @endforeach
</x-bootstrap::component.tabs>
