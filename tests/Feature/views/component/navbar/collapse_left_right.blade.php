{{--
Navbar with explicit left & right components and dropdown between them
 @package x-bootstrap::form.control
 @subpackage x-slot:left
 @subpackage x-slot:right
 @subpackage x-bootstrap::component.navbar.brand
 @subpackage x-bootstrap::component.navbar.toggler
 @subpackage x-bootstrap::component.navbar.collapse
--}}
<x-bootstrap::component.navbar title="Demo Card" type="primary">
    <x-slot:left>
        <x-bootstrap::component.navbar.brand>StoneHilt</x-bootstrap::component.navbar.brand>
    </x-slot:left>

    <x-slot:right>
        <x-bootstrap::component.navbar.toggler target="testCollapse"/>
    </x-slot:right>

    <x-bootstrap::component.navbar.collapse id="testCollapse">
        The Collapse
        <x-slot:links href="#">Link 1</x-slot:links>
        <x-slot:links href="#">Link 2</x-slot:links>
        <x-slot:links class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </x-slot:links>
    </x-bootstrap::component.navbar.collapse>
</x-bootstrap::component.navbar>