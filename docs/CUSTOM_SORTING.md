| **[Back to readme](https://github.com/musa11971/laravel-sort-request/)** |
| ------------- |

# Custom sorting
In this example, we'll create a sorter that sorts the users based on the amount of comments they have.  

## 1. Creating the sorter class
We use the Artisan command to create a sorter class.
```bash
php artisan sort-request:make UserCommentCount
```

This creates the `App/Http/Sorters/UserCommentCountSorter` class.

## 2. Writing the sorter
Open the sorter class. You'll need to set-up two things.

### Sorting directions
You should return the available sorting directions in the `getDirections` method. In this example we'll have two directions: *most* and *least*.
```php
public function getDirections(): array
{
    return ['most', 'least'];
}
```

### Sorting logic
This is the part where you write the actual logic behind your custom sorter. Sorting logic goes in the `apply` method.  

You have access to the following:
- `$request` current request being performed.
- `$builder` the Eloquent query builder that you can use to sort.
- `$direction` the direction currently being sorted on.
  
Consider the following example:
```php
public function apply(Request $request, Builder $builder, $direction): Builder
{
    $builder->withCount('comments');
    
    if($direction == 'most')
        $builder->orderBy('comments_count', 'desc');
    else
        $builder->orderBy('comments_count', 'asc');

    return $builder;
}
```

## 3. Setting up the sorter for use
Your sorter should be ready for use. Your [Laravel form request](https://laravel.com/docs/6.x/validation#form-request-validation) should look something like this:
```php
class GetUsersRequest extends FormRequest
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
            'comment-count' => App\Http\Sorters\UserCommentCountSorter::class
        ];
    }
}
```

.. and make sure to retrieve your models with the package's method in your controller, otherwise the results won't get sorted.
```php
$users = User::sortViaRequest($request)->get();
```

## 🎉 Done
All done! The following behavior is now enabled:
```bash
# Get the users sorted by the most comments
https://example.test/users?sort=comment-count(most)

# Get the users sorted by the least comments
https://example.test/users?sort=comment-count(least)
```

## Additional information
- You can use "normal" column sorting and custom sorters together:
  ```php
  function getSortableColumns(): array
  {
      return [
          'name',
          'comment-count' => App\Http\Sorters\UserCommentCountSorter::class
      ];
  }
  ```
  The above example enables sorting on the custom "comment-count" sorter, and the model's name column.  
  `https://example.test/users?sort=comment-count(least),name(asc)`