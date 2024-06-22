<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertViewIs('back.admin_login');
    }

    /**
     * Test the show_dashboard method with unauthorized access.
     *
     * @return void
     */
    public function testShowDashboardUnauthorized()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/admin');
    }

    /**
     * Test the show_dashboard method with authorized access.
     *
     * @return void
     */
    public function testShowDashboardAuthorized()
    {
        // Giả lập một admin đã đăng nhập
        Session::put('admin_id', 1);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }



    /**
     * Test the dashboard method with incorrect credentials.
     *
     * @return void
     */
    public function testDashboardWithIncorrectCredentials()
    {
        $response = $this->post('/admin-dashboard', [
            'admin_email' => 'wrong@example.com',
            'admin_password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/admin');
        $this->assertEquals('Nhập lại mật khẩu hoặc email', Session::get('message'));
    }

    /**
     * Test the logout method.
     *
     * @return void
     */
    public function testLogout()
    {
        // Giả lập một admin đã đăng nhập
        Session::put('admin_id', 1);

        $response = $this->get('/logout');

        // Add assertions related to the logout functionality once implemented
        // For example:
        // $response->assertRedirect('/admin');
        // $this->assertNull(Session::get('admin_id'));
    }
}

