<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\AdvertType
 *
 * @property int $id
 * @property string $title Первичный ключ из старой рекламы
 * @property string $description Отображаемое значение
 * @property array $images Активность параметра
 * @property float $price Отдельно стоящая конструкция
 * @method static \Database\Factories\AdvertFactory factory($count = null, $state = [])
 * @method static Builder|Advert filter(array $input = [], $filter = null)
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Advert extends Model
{
    use Filterable, HasFactory;

    protected $casts = [
        'images' => 'array',
    ];

    protected $guarded = [
        'id'
    ];

    public function getFirstImage()
    {
        $images = json_decode($this->attributes['images'], true);
        return $images[0] ?? null;
    }
//    public function getAdditionalFields(): array
//    {
//        return [
//            'images' => $this->images,
//            'description' => $this->description,
//        ];
//    }

}
