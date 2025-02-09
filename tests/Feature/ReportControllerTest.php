<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Aspiration;
use Database\Seeders\AspirationSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListAllReports()
    {
        $this->seed();

        $user = User::where('email', 'joseph@gmail.com')->first();

        $response = $this->actingAs($user)->get(route('reports'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboards.reports.report');
        $response->assertViewHas('reports');
    }

    public function testShowReportDetail()
    {
        $this->seed();

        $user = User::where('email', 'joseph@gmail.com')
            ->where('role', 'admin')
            ->first();

        $report = Aspiration::first();

        $response = $this->actingAs($user)->get(route('reports.show', $report->slug));

        $response->assertStatus(200);
        $response->assertViewIs('dashboards.reports.report-detail');
        $response->assertViewHas('report');
    }

    public function testDeleteReport()
    {
        $this->seed();

        $user = User::where('email', 'joseph@gmail.com')
            ->where('role', 'admin')
            ->first();

        $report = Aspiration::first();

        $response = $this->actingAs($user)->delete(route('report.destroy', $report->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('reports'));
    }

    public function testUpdateReport()
    {
        $this->seed();

        $user = User::where('email', 'joseph@gmail.com')
            ->where('role', 'admin')
            ->first();

        $report = Aspiration::first();

        $response = $this->actingAs($user)->put(route('report.update', $report->id), [
            'status' => 'proses',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('reports.show', $report->slug));
    }

    public function testStoreReport()
    {
        $this->seed();

        $user = User::where('email', 'joseph@gmail.com')
            ->where('role', 'admin')
            ->first();

        $response = $this->actingAs($user)->post(
            route('reports.store', ['report' => Aspiration::first()->slug]),
            [
                'subject' => 'Test Subject',
                'response' => 'Test Response',
                'aspiration_id' => Aspiration::first()->id,
                'user_id' => $user->id,
            ]
        );

        $response->assertStatus(302);
        $response->assertRedirect(route('reports.show', Aspiration::first()->slug));
    }
}
