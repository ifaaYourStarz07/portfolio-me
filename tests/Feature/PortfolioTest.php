<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioTest extends TestCase
{
    /**
     * Test that the portfolio landing page renders with all Midnight Indigo sections.
     */
    public function test_portfolio_page_loads_successfully_and_renders_midnight_indigo_sections(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('I BUILD');
        $response->assertSee('DIGITAL');
        $response->assertSee('EXPERIENCES');
        $response->assertSee('ABOUT ME');
        $response->assertSee('SELECTED WORKS');
        $response->assertSee('TECHNICAL CAPABILITIES');
        $response->assertSee('Perjalanan Belajar');
        $response->assertSee('Mari Terhubung');
        $response->assertSee('[PLACEHOLDER]');
    }

    /**
     * Test that the contact form handles valid submissions and returns success flash message.
     */
    public function test_contact_form_submits_successfully_with_valid_data(): void
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe Tester',
            'email' => 'john.doe@example.com',
            'message' => 'Halo, saya tertarik mendiskusikan peluang proyek web development bersama Anda.',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     * Test that the contact form rejects invalid input and returns validation errors.
     */
    public function test_contact_form_fails_validation_with_invalid_email(): void
    {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'message' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }
}
