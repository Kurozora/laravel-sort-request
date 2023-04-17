<?php

namespace Kurozora\SortRequest\Tests\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @property int id
 * @property string displayName
 * @property string gameName
 * @property int stackSize
 */
class Item extends Model
{
    use Sushi;

    protected $rows;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->rows = require __DIR__ . '/Data/Items.php';
    }
}
