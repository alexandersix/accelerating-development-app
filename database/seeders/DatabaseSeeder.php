<?php

namespace Database\Seeders;

use App\Models\Publication;
use Database\Factories\ArticleFactory;
use Database\Factories\PublicationFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Admin User */
        UserFactory::new()
            ->asAdmin()
            ->has(
                PublicationFactory::new()
                    ->has(
                        ArticleFactory::new()
                            ->count(10)
                            ->sequence(
                                ...$this->publishedAtTimestamps()
                            )
                    )
                    ->has(
                        /* Subscriber Users */
                        UserFactory::new()
                            ->asSubscriber()
                            ->count(15),
                        'subscribers'
                    )
                    ->count(3)
            )
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);

        /* Subscriber User */
        $subscriber = UserFactory::new()
            ->asSubscriber()
            ->create([
                'name' => 'Subscriber User',
                'email' => 'subscriber@example.com',
            ]);

        $subscriber->subscriptions()->sync(Publication::first()->id);
    }

    protected function publishedAtTimestamps(): array
    {
        return [
            ['published_at' => now()->subDays(80)],
            ['published_at' => now()->subDays(70)],
            ['published_at' => now()->subDays(60)],
            ['published_at' => now()->subDays(50)],
            ['published_at' => now()->subDays(40)],
            ['published_at' => now()->subDays(30)],
            ['published_at' => now()->subDays(20)],
            ['published_at' => now()->subDays(10)],
            ['published_at' => now()->addDays(10)],
            ['published_at' => null],
        ];
    }
}
