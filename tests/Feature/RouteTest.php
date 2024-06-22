<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * Test the home page route.
     *
     * @return void
     */
    public function testHomePageRoute()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test the admin login page route.
     *
     * @return void
     */
    public function testAdminLoginPageRoute()
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }

    /**
     * Test the dashboard route.
     *
     * @return void
     */
    public function testDashboardRoute()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    /**
     * Test the category product route.
     *
     * @return void
     */
    public function testAddCategoryProductRoute()
    {
        $response = $this->get('/add-category-product');
        $response->assertStatus(200);
    }

    /**
     * Test the show cart route.
     *
     * @return void
     */
    public function testShowCartRoute()
    {
        $response = $this->get('/show-cart');
        $response->assertStatus(200);
    }

    // You can add more tests for other routes similarly
}

