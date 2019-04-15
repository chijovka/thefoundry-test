<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use App\Models\Departament;
use App\Models\Employee;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directory_path = database_path('seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR);

        $filesystem = new Filesystem;
        $files = $filesystem->glob($directory_path . 'employee_table.csv');

        if($files) {
            $file = $files[0];
        } else {
            return;
        }

        if (($handle = fopen($file, "r")) !== FALSE) {
            $flag = true;
            while (($data = fgetcsv($handle, 0, ';')) !== FALSE) {
                if($flag) {
                    //пропускаем первую строку
                    $flag = false;
                    continue;
                }

                $employee = new Employee();
                $employee->departament()->associate(Departament::findOrFail($data[1]));
                $employee->full_name = $this->convertToUtf8($data[2]);
                $employee->salary = $data[3];
                $employee->save();
            }
            fclose($handle);
        }
    }

    /**
     * @param $string
     *
     * @return bool|string
     */
    private function convertToUtf8($string) {
        return iconv('windows-1251//IGNORE', 'UTF-8', $string);
    }
}
