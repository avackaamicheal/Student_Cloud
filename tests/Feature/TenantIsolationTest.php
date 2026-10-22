<?php

namespace Tests\Feature;

use App\Models\ClassLevel;
use App\Models\School;
use App\Models\Section;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TenantIsolationTest extends TestCase
{
    use RefreshDatabase;

    protected School $schoolA;
    protected School $schoolB;

    protected User $adminA;
    protected User $adminB;

    protected User $studentA;
    protected User $studentB;

    protected User $teacherA;
    protected User $teacherB;

    protected function setUp(): void
    {
        parent::setUp();

        // Roles must exist before assignRole() will work
        foreach (['SuperAdmin', 'SchoolAdmin', 'Teacher', 'Student', 'Parent'] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $this->schoolA = School::factory()->create([
            'name' => 'School A',
            'slug' => 'school-a',
        ]);

        $this->schoolB = School::factory()->create([
            'name' => 'School B',
            'slug' => 'school-b',
        ]);

        // --- School A users ---
        $this->adminA = User::factory()->create([
            'name'      => 'Admin A',
            'school_id' => $this->schoolA->id,
        ]);
        $this->adminA->assignRole('SchoolAdmin');

        $classA = ClassLevel::create(['school_id' => $this->schoolA->id, 'name' => 'JSS1']);
        $sectionA = Section::create([
            'school_id'      => $this->schoolA->id,
            'class_level_id' => $classA->id,
            'name'           => 'A',
            'capacity'       => 40,
            'is_active'      => true,
        ]);

        $this->studentA = User::factory()->create([
            'name'      => 'Student A',
            'school_id' => $this->schoolA->id,
        ]);
        $this->studentA->assignRole('Student');
        StudentProfile::create([
            'school_id'        => $this->schoolA->id,
            'user_id'          => $this->studentA->id,
            'admission_number' => 'SCH-A-001',
            'class_level_id'   => $classA->id,
            'section_id'       => $sectionA->id,
            'date_of_birth'    => now()->subYears(12),
            'gender'           => 'Male',
        ]);

        $this->teacherA = User::factory()->create([
            'name'      => 'Teacher A',
            'school_id' => $this->schoolA->id,
        ]);
        $this->teacherA->assignRole('Teacher');
        TeacherProfile::create([
            'user_id'       => $this->teacherA->id,
            'school_id'     => $this->schoolA->id,
            'employee_id'   => 'EMP-A-001',
            'qualification' => 'B.Ed',
            'hire_date'     => now()->subYear(),
            'gender'        => 'Female',
        ]);

        // --- School B users (mirror of A) ---
        $this->adminB = User::factory()->create([
            'name'      => 'Admin B',
            'school_id' => $this->schoolB->id,
        ]);
        $this->adminB->assignRole('SchoolAdmin');

        $classB = ClassLevel::create(['school_id' => $this->schoolB->id, 'name' => 'JSS1']);
        $sectionB = Section::create([
            'school_id'      => $this->schoolB->id,
            'class_level_id' => $classB->id,
            'name'           => 'A',
            'capacity'       => 40,
            'is_active'      => true,
        ]);

        $this->studentB = User::factory()->create([
            'name'      => 'Student B',
            'school_id' => $this->schoolB->id,
        ]);
        $this->studentB->assignRole('Student');
        StudentProfile::create([
            'school_id'        => $this->schoolB->id,
            'user_id'          => $this->studentB->id,
            'admission_number' => 'SCH-B-001',
            'class_level_id'   => $classB->id,
            'section_id'       => $sectionB->id,
            'date_of_birth'    => now()->subYears(12),
            'gender'           => 'Female',
        ]);

        $this->teacherB = User::factory()->create([
            'name'      => 'Teacher B',
            'school_id' => $this->schoolB->id,
        ]);
        $this->teacherB->assignRole('Teacher');
        TeacherProfile::create([
            'user_id'       => $this->teacherB->id,
            'school_id'     => $this->schoolB->id,
            'employee_id'   => 'EMP-B-001',
            'qualification' => 'B.Ed',
            'hire_date'     => now()->subYear(),
            'gender'        => 'Male',
        ]);
    }

    /** @test */
    public function school_admin_only_sees_their_own_schools_students(): void
    {
        $response = $this->actingAs($this->adminA)
            ->get(route('student.index', ['school' => $this->schoolA->slug]));

        $response->assertOk();
        $response->assertSee('Student A');
        $response->assertDontSee('Student B');
    }

    /** @test */
    public function school_admin_only_sees_their_own_schools_teachers(): void
    {
        $response = $this->actingAs($this->adminA)
            ->get(route('teachers.index', ['school' => $this->schoolA->slug]));

        $response->assertOk();
        $response->assertSee('Teacher A');
        $response->assertDontSee('Teacher B');
    }

    /** @test */
    public function school_admin_cannot_open_edit_page_for_another_schools_teacher(): void
    {
        $response = $this->actingAs($this->adminA)
            ->get(route('teachers.edit', [
                'school'  => $this->schoolA->slug,
                'teacher' => $this->teacherB->id,
            ]));

        $response->assertForbidden();
    }

    /** @test */
    public function school_admin_cannot_delete_another_schools_teacher(): void
    {
        $response = $this->actingAs($this->adminA)
            ->delete(route('teachers.destroy', [
                'school'  => $this->schoolA->slug,
                'teacher' => $this->teacherB->id,
            ]));

        $response->assertForbidden();

        $this->assertDatabaseHas('users', [
            'id' => $this->teacherB->id,
        ]);
    }

    /** @test */
    public function school_admin_cannot_delete_another_schools_student(): void
    {
        $response = $this->actingAs($this->adminA)
            ->delete(route('student.destroy', [
                'school'  => $this->schoolA->slug,
                'student' => $this->studentB->id,
            ]));

        $response->assertForbidden();

        $this->assertDatabaseHas('users', [
            'id' => $this->studentB->id,
        ]);
    }

    /** @test */
    public function student_cannot_view_another_students_report_card(): void
    {
        $response = $this->actingAs($this->studentA)
            ->get(route('teacher.reports.single', [
                'school' => $this->schoolA->slug,
                'id'     => $this->studentB->id,
            ]));

        $response->assertForbidden();
    }
}
