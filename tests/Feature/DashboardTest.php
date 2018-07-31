<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function testDashboardOnline()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('trackedTerms');
    }

    public function testHomeRedirectsToDashboard()
    {
        $response = $this->get('/');

        $redirectedTo = route('dashboard');

        $response->assertRedirect($redirectedTo);
    }

}
