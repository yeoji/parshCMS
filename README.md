# ParshCMS
A partial page management package created for Laravel

## Installation

### Laravel 5

```php
"require": {
	"yeoji/parshCMS": "dev-master"
}
```

In your application's `app/config/app.php` file:

Add this line to the `service providers` array:

	'Yeoji\ParshCMS\Providers\ParshServiceProvider::class'

Run the following command to publish the migrations and public files.

```php artisan vendor:publish --provider="Yeoji\ParshCMS\Providers\ParshServiceProvider"```

## Usage

When you upload a theme template file, make sure it is in blade syntax and contain the following:

`<title>@yield('title')</title>` - For the page's title

`@yield('content')` - For where the content should be rendered

`@include('parshcms::custom.navigation')` - For the navigation bar

There should be no other blade syntax as this should be a static page.

All styles should be in your application's public folder, or on a CDN.

## Custom Navigation

The navigation bar is automatically generated for each page that has been created.

In order to change this, create the file `vendor/yeoji/parshCMS/custom/navigation.blade.php` under your application's `resources/views` directory.

The default navigation is a simple:

```@foreach($pages->all() as $page)
   <li><a href="/{{ $page->key }}">{{$page->title}}</a></li>
   @endforeach```

In your newly created `custom/navigation.blade.php` file, you are free to do whatever you want your navigation bar to be.

For any other custom views, the same steps apply. Just mirror the directories/files in the package's views in order to override the views.

