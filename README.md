<p align="center"><img src=".github/logo.png" width="400"></p>

<p align="center">
<a href="https://packagist.org/packages/musa11971/laravel-sort-request"><img src="https://img.shields.io/packagist/v/musa11971/laravel-sort-request.svg?style=flat-square" alt="Latest version on packagist"></a>
<a href="https://github.com/musa11971/laravel-sort-request/actions?query=workflow%3Arun-tests+branch%3Amaster"><img src="https://img.shields.io/github/workflow/status/musa11971/laravel-sort-request/run-tests?label=tests" alt="GitHub Tests Action Status"></a>
<a href="https://scrutinizer-ci.com/g/musa11971/laravel-sort-request"><img src="https://img.shields.io/scrutinizer/g/musa11971/laravel-sort-request.svg?style=flat-square" alt="Quality score"></a>
<a href="https://packagist.org/packages/musa11971/laravel-sort-request"><img src="https://img.shields.io/packagist/dt/musa11971/laravel-sort-request.svg?style=flat-square" alt="Total downloads"></a>
</p>

<p align="center">
  <sup><em>because you've got better things to do</em></sup>
</p>

# Sorting logic for your requests, but simplified

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

## Installation

You can install the package via composer:

```bash
composer require musa11971/laravel-sort-request
```

## Usage

Add the `SortsViaRequest` trait to your [Laravel form request](https://laravel.com/docs/6.x/validation#form-request-validation).

```php
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

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mussesemou99@gmail.com instead of using the issue tracker.

## Credits

Credits go to [musa11971](https://github.com/musa11971) for creating and maintaining the package.  

Special thanks  
- .. to [Spatie](https://github.com/spatie) for their [template](https://github.com/spatie/skeleton-php).
- .. to [all contributors](../../contributors) for contributing to the project.

## Support me

I am a full-time software engineering student and work on this package in my free time. If you find the package useful, please consider making a [donation](https://www.paypal.me/musa11971)! Every little bit helps. 💜

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
