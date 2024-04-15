<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'publication_id' => Publication::factory(),
            'title' => $this->faker->words(asText: true),
            'content' => $this->generateHtmlContent(),
            'published_at' => $this->faker->dateTime(),
            'created_at' => function (array $attributes) {
                return $this->boundTimestamps($attributes);
            },
            'updated_at' => function (array $attributes) {
                return $this->boundTimestamps($attributes);
            },
        ];
    }

    protected function generateHtmlContent(): string
    {
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $title = $this->faker->realText(50);
        $content = "<h1 class='mb-12'>{$title}</h1>";
        $augmentations = ['normal', 'strong', 'hr', 'em'];

        foreach ($paragraphs as $paragraph) {
            $content .= match ($augmentations[array_rand($augmentations)]) {
                'strong' => "<strong><p>{$paragraph}</p></strong>",
                'em' => "<em><p>{$paragraph}</p></em>",
                'hr' => "<p>{$paragraph}</p> <hr />",
                default => "<p>{$paragraph}</p>",
            };
        }

        return $content;
    }

    protected function boundTimestamps(array $attributes)
    {
        if (is_null($attributes['published_at']) || now()->lt($attributes['published_at'])) {
            return now()->subDay();
        }

        return $attributes['published_at'];
    }
}
