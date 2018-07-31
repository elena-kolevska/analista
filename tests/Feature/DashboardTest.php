<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function testDashboardOnline()
    {
//        $url = route('dashboard');
        $response = $this->get('/dashboard');

//        $response->assertViewHas('trackedTerms');
        $response->assertStatus(200);
    }

    public function testHomeRedirectsToDashboard()
    {
        $response = $this->get('/');

        $redirectedTo = route('dashboard');

        $response->assertRedirect($redirectedTo);
    }

}
