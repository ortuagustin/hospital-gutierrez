<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

abstract class ApplicationSeeder extends Seeder
{
    protected $actions = ['View', 'Create', 'Update', 'Delete'];

    protected $resources = ['Patients', 'Roles', 'Permissions', 'ClinicalRecord'];
}
