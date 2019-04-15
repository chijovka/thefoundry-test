<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use App\Models\Departament;

class DepartamentsSeeder extends Seeder
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
        $files = $filesystem->glob($directory_path . 'department_table.csv');

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

                $departament = new Departament();
                $departament->id = $data[0];
                $departament->name = $data[1];
                $departament->save();
            }
            fclose($handle);
        }
    }
}
