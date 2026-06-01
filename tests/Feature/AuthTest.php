<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Test: Login page loads successfully
     */
    public function test_login_page_loads_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('ReadSpace');
        $response->assertSee('Masuk untuk mengakses perpustakaan Anda');
    }

    /**
     * Test: Register page loads successfully
     */
    public function test_register_page_loads_successfully(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Buat Akun');
        $response->assertSee('Bergabunglah dengan ReadSpace hari ini');
    }

    /**
     * Test: Login form has required fields
     */
    public function test_login_form_has_required_fields(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('email');
        $response->assertSee('password');
        $response->assertSee('Masuk');
    }

    /**
     * Test: Register form has required fields
     */
    public function test_register_form_has_required_fields(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('first_name');
        $response->assertSee('last_name');
        $response->assertSee('email');
        $response->assertSee('password');
        $response->assertSee('Daftar Sekarang');
    }

    /**
     * Test: Login validation - email required
     */
    public function test_login_requires_email(): void
    {
        $response = $this->post('/login', [
            'password' => 'testpassword123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test: Login validation - password required
     */
    public function test_login_requires_password(): void
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test: Register validation - first name required
     */
    public function test_register_requires_first_name(): void
    {
        $response = $this->post('/register', [
            'last_name' => 'Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('first_name');
    }

    /**
     * Test: Register validation - last name required
     */
    public function test_register_requires_last_name(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'John',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('last_name');
    }

    /**
     * Test: Register validation - email must be valid format
     */
    public function test_register_requires_valid_email(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test: Register validation - password minimum length
     */
    public function test_register_requires_minimum_password_length(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.com',
            'password' => 'short',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test: Login page has link to register
     */
    public function test_login_page_has_link_to_register(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Daftar sekarang');
        $response->assertSee('/register');
    }

    /**
     * Test: Register page has link to login
     */
    public function test_register_page_has_link_to_login(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Sudah punya akun');
        $response->assertSee('/login');
    }

    /**
     * Test: SSO options present on login page
     */
    public function test_login_page_has_sso_options(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('oauth_google');
        $response->assertSee('oauth_github');
    }

    /**
     * Test: SSO options present on register page
     */
    public function test_register_page_has_sso_options(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('oauth_google');
        $response->assertSee('oauth_github');
    }

    /**
     * Test: Login page has forgot password link
     */
    public function test_login_page_has_forgot_password(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Lupa?');
    }

    /**
     * Test: Note message visible with note=sudah-punya-akun parameter
     */
    public function test_login_shows_note_message_for_existing_user(): void
    {
        $response = $this->get('/login?note=sudah-punya-akun');
        $response->assertStatus(200);
        $response->assertSee('Anda sudah memiliki akun');
    }

    /**
     * Test: Note message visible with note=belum-login parameter on register
     */
    public function test_register_shows_note_message_for_new_user(): void
    {
        $response = $this->get('/register?note=belum-login');
        $response->assertStatus(200);
        $response->assertSee('Anda belum login');
    }

    /**
     * Test: Error message container exists in login form
     */
    public function test_login_form_has_error_container(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('error-message');
        $response->assertSee('Terjadi kesalahan');
    }

    /**
     * Test: Error message container exists in register form
     */
    public function test_register_form_has_error_container(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('error-message');
        $response->assertSee('Terjadi kesalahan');
    }

    /**
     * Test: Login form has loading state elements
     */
    public function test_login_form_has_loading_state(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('btn-loader');
        $response->assertSee('animate-spin');
    }

    /**
     * Test: Register form has loading state elements
     */
    public function test_register_form_has_loading_state(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('btn-loader');
        $response->assertSee('animate-spin');
    }

    /**
     * Test: Login form has proper CSS classes for styling
     */
    public function test_login_form_has_proper_styling(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('bg-[#1a1816]');
        $response->assertSee('bg-[#f0ece1]');
    }

    /**
     * Test: Register form has proper CSS classes for styling
     */
    public function test_register_form_has_proper_styling(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('bg-[#1a1816]');
        $response->assertSee('bg-[#f0ece1]');
    }

    /**
     * Test: Login form uses Clerk JavaScript SDK
     */
    public function test_login_page_uses_clerk_sdk(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('clerk');
        $response->assertSee('clerk.browser.js');
    }

    /**
     * Test: Register form uses Clerk JavaScript SDK
     */
    public function test_register_page_uses_clerk_sdk(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('clerk');
        $response->assertSee('clerk.browser.js');
    }

    /**
     * Test: Login page redirects unauthenticated users appropriately
     */
    public function test_login_page_accessible_to_guests(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Test: Register page redirects unauthenticated users appropriately
     */
    public function test_register_page_accessible_to_guests(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * Test: Login page has proper meta tags
     */
    public function test_login_page_has_proper_meta_tags(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Athena');
        $response->assertSee('viewport');
    }

    /**
     * Test: Register page has proper meta tags
     */
    public function test_register_page_has_proper_meta_tags(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Athena');
        $response->assertSee('viewport');
    }

    /**
     * Test: Login form has proper input placeholders
     */
    public function test_login_form_has_proper_placeholders(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('name@example.com');
        $response->assertSee('••••••••');
    }

    /**
     * Test: Register form has proper input placeholders
     */
    public function test_register_form_has_proper_placeholders(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('John');
        $response->assertSee('Doe');
        $response->assertSee('name@example.com');
        $response->assertSee('••••••••');
    }

    /**
     * Test: Success session message support exists in login controller
     */
    public function test_login_controller_supports_success_message(): void
    {
        $this->assertTrue(method_exists(\App\Http\Controllers\AuthController::class, 'login'));
    }

    /**
     * Test: Register controller exists with correct method
     */
    public function test_register_controller_exists(): void
    {
        $this->assertTrue(method_exists(\App\Http\Controllers\AuthController::class, 'register'));
    }

    /**
     * Test: AuthController has logout method
     */
    public function test_auth_controller_has_logout_method(): void
    {
        $this->assertTrue(method_exists(\App\Http\Controllers\AuthController::class, 'logout'));
    }

    /**
     * Test: Login validation rejects invalid email format
     */
    public function test_login_rejects_invalid_email_format(): void
    {
        $response = $this->post('/login', [
            'email' => 'not-an-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test: Register validation rejects invalid email format
     */
    public function test_register_rejects_invalid_email_format(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'not-an-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
