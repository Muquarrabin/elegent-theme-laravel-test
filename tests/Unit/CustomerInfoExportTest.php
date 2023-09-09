<?php

namespace Tests\Unit;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CustomerInfoExportTest extends TestCase
{
    use WithFaker, WithoutMiddleware;
    /**
     * A basic unit test example.
     */
    public function test_customer_detail_export(): void
    {
        $routeName = 'customer.create.wp';
        $uri = '/wp-customer-create';
        $this->assertTrue(Route::has($routeName), "The $routeName route is not registered.");

        $id = [
            'id' => Customer::all()->random(1)->first()->id,
        ];

        $response = $this->post($uri, $id);
        $response->assertStatus(200);

    }
}
