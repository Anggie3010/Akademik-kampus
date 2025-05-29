<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::updateOrCreate(
            ['email' => 'anggie@gmail.com'],
            [
                'name' => 'Anggie',
                'NIM' => '221220079',
                'major' => 'Sistem Informasi',
                'enrollment_year' => '2022-08-01',
                'password' => Hash::make('1234567890'),
            ]
        );

        Lecturer::updateOrCreate(
            ['email' => 'lecture@gmail.com'],
            [
                'name' => 'Lecture',
                'NIP' => '999999999',
                'departement' => 'Sistem Informasi',
            ]
        );
    }
}
