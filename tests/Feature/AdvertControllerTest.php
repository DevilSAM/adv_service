<?php

namespace Tests\Feature;

use App\Models\Advert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class AdvertControllerTest extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Тест получения списка объявлений
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_list_adverts()
    {
        Advert::factory()->count(3)->create();
        $response = $this->get(route('adverts.index'));
        $response->assertStatus(200);
        $response->assertJsonCount(3);

        // Преобразование ответа в массив
        $responseData = $response->json();

        // Проверка каждого элемента на наличие конкретных полей
        foreach ($responseData['data'] as $index => $advert) {
            $this->assertArrayHasKey('title', $advert); // это поле должно быть
            $this->assertArrayHasKey('price', $advert); // это поле должно быть
            $this->assertArrayHasKey('image', $advert); // это поле должно быть

            $this->assertIsString($advert['image']);    // именно image и именно string
            $this->assertNotEmpty($advert['title']);    // доп проверка
            $this->assertIsNumeric($advert['price']);   // доп проверка
        }
    }

    /**
     * Тест получения данных о конкретном объявлении
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_show_an_advert()
    {
        // Arrange: создать одну запись
        $advert = Advert::factory()->create();

        // Act: отправить запрос к методу show
        $response = $this->get(route('adverts.show', $advert->id));

        // Assert: проверить статус и структуру данных
        $response->assertStatus(200);
        $response->assertJson(['id' => $advert->id]);

        // Преобразование ответа в массив
        $responseData = $response->json();

        $this->assertArrayHasKey('title', $responseData); // это поле должно быть
        $this->assertArrayHasKey('price', $responseData); // это поле должно быть
        $this->assertArrayHasKey('images', $responseData); // это поле должно быть
    }

    /**
     * Тест получения данных о конкретном объявлении (с доп полями)
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_show_an_advert_with_fields()
    {
        // Arrange: создать одну запись
        $advert = Advert::factory()->create();

        // Act: отправить запрос к методу show
        $response = $this->getJson(route('adverts.show', [
            'advert' => $advert->id,
            'fields' => ['description', 'images']
        ]));

        // Assert: проверить статус и структуру данных
        $response->assertStatus(200);
        $response->assertJson(['id' => $advert->id]);

        $responseData = $response->json();
        $this->assertArrayHasKey('description', $responseData);
        $this->assertArrayHasKey('images', $responseData);
        $this->assertIsArray($responseData['images']);
        $this->assertNotEmpty($responseData['description']);
    }

    /**
     * Тест сохранения записи в БД
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_an_advert()
    {
        // Arrange: создание данных для новой записи
        $advertData = Advert::factory()->make([
            'title' => 'Unique Title ' . uniqid(),
        ])->toArray();

        // Act: отправить POST-запрос к методу store
        $response = $this->post(route('adverts.store'), $advertData);

        // Assert: проверить статус и структуру данных
        $response->assertStatus(201);

        // Получение из базы данных для проверки
        $storedAdvert = \DB::table('adverts')->where('title', $advertData['title'])->first();

        // Преобразование ожидаемого массива images в строку JSON
        $expectedImagesJson = json_encode($advertData['images']);
        $actualImagesJson = $storedAdvert->images;

        // Проверка данных
        $this->assertEquals($advertData['title'], $storedAdvert->title);
        $this->assertEquals((float) $advertData['price'], (float) $storedAdvert->price);
        $this->assertEquals($advertData['description'], $storedAdvert->description);
        $this->assertJsonStringEqualsJsonString($expectedImagesJson, $actualImagesJson);
    }

    /**
     * Проверка наличия обязательных полей
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_validates_required_fields()
    {
        $invalidData = [
            'title' => '',
            'description' => '',
            'price' => '',
            'images' => null,
        ];
        $response = $this->post(route('adverts.store'), $invalidData);
        // Убедимся, что код ответа 302
        $response->assertStatus(302);
        // Проверка, что сессия содержит ошибки валидации для этих полей
        $response->assertSessionHasErrors(['title', 'description', 'price']);
    }

    /**
     * Проверка на ограничение длины заголовка, описания и количества ссылок на фото
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_validates_fields_size()
    {
        $invalidData = [
            'title' => str_repeat('a', 201), // слишком длинное название
            'description' => str_repeat('a', 1001), // слишком длинное описание
            'price' => 100,
            'images' => [
                'https://via.placeholder.com/640x480.png',
                'https://via.placeholder.com/640x480.png',
                'https://via.placeholder.com/640x480.png',
                'https://via.placeholder.com/640x480.png' // Слишком много изображений
            ]
        ];
        $response = $this->post(route('adverts.store'), $invalidData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'description', 'images']);
    }

    /**
     * Проверка валидации ссылки на фото - валидный URL
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_validates_image_urls()
    {
        $invalidData = [
            'title' => 'Valid Title',
            'description' => 'This is a valid description.',
            'price' => 100,
            'images' => [
                'invalid-url',
                'https://via.placeholder.com/640x480.png'
            ]
        ];
        $response = $this->post(route('adverts.store'), $invalidData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['images.*']);
    }


}
