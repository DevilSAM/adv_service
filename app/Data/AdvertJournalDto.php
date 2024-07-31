<?php

namespace App\Data;

use App\Models\Advert;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

/**
 * DTO Заявления.
 */
#[TypeScript]
class AdvertJournalDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $title,
        public string $description,
        public ?string $image,
        public float $price,
    )
    {
    }

    public static function fromModel(Advert $advert): self
    {
        return new self(
            id: $advert->id,
            title: $advert->title,
            description: $advert->description,
            image: $advert->images[0] ?? '',
            price: $advert->price,
        );
    }
}
