<?php

namespace Tests\Unit;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
class CustomerInfoStoreTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     */
    public function test_customer_detail_insert(): void
    {
        $routeName = 'customer.store';
        $uri = '/wp-customer-create';
        $this->assertTrue(Route::has($routeName), "The $routeName route is not registered.");

        $itemData = [
            'name' => $this->faker->sentence,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'budget' => $this->faker->randomDigitNotNull,
            'message' => $this->faker->sentence,
        ];

        $response = $this->post($uri, $itemData);

        $this->assertDatabaseHas('customers', $itemData);
    }
}
