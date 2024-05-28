# StoneHilt Bootstrap
Integration of the Bootstrap CSS library into Laravel components.
The goal is to have each key function in the Bootstrap map to a laravel component that can be easily and consistently integrated into a project.

Everything done in these components can be performed with pure HTML in a blade, however these components allow for the better abstraction of logic without using a series custom blade partials. 

# Usage
## Installation
Include this library:
```bash
~ composer require stonehilt/bootstrap
```

Add the CSS and Javascript in your layout(s):
```html
<x-bootstrap::css />
<x-bootstrap::javascript />
```

Most functionality is automatically injected with from the `StoneHiltBootstrapServiceProvider`, though there is a couple instances where the `ViewServiceProvider` will need to be replaced/edited.
The simple route is to include `StoneHilt\Bootstrap\Providers\ViewServiceProvider::class` in the app config instead of `Illuminate\View\ViewServiceProvider::class` (or extend it if the Illuminate class is already replaced).  

## Customization
All the views that back each component can be published to the app's resource directory for project customization.  
```bash
~ php artisan vendor:publish --tag=bootstrap-views
```

To use local (ie non-cdn) assets, the configuration needs to be published and then updated. The assets themselves will need to be published if using composer based source files.
```bash
~ php artisan vendor:publish --tag=bootstrap-config
~ php artisan vendor:publish --tag=bootstrap-assets
```
Unless there's a security or performance reason, it is not recommended to use local assets and simply use the default settings to include the CDN provided copies.

To change the version of Bootstrap used, the config will need to be published.

# Available Components

| Bootstrap's Component | HTML Tag                          | 
|-----------------------|-----------------------------------|
| Accordion             | x-bootstrap::component.accordion  |
| Alert                 | x-bootstrap::component.alert      |
| Badge                 | x-bootstrap::component.badge      |
| Breadcrumb            | x-bootstrap::component.breadcrumb |
| Button                | x-bootstrap::component.button     |
| Card                  | x-bootstrap::component.card       |
| Carousel              | x-bootstrap::component.carousel   |
| Dropdown              | x-bootstrap::component.dropdown   |
| List Group            | x-bootstrap::component.list-group |
| Nav                   | x-bootstrap::component.nav        |
| Navbar                | x-bootstrap::component.navbar     |
| Progress              | x-bootstrap::component.progress   |
| Tabs                  | x-bootstrap::component.tabs       |


| Form          | HTML Tag                        | 
|---------------|---------------------------------|
| Form          | x-bootstrap::form               |
| Checkbox      | x-bootstrap::form.checkbox      |
| Control       | x-bootstrap::form.control       |
| Control Group | x-bootstrap::form.control-group |
| Radio         | x-bootstrap::form.radio         |
| Select        | x-bootstrap::form.select        |


| Typography | HTML Tag                        | 
|------------|---------------------------------|
| Heading    | x-bootstrap::typography.heading |
| Text       | x-bootstrap::typography.text    |


| General   | HTML Tag               | 
|-----------|------------------------|
| Container | x-bootstrap::container |
| Column    | x-bootstrap::col       |
| Row       | x-bootstrap::row       |
| Image     | x-bootstrap::image     |
| Figure    | x-bootstrap::figure    |
| Table     | x-bootstrap::table     |


| Support    | HTML Tag                 | 
|------------|--------------------------|
| CSS        | x-bootstrap::css         |
| Javascript | x-bootstrap::javascript  |

# Examples
See `tests/Feature/views` for additional examples of usages of the various parameters and layout approaches.

## Bootstrap's Components
### Accordion
https://getbootstrap.com/docs/5.3/components/accordion/
```html
<x-bootstrap::component.accordion id="test" ref="something">
    <x-bootstrap::component.accordion-item header="Accordion Text 1">
        This is the body of block 1
    </x-bootstrap::component.accordion-item>
    <x-bootstrap::component.accordion-item header="Accordion Text 2">
        This is the body of block 2
    </x-bootstrap::component.accordion-item>
</x-bootstrap::component.accordion>
```

### Badge
https://getbootstrap.com/docs/5.3/components/badge/
```html
<div class="btn btn-primary position-relative">
    Example heading
    <x-bootstrap::component.badge type="danger">Danger</x-bootstrap::component.badge>
</div>
<div class="btn btn-primary position-relative">
    Example heading
    <x-bootstrap::component.badge type="secondary">Secondary</x-bootstrap::component.badge>
</div>
<div class="btn btn-primary position-relative">
    Example heading
    <x-bootstrap::component.badge type="danger" position="bottom-start">Bottom Start</x-bootstrap::component.badge>
</div>
<div class="btn btn-primary position-relative">
    Example heading
    <x-bootstrap::component.badge type="danger" position="bottom-end">Bottom End</x-bootstrap::component.badge>
</div>
```

