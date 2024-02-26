<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Quote;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    private function login()
    {
        $user = User::factory()->create();

        $this->post('/user/authenticate', [
            'email' => $user->email,
            'password' => 'password',
        ]);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->login();
    }

    public function testSaveQuote()
    {
        $quote = Quote::factory()->make();

        $response = $this->post('/quote/save', [
            'author' => $quote->author,
            'content' => $quote->content
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('quotes', [
            'author' => $quote->author,
            'content' => $quote->content
        ]);
    }

    public function testSaveQuoteWithoutAuthor()
    {
        $quote = Quote::factory()->make();

        $response = $this->post('/quote/save', [
            'content' => $quote->content
        ]);

        $response->assertStatus(302);
    }

    public function testSaveQuoteWithoutContent()
    {
        $quote = Quote::factory()->make();

        $response = $this->post('/quote/save', [
            'author' => $quote->author,
        ]);

        $response->assertStatus(302);
    }
}
