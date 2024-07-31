<?php

namespace App\Data;

use App\Models\Advert;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[Typescript]
class AdvertDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $title,
        public ?string $image,
        public float $price,
        // доп поля
        public ?array $images,
        public ?string $description,
    )
    {
    }

    public static function fromModel(Advert $advert): self
    {

        return new self(
            id: $advert->id,
            title: $advert->title,
            image: $advert->getFirstImage(),
            price: $advert->price,
            images: $advert->add_images ? $advert->images : null,
            description: $advert->add_description ? $advert->description : null,
        );
    }
}
