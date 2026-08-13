<?php

namespace Database\Seeders;

use App\Models\AcademyClass;
use App\Models\Homework;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        $password = Hash::make('password');

        $teacherCount = 60;
        $parentCount = 300;
        $studentCount = 1000;

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => $password,
            'role' => 'admin',
            'phone' => '0550000000',
            'timezone' => 'Africa/Algiers',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin created.');

        /*
        |--------------------------------------------------------------------------
        | TEACHERS
        |--------------------------------------------------------------------------
        */

        $teachers = collect();

        for ($i = 1; $i <= $teacherCount; $i++) {
            $teachers->push(
                User::create([
                    'name' => fake()->name(),
                    'email' => "teacher{$i}@example.com",
                    'password' => $password,
                    'role' => 'teacher',
                    'phone' => fake()->numerify('0550######'),
                    'timezone' => 'Africa/Algiers',
                    'email_verified_at' => now(),
                ])
            );
        }

        $this->command->info(
            "{$teacherCount} teachers created."
        );

        /*
        |--------------------------------------------------------------------------
        | PARENTS
        |--------------------------------------------------------------------------
        */

        $parents = collect();

        for ($i = 1; $i <= $parentCount; $i++) {
            $parents->push(
                User::create([
                    'name' => fake()->name(),
                    'email' => "parent{$i}@example.com",
                    'password' => $password,
                    'role' => 'parent',
                    'phone' => fake()->numerify('0550######'),
                    'timezone' => 'Africa/Algiers',
                    'email_verified_at' => now(),
                ])
            );
        }

        $this->command->info(
            "{$parentCount} parents created."
        );

        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        |
        | Every student MUST have a user_id according to your migration.
        |
        */

        $students = collect();

        for ($i = 1; $i <= $studentCount; $i++) {

            $name = fake()->name();

            $email = "student{$i}@example.com";

            /*
             * Create the student login account first.
             */
            $studentUser = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'student',
                'phone' => fake()->numerify('0550######'),
                'timezone' => 'Africa/Algiers',
                'email_verified_at' => now(),
            ]);

            /*
             * 80% of students have a parent.
             */
            $parent = fake()->boolean(80)
                ? $parents->random()
                : null;

            /*
             * Create the student profile.
             */
            $student = Student::create([
                'user_id' => $studentUser->id,

                'parent_id' => $parent?->id,

                'name' => $name,

                'email' => $email,

                'phone' => $studentUser->phone,

                'notes' => fake()->optional(0.3)->sentence(),

                'status' => fake()->randomElement([
                    'active',
                    'active',
                    'active',
                    'active',
                    'inactive',
                ]),

                'join_date' => fake()
                    ->dateTimeBetween('-2 years', 'now')
                    ->format('Y-m-d'),
            ]);

            $students->push($student);

            /*
             * Progress output every 100 students.
             */
            if ($i % 100 === 0) {
                $this->command->info(
                    "{$i}/{$studentCount} students created..."
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHER ↔ STUDENT
        |--------------------------------------------------------------------------
        |
        | Each teacher gets between 10 and 30 students.
        |
        */

        $this->command->info(
            'Creating teacher/student relationships...'
        );

        foreach ($teachers as $teacher) {

            $numberOfStudents = rand(10, 30);

            $teacherStudents = $students
                ->random($numberOfStudents);

            foreach ($teacherStudents as $student) {

                DB::table('student_teacher')->insertOrIgnore([
                    'student_id' => $student->id,
                    'teacher_id' => $teacher->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CLASSES
        |--------------------------------------------------------------------------
        */

        $classes = collect();

        $subjects = [
            'Mathematics',
            'English',
            'Physics',
            'Chemistry',
            'Biology',
            'French',
            'History',
            'Geography',
            'Computer Science',
            'Arabic',
        ];

        $this->command->info(
            'Creating academy classes...'
        );

        foreach ($teachers as $teacher) {

            /*
             * Each teacher gets 2-5 classes.
             */
            $numberOfClasses = rand(2, 5);

            /*
             * Get students belonging to this teacher.
             */
            $teacherStudents = Student::whereHas(
                'teachers',
                function ($query) use ($teacher) {
                    $query->where('users.id', $teacher->id);
                }
            )->get();

            for ($i = 0; $i < $numberOfClasses; $i++) {

                $subject = fake()->randomElement($subjects);

                $grade = rand(7, 12);

                $class = AcademyClass::create([
                    'name' => "{$subject} - Grade {$grade}",

                    'description' => fake()->sentence(),

                    'teacher_id' => $teacher->id,

                    'capacity' => rand(15, 30),
                ]);

                $classes->push($class);

                /*
                 * Assign students from this teacher.
                 */
                if ($teacherStudents->count() > 0) {

                    $numberOfClassStudents = min(
                        $teacherStudents->count(),
                        rand(8, 20)
                    );

                    $classStudents = $teacherStudents
                        ->random($numberOfClassStudents);

                    $class->students()->sync(
                        $classStudents->pluck('id')->toArray()
                    );
                }
            }
        }

        $this->command->info(
            $classes->count() . ' classes created.'
        );

        /*
        |--------------------------------------------------------------------------
        | HOMEWORK
        |--------------------------------------------------------------------------
        */

        $homeworks = collect();

        $homeworkTitles = [
            'Weekly Exercises',
            'Chapter Assignment',
            'Practice Problems',
            'Reading Assignment',
            'Homework',
            'Revision Exercises',
            'Final Practice',
            'Class Assignment',
            'Research Project',
            'Weekly Test Preparation',
        ];

        $this->command->info(
            'Creating homework...'
        );

        foreach ($classes as $class) {

            /*
             * Each class gets 3-8 homeworks.
             */
            $numberOfHomeworks = rand(3, 8);

            for ($i = 0; $i < $numberOfHomeworks; $i++) {

                $homework = Homework::create([
                    'academy_class_id' => $class->id,

                    'title' => fake()->randomElement(
                        $homeworkTitles
                    ),

                    'instructions' => fake()->paragraph(),

                    'due_date' => fake()
                        ->dateTimeBetween('-30 days', '+30 days')
                        ->format('Y-m-d'),

                    /*
                     * Fake path only.
                     * The actual file does not exist.
                     */
                    'file_path' => fake()->boolean(35)
                        ? 'homeworks/' . fake()->uuid() . '.pdf'
                        : null,
                ]);

                $homeworks->push($homework);
            }
        }

        $this->command->info(
            $homeworks->count() . ' homeworks created.'
        );

        /*
        |--------------------------------------------------------------------------
        | HOMEWORK SUBMISSIONS
        |--------------------------------------------------------------------------
        |
        | Not every student submits every homework.
        |
        */

        $this->command->info(
            'Creating homework submissions...'
        );

        $submissionCount = 0;

        foreach ($homeworks as $homework) {

            /*
             * Get students in this homework's class.
             */
            $class = $classes->firstWhere(
                'id',
                $homework->academy_class_id
            );

            if (!$class) {
                continue;
            }

            $classStudents = $class->students;

            foreach ($classStudents as $student) {

                /*
                 * 70% chance the student submits.
                 */
                if (!fake()->boolean(70)) {
                    continue;
                }

                /*
                 * Some submissions are late / old,
                 * some are recent.
                 */
                $submittedAt = fake()->dateTimeBetween(
                    '-30 days',
                    'now'
                );

                $status = fake()->randomElement([
                    'submitted',
                    'submitted',
                    'reviewed',
                    'returned',
                ]);

                $grade = null;
                $feedback = null;

                if (
                    $status === 'reviewed' ||
                    $status === 'returned'
                ) {
                    $grade = rand(1, 20);

                    $feedback = fake()->randomElement([
                        'Good work.',
                        'Very good work.',
                        'Excellent work.',
                        'Needs improvement.',
                        'Good understanding of the subject.',
                        'Please review the mistakes.',
                        'Great effort.',
                    ]);
                }

                DB::table('homework_submissions')->insert([
                    'homework_id' => $homework->id,

                    'student_id' => $student->id,

                    'file_path' => 'submissions/'
                        . fake()->uuid()
                        . '.pdf',

                    'submitted_at' => $submittedAt,

                    'status' => $status,

                    'feedback' => $feedback,

                    'grade' => $grade,

                    'created_at' => $submittedAt,

                    'updated_at' => now(),
                ]);

                $submissionCount++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $this->command->newLine();

        $this->command->info(
            '=========================================='
        );

        $this->command->info(
            'DATABASE SEEDED SUCCESSFULLY'
        );

        $this->command->info(
            '=========================================='
        );

        $this->command->info(
            'Admins:       1'
        );

        $this->command->info(
            'Teachers:     ' . $teachers->count()
        );

        $this->command->info(
            'Parents:      ' . $parents->count()
        );

        $this->command->info(
            'Students:     ' . $students->count()
        );

        $this->command->info(
            'Classes:      ' . $classes->count()
        );

        $this->command->info(
            'Homeworks:    ' . $homeworks->count()
        );

        $this->command->info(
            'Submissions:  ' . $submissionCount
        );

        $this->command->info(
            '=========================================='
        );

        $this->command->newLine();

        $this->command->info(
            'All accounts use password: password'
        );

        $this->command->info(
            'Admin: admin@example.com'
        );

        $this->command->info(
            'Teacher: teacher1@example.com'
        );

        $this->command->info(
            'Parent: parent1@example.com'
        );

        $this->command->info(
            'Student: student1@example.com'
        );
    }
}
