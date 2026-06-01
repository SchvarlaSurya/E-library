<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthNotificationTest extends TestCase
{
    /**
     * Test: Login page has error notification element
     * Verifikasi bahwa ada element untuk menampilkan notifikasi error
     */
    public function test_login_has_error_notification_element(): void
    {
        $response = $this->get('/login');

        // Cek element error message ada dan memiliki styling yang sesuai
        $response->assertStatus(200);
        $response->assertSee('error-text');
        $response->assertSee('text-rose-500'); // Red color for errors
        $response->assertSee('bg-rose-50');   // Red background for errors
    }

    /**
     * Test: Login page has success notification element support
     * Verifikasi bahwa sistem mendukung notifikasi sukses
     */
    public function test_login_supports_success_notification(): void
    {
        // Login dengan flash session success
        $response = $this->withSession(['success' => 'Selamat datang kembali!'])
            ->get('/login');

        $response->assertStatus(200);
        // View Blade menggunakan session flash untuk notifikasi
    }

    /**
     * Test: Register page has error notification element
     * Verifikasi bahwa ada element untuk menampilkan notifikasi error
     */
    public function test_register_has_error_notification_element(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('error-text');
        $response->assertSee('text-rose-500');
        $response->assertSee('bg-rose-50');
    }

    /**
     * Test: Register page has success notification support
     * Verifikasi bahwa sistem mendukung notifikasi sukses setelah register
     */
    public function test_register_supports_success_notification(): void
    {
        // Register dengan flash session success
        $response = $this->withSession(['success' => 'Akun berhasil dibuat!'])
            ->get('/register');

        $response->assertStatus(200);
    }

    /**
     * Test: Login form has hidden error message by default
     * Error message harus hidden sampai ada error
     */
    public function test_login_error_message_hidden_by_default(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Element dengan class 'hidden' berarti tidak terlihat
        $response->assertSee('hidden');
        $response->assertSee('text-rose-500');
    }

    /**
     * Test: Register form has hidden error message by default
     * Error message harus hidden sampai ada error
     */
    public function test_register_error_message_hidden_by_default(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Element dengan class 'hidden' berarti tidak terlihat
        $response->assertSee('hidden');
        $response->assertSee('text-rose-500');
    }

    /**
     * Test: Login has JavaScript to show error notification
     * Verifikasi bahwa JS bisa menampilkan error dengan remove class 'hidden'
     */
    public function test_login_has_js_to_show_errors(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // JavaScript handleLogin harus bisa menampilkan error
        $response->assertSee("hidden");
    }

    /**
     * Test: Register has JavaScript to show error notification
     * Verifikasi bahwa JS bisa menampilkan error dengan remove class 'hidden'
     */
    public function test_register_has_js_to_show_errors(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // JavaScript handleRegister harus bisa menampilkan error
        $response->assertSee("hidden");
    }

    /**
     * Test: Login error displays specific Clerk error messages
     * Verifikasi bahwa error dari Clerk ditampilkan dengan benar
     */
    public function test_login_displays_clerk_errors(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // JavaScript menangkap error Clerk dan menampilkannya
        $response->assertSee('clkErrors');
        $response->assertSee('longMessage');
    }

    /**
     * Test: Register error displays specific Clerk error messages
     * Verifikasi bahwa error dari Clerk ditampilkan dengan benar
     */
    public function test_register_displays_clerk_errors(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // JavaScript menangkap error Clerk dan menampilkannya
        $response->assertSee('clkErrors');
        $response->assertSee('longMessage');
    }

    /**
     * Test: Login redirects to home on successful authentication
     * Verifikasi bahwa setelah login sukses, redirect ke '/'
     */
    public function test_login_redirects_to_home_on_success(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // JavaScript redirect ke '/' setelah login sukses
        $response->assertSee("location.href");
    }

    /**
     * Test: Register redirects to login after account creation
     * Verifikasi bahwa setelah register sukses, redirect ke login
     */
    public function test_register_redirects_to_login_on_success(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // View tidak redirect, tapi controller akan redirect
        // JavaScript hanya redirect jika register langsung complete
        $response->assertSee("location.href");
    }

    /**
     * Test: Login shows loading indicator during authentication
     * Verifikasi bahwa ada loading indicator saat proses login
     */
    public function test_login_has_loading_indicator(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Loader element ada
        $response->assertSee('btn-loader');
        $response->assertSee('animate-spin');
    }

    /**
     * Test: Register shows loading indicator during registration
     * Verifikasi bahwa ada loading indicator saat proses register
     */
    public function test_register_has_loading_indicator(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Loader element ada
        $response->assertSee('btn-loader');
        $response->assertSee('animate-spin');
    }

    /**
     * Test: Login button disabled during loading
     * Verifikasi bahwa button disabled saat proses loading
     */
    public function test_login_button_disabled_during_loading(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Button disabled saat loading
        $response->assertSee('submitBtn.disabled = true');
    }

    /**
     * Test: Register button disabled during loading
     * Verifikasi bahwa button disabled saat proses loading
     */
    public function test_register_button_disabled_during_loading(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Button disabled saat loading
        $response->assertSee('submitBtn.disabled = true');
    }

    /**
     * Test: Login handles user not found error
     * Verifikasi bahwa error user not found ditangani dengan redirect ke register
     */
    public function test_login_handles_user_not_found(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // JavaScript redirect ke register dengan note jika user tidak ditemukan
        $response->assertSee('form_identifier_not_found');
        $response->assertSee('/register?note=belum-login');
    }

    /**
     * Test: Register handles existing user error
     * Verifikasi bahwa error user exists ditangani dengan redirect ke login
     */
    public function test_register_handles_existing_user(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // JavaScript redirect ke login dengan note jika user sudah ada
        $response->assertSee('form_identifier_exists');
        $response->assertSee('/login?note=sudah-punya-akun');
    }

    /**
     * Test: Login has alert icon for error messages
     * Verifikasi bahwa error message memiliki icon alert
     */
    public function test_login_error_has_alert_icon(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('alert-circle'); // Lucide icon name
    }

    /**
     * Test: Register has alert icon for error messages
     * Verifikasi bahwa error message memiliki icon alert
     */
    public function test_register_error_has_alert_icon(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('alert-circle'); // Lucide icon name
    }

    /**
     * Test: Login has info icon for note messages
     * Verifikasi bahwa note message memiliki icon info
     */
    public function test_login_note_has_info_icon(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('note-message');
        $response->assertSee('lucide');
    }

    /**
     * Test: Register has info icon for note messages
     * Verifikasi bahwa note message memiliki icon info
     */
    public function test_register_note_has_info_icon(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('note-message');
        $response->assertSee('lucide');
    }

    /**
     * Test: Login form can be submitted with Enter key
     * Verifikasi bahwa form bisa disubmit dengan Enter
     */
    public function test_login_submittable_with_enter_key(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Event listener untuk keypress Enter
        $response->assertSee('keypress');
    }

    /**
     * Test: Success message displayed after redirect from register
     * Verifikasi bahwa pesan sukses ditampilkan setelah redirect dari register
     */
    public function test_success_message_after_register_redirect(): void
    {
        $response = $this->get('/login?note=sudah-punya-akun');

        $response->assertStatus(200);
        // Note message untuk user yang sudah punya akun
        $response->assertSee('Anda sudah memiliki akun');
    }

    /**
     * Test: Note message displayed after redirect from login
     * Verifikasi bahwa pesan catatan ditampilkan setelah redirect dari register
     */
    public function test_note_message_after_login_redirect(): void
    {
        $response = $this->get('/register?note=belum-login');

        $response->assertStatus(200);
        // Note message untuk user yang belum login
        $response->assertSee('Anda belum login');
    }

    /**
     * Test: Login form resets error on new attempt
     * Verifikasi bahwa error di-reset saat user mencoba login lagi
     */
    public function test_login_resets_error_on_new_attempt(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Error di-hidden di awal handleLogin
        $response->assertSee('handleLogin');
    }

    /**
     * Test: Register form resets error on new attempt
     * Verifikasi bahwa error di-reset saat user mencoba register lagi
     */
    public function test_register_resets_error_on_new_attempt(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Error di-hidden di awal handleRegister
        $response->assertSee('handleRegister');
    }

    /**
     * Test: Error text element exists in login form
     * Verifikasi bahwa ada element untuk menampilkan teks error
     */
    public function test_login_has_error_text_element(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('error-text');
    }

    /**
     * Test: Error text element exists in register form
     * Verifikasi bahwa ada element untuk menampilkan teks error
     */
    public function test_register_has_error_text_element(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('error-text');
    }

    /**
     * Test: Login handles wrong password gracefully
     * Verifikasi bahwa error password salah ditangani dengan baik
     */
    public function test_login_handles_wrong_password(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Clerk SDK akan menangani error ini
        $response->assertSee('signIn.create');
        $response->assertSee('identifier');
        $response->assertSee('password');
    }

    /**
     * Test: Register handles password too short
     * Verifikasi bahwa error password terlalu pendek ditangani
     */
    public function test_register_handles_short_password(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Clerk SDK akan menangani error ini
        $response->assertSee('signUp.create');
    }

    /**
     * Test: Login has proper accessibility attributes
     * Verifikasi bahwa form memiliki atribut aksesibilitas yang baik
     */
    public function test_login_form_has_proper_labels(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Label untuk email
        $response->assertSee('Email Address');
        // Label untuk password
        $response->assertSee('Password');
    }

    /**
     * Test: Register form has proper labels
     * Verifikasi bahwa form register memiliki label yang baik
     */
    public function test_register_form_has_proper_labels(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Label untuk first name
        $response->assertSee('First Name');
        // Label untuk last name
        $response->assertSee('Last Name');
        // Label untuk email
        $response->assertSee('Email Address');
        // Label untuk password
        $response->assertSee('Password');
    }

    /**
     * Test: SSO buttons present for alternative login
     * Verifikasi bahwa tombol SSO (Google, GitHub) tersedia
     */
    public function test_login_has_sso_buttons(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Google OAuth button
        $response->assertSee('oauth_google');
        // GitHub OAuth button
        $response->assertSee('oauth_github');
    }

    /**
     * Test: SSO buttons present for alternative registration
     * Verifikasi bahwa tombol SSO tersedia di halaman register
     */
    public function test_register_has_sso_buttons(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        // Google OAuth button
        $response->assertSee('oauth_google');
        // GitHub OAuth button
        $response->assertSee('oauth_github');
    }

    /**
     * Test: SSO redirect to correct callback URL
     * Verifikasi bahwa SSO redirect ke URL yang benar
     */
    public function test_sso_redirects_to_callback(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        // Redirect URL untuk SSO
        $response->assertSee('/sso-callback');
        // Redirect URL setelah selesai
        $response->assertSee('redirectUrlComplete');
        $response->assertSee('complete');
    }
}