### Breadcrumb
https://getbootstrap.com/docs/5.3/components/breadcrumb/
```html
<x-bootstrap::component.breadcrumb :items="['/' => 'Home', 'engineering.dashboard' => 'Engineering']" current="Bootstrap - Breadcrumb" divider="|"/>
```

### Dropdowns
https://getbootstrap.com/docs/5.3/components/dropdowns/
```html
<x-bootstrap::component.dropdown label="Demo Dropdown 1">
    <x-bootstrap::component.dropdown.item>Item 1</x-bootstrap::component.dropdown.item>
    <x-bootstrap::component.dropdown.item>Item 2</x-bootstrap::component.dropdown.item>
    <x-bootstrap::component.dropdown.divider />
    <x-bootstrap::component.dropdown.item href="#">Item 3</x-bootstrap::component.dropdown.item>
</x-bootstrap::component.dropdown>
```
Usage of slots for the items
```html
<x-bootstrap::component.dropdown label="Demo Dropdown 2">
    <x-slot:items><li><a class="dropdown-item" href="#">Item A</a></x-slot:items>
    <x-slot:items><li><a class="dropdown-item" href="#">Item B</a></x-slot:items>
</x-bootstrap::component.dropdown>
```

### Navs & Tabs
https://getbootstrap.com/docs/5.3/components/navs-tabs/
Simple "nav" based navigation
```html
<x-bootstrap::component.nav>
    <x-bootstrap::component.nav.item>Item 1</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item active="true">Item 2</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item href="#" disabled="true">Item 3</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item href="#">Item 3</x-bootstrap::component.nav.item>
</x-bootstrap::component.nav>
```

Tabs styled navigation
```html
<x-bootstrap::component.nav display="tabs">
    <x-bootstrap::component.nav.item>Item 1</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item active="true">Item 2</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item href="#" disabled="true">Item 3</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item href="#">Item 3</x-bootstrap::component.nav.item>
</x-bootstrap::component.nav>
```

Pills styled navigation
```html
<x-bootstrap::component.nav display="tabs">
    <x-bootstrap::component.nav.item>Item 1</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item active="true">Item 2</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item href="#" disabled="true">Item 3</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item href="#">Item 3</x-bootstrap::component.nav.item>
</x-bootstrap::component.nav>
```

Dropdown as an item
```html
<x-bootstrap::component.nav display="pills" type="ol">
    <x-bootstrap::component.nav.item active="true">Dropdown Alpha</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.dropdown label="Dropdown">
        <x-bootstrap::component.dropdown.item>Drop Item 1</x-bootstrap::component.dropdown.item>
        <x-bootstrap::component.dropdown.item>Drop Item 2</x-bootstrap::component.dropdown.item>
        <x-bootstrap::component.dropdown.divider />
        <x-bootstrap::component.dropdown.item href="#">Drop Item 3</x-bootstrap::component.dropdown.item>
    </x-bootstrap::component.nav.dropdown>
    <x-bootstrap::component.nav.item href="#" disabled="true">Dropdown Delta</x-bootstrap::component.nav.item>
    <x-bootstrap::component.nav.item href="#">Dropdown Gamma</x-bootstrap::component.nav.item>
</x-bootstrap::component.nav>
```

### Progress
https://getbootstrap.com/docs/5.3/components/progress/
```html
<x-bootstrap::component.progress value="25"/>
```


## Form
### Form
Using method and action.
```html
<x-bootstrap::form method="POST" action="/post/2" class="special-form">
    Component Form Controls 2
</x-bootstrap::form>
```
Using named route
```html
<x-bootstrap::form :route="['post.update', ['post' => 1]]" id="the-id">
    Component Form Controls 2
</x-bootstrap::form>
```


## General
### Standard Grid
https://getbootstrap.com/docs/5.3/layout/grid/

```html
<x-bootstrap::row>
    <x-bootstrap::col width="3">
        First Column
    </x-bootstrap::col>
    <x-bootstrap::col width="3">
        Middle Column
    </x-bootstrap::col>
    <x-bootstrap::col width="3">
        Last Column
    </x-bootstrap::col>
</x-bootstrap::row>
```
