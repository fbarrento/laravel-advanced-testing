<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property integer $price_eur
 * @method static create(string[] $array)
 * @method static paginate(int $int)
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description'
    ];

    public function priceEur(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => (new CurrencyService())
                ->convert($this->price, 'usd', 'eur')
        );
    }
}
