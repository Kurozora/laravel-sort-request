<p align="center"><img src=".github/logo.png"></p>

<p align="center">
  <sup><em>Sorting logic for your requests, simplified!</em></sup>
</p>

# Laravel Sort Request [![PHP 7.4+](https://img.shields.io/badge/PHP%207.4+-8892bf.svg?style=flat&logo=PHP&logoColor=white)](https://swift.org) [![Laravel](https://img.shields.io/badge/Laravel-white?style=flat&logo=Laravel)](https://laravel.com) [![Packagist](https://img.shields.io/packagist/v/kurozora/laravel-sort-request.svg?label=&style=flat&logo=Packagist&logoColor=white&color=C25934)](https://packagist.org/packages/kurozora/laravel-sort-request) [![License](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](https://github.com/Anarios/return-youtube-dislike/blob/main/LICENSE)

This Laravel package makes it easier to implement sorting logic into your app.  
Consider the following examples:
```bash
# Get the cheapest items
https://example.test/items?sort=price(asc)

# Get the items sorted by name and size
https://example.test/items?sort=name(asc),size(desc)

# Get the most popular TV Shows (custom sorting behavior)
https://example.test/tv-shows?sort=popularity(most-popular)
```

# Installation

You can download a release and manually include it in your project:

| PHP Version   | Sort Request Version  |
| ------------- |-----------------------|
| PHP 7.3       | [Sort Request 1.0](../../releases/tag/1.0.1)             |
| PHP 7.4       | [Sort Request 2.0](../../releases/tag/2.0)               |
| PHP 8.0       | [Sort Request 2.0](../../releases/tag/2.0)               |

Alternatively you can install the package via composer:

```bash
composer require kurozora/laravel-sort-request
```

# Usage
## Basic sorting
Add the `SortsViaRequest` trait to your [Laravel form request](https://laravel.com/docs/6.x/validation#form-request-validation).

```php
use Kurozora\SortRequest\Tests\Support\Requests\FormRequest;
use Kurozora\SortRequest\Traits\SortsViaRequest;

class GetItemsRequest extends FormRequest
{
    use SortsViaRequest;

    /**
     * Get the rules that the request enforces.
     *
     * @return array
     */
    function rules()
    {
        return array_merge([
            // This is where your normal validation rules go
        ], $this->sortingRules());
    }

    /**
     * Returns the columns that can be sorted on.
     *
     * @return array
     */
    function getSortableColumns(): array
    {
        return [
            'id', 'stackSize', 'displayName'
        ];
    }
}
```
As shown above, you will also need to implement the `getSortableColumns` method into your form request. It should return an array of column names that can be sorted on.  
So if you only wanted to allow sorting on the "name" and "price" columns, you would do:  
```php
function getSortableColumns(): array
{
    return ['name', 'price'];
}
```

Next, go to your controller and add the `sortViaRequest` method as follows:

```php
use Illuminate\Routing\Controller;
use Kurozora\SortRequest\Tests\Support\Models\Item;
use Kurozora\SortRequest\Tests\Support\Requests\GetItemsRequest;

class ItemController extends Controller
{
    /**
     * Returns a list of all items as JSON.
     *
     * @param GetItemsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    function get(GetItemsRequest $request)
    {
        $items = Item::sortViaRequest($request)->get();

        // Do something with your models...
    }
}
```

😎 That's all. You can now sort the models with the "sort" parameter.
```bash
# Sort a single column
https://example.test/items?sort=price(asc)

# Sort multiple columns
https://example.test/items?sort=price(asc),name(desc),experience(asc)
```

## Custom sorting
This package also allows you to have custom sorting behavior:
```bash
# Get the worst ranking users
https://example.test/user?sort=ranking(worst)

# Get the most delicious pastries, and sort them by cheapest
https://example.test/pastries?sort=taste(most-delicious),price(cheapest)
```

Please refer the [custom sorting docs](docs/CUSTOM_SORTING.md) for a guide on how to use this.

## Testing

``` bash
composer test
```

# Contributing

Please refer to the **[Contributing guide](CONTRIBUTING.md)** to learn how you can help.

# Credits

Credits go to [kurozora](https://github.com/kurozora) for creating and maintaining the package.  

Special thanks  
- .. to [Spatie](https://github.com/spatie) for their [template](https://github.com/spatie/skeleton-php).
- .. to [all contributors](../../contributors) for contributing to the project.

# Security

If you happen to find a security vulnerability, we would appreciate you letting us know at kurozoraapp@gmail.com and allowing us to respond before disclosing the issue publicly.

# Getting in Touch

If you have any questions or just want to say hi, join the Kurozora [Discord](https://discord.gg/f3QFzGqsah) and drop a message on the #development channel.

# License

Laravel Sort Request is an Open Source project covered by the [MIT](LICENSE).
