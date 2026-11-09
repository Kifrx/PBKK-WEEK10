<?php

namespace Tests\Feature;

use App\Models\Departemen;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademicBackofficeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_seeded_accounts_can_log_in_and_see_database_statistics(): void
    {
        foreach (['admin', 'staf'] as $role) {
            $this->post('/login', ['email' => "{$role}@its.ac.id", 'password' => 'password'])
                ->assertRedirect(route('admin.dashboard'));

            $this->get('/admin/dashboard')->assertOk()
                ->assertSee('Total Mahasiswa')
                ->assertSee('Total Staf Dosen')
                ->assertSee('Total Tugas Aktif');

            $this->post('/logout')->assertRedirect('/');
        }
    }

    public function test_admin_can_create_update_and_delete_academic_records(): void
    {
        $department = Departemen::firstOrFail();
        $lecturer = Dosen::firstOrFail();
        $this->actingAs(User::where('email', 'admin@its.ac.id')->firstOrFail());

        $modules = [
            'departemen' => [Departemen::class, 'kode', ['kode' => 'QA', 'nama' => 'Penjaminan Mutu']],
            'dosen' => [Dosen::class, 'nip', ['nip' => '100001', 'nama' => 'Dosen QA', 'email' => 'dosen.qa@example.test', 'departemen_id' => $department->id]],
            'mahasiswa' => [Mahasiswa::class, 'nrp', ['nrp' => '100002', 'nama' => 'Mahasiswa QA', 'email' => 'mahasiswa.qa@example.test', 'departemen_id' => $department->id, 'is_active' => 1]],
            'tugas' => [Tugas::class, 'judul', ['judul' => 'Tugas QA', 'departemen_id' => $lecturer->departemen_id, 'dosen_id' => $lecturer->id, 'deadline' => '2030-01-01', 'is_active' => 1]],
        ];

        foreach ($modules as $module => [$model, $key, $data]) {
            $base = "/admin/{$module}";
            $this->get("{$base}/create")->assertOk();
            $this->post($base, $data)->assertSessionHasNoErrors()->assertRedirect($base);
            $record = $model::where($key, $data[$key])->firstOrFail();
            $this->get($base)->assertOk()->assertSee('>Hapus</button>', false);
            $this->get("{$base}/{$record->id}/edit")->assertOk();

            $label = $module === 'tugas' ? 'judul' : 'nama';
            $data[$label] .= ' Baru';
            $this->put("{$base}/{$record->id}", $data)->assertSessionHasNoErrors()->assertRedirect($base);
            $this->assertSame($data[$label], $record->refresh()->$label);
            $this->delete("{$base}/{$record->id}")->assertRedirect($base);
            $this->assertModelMissing($record);
        }
    }

    public function test_staf_cannot_delete_and_mahasiswa_cannot_access_backoffice(): void
    {
        $this->actingAs(User::where('email', 'staf@its.ac.id')->firstOrFail());

        foreach (['mahasiswa' => Mahasiswa::class, 'dosen' => Dosen::class, 'tugas' => Tugas::class, 'departemen' => Departemen::class] as $module => $model) {
            $record = $model::firstOrFail();
            $this->get("/admin/{$module}")->assertOk()->assertDontSee('>Hapus</button>', false);
            $this->delete("/admin/{$module}/{$record->id}")->assertForbidden();
            $this->assertModelExists($record);
        }

        $this->actingAs(User::where('email', 'mahasiswa1@mhs.its.ac.id')->firstOrFail())
            ->get('/admin/dashboard')->assertForbidden();
    }

    public function test_keyword_department_and_cuti_filters_are_preserved_in_pagination(): void
    {
        $department = Departemen::firstOrFail();
        Mahasiswa::factory(11)->create(['nama' => 'Cocok QA', 'departemen_id' => $department->id, 'is_active' => false]);
        Mahasiswa::factory()->create(['nama' => 'Cocok QA', 'departemen_id' => $department->id, 'is_active' => true]);
        Mahasiswa::factory()->create(['nama' => 'Cocok QA', 'is_active' => false]);
        $this->actingAs(User::where('email', 'staf@its.ac.id')->firstOrFail());

        $response = $this->get('/admin/mahasiswa?'.http_build_query([
            'q' => 'Cocok QA',
            'departemen_id' => $department->id,
            'is_active' => '0',
        ]))->assertOk();
        $records = $response->viewData('records');

        $this->assertSame(11, $records->total());
        $this->assertCount(10, $records);
        $this->assertStringContainsString('is_active=0', $records->nextPageUrl());
        $this->assertStringContainsString('departemen_id='.$department->id, $records->nextPageUrl());
        $this->assertStringContainsString('q=Cocok%20QA', $records->nextPageUrl());
    }
}
