<?php

namespace App\Services\Tasks;

use Yajra\Datatables\Datatables;
use App\Models\Departament;
use App\Models\Employee;

class TasksService
{

    /**
     * @return mixed
     */
    public function getDataTask2_1($type_processing)
    {
        if($type_processing == 'eloquent') {
            $data = $this->getDataTask2_1_eloquent();
        } else {
            $data = $this->getDataTask2_1_native();
        }

        return Datatables::of($data)
            ->make(true);
    }

    /**
     * @return mixed
     */
    private function getDataTask2_1_eloquent()
    {
        $query = Departament::join('employees', 'employees.dep_id', '=', 'departaments.id')
            ->groupBy('departaments.id')
            ->havingRaw('MIN(employees.salary) > 1000')
            ->select([
                'departaments.id as dep_id',
                'departaments.name as dep_name',
                \DB::raw('MAX(employees.salary) as max_salary'),
                \DB::raw('SUM(employees.salary) as sum_salary')
            ]);

        return $query;
    }

    /**
     * @return mixed
     */
    private function getDataTask2_1_native()
    {
        $rows = \DB::select('
            SELECT d.id as dep_id,
                   d.name as dep_name,
                   MAX(e.salary) AS max_salary,
                   SUM(e.salary) AS sum_salary
            FROM departaments d
            JOIN employees e ON e.dep_id = d.id
            GROUP BY d.id
            HAVING MIN(e.salary) > 1000'
        );

        return $rows;
    }

    /**
     * @return mixed
     */
    public function getDataTask2_2($type_processing)
    {
        if($type_processing == 'eloquent') {
            $data = $this->getDataTask2_2_eloquent();
        } else {
            $data = $this->getDataTask2_2_native();
        }

        return Datatables::of($data)
            ->make(true);
    }

    /**
     * @return mixed
     */
    private function getDataTask2_2_eloquent()
    {
        $sub_query = Employee::where('dep_id', '=', \DB::raw('departaments.id'))
            ->orderBy('salary', 'desc')
            ->limit(1)
            ->select('id');

        $query = Departament::join('employees', 'employees.dep_id', '=', 'departaments.id')
            ->join('employees as e2', 'employees.dep_id', '=', 'departaments.id')
            ->where('e2.id', '=', \DB::raw('(' . getFullSql($sub_query) . ')'))
            ->groupBy(['departaments.id', 'e2.full_name'])
            ->havingRaw('MIN(employees.salary) > 1000')
            ->select([
                'departaments.id as dep_id',
                'departaments.name as dep_name',
                'e2.full_name as rich_employee',
                \DB::raw('MAX(employees.salary) as max_salary'),
                \DB::raw('SUM(employees.salary) as sum_salary')
            ]);

        return $query;
    }

    /**
     * @return mixed
     */
    private function getDataTask2_2_native()
    {
        $rows = \DB::select('
            SELECT d.id AS dep_id,
                   d.name AS dep_name,
                   e2.full_name AS rich_employee,
                   MAX(e.salary) AS max_salary,
                   SUM(e.salary) AS sum_salary
            FROM departaments d
            JOIN employees e ON e.dep_id = d.id
            JOIN employees e2 ON e2.dep_id = d.id
            WHERE e2.id =
                (SELECT id
                 FROM employees
                 WHERE dep_id = d.id
                 ORDER BY salary DESC
                 LIMIT 1)
            GROUP BY d.id,
                     e2.full_name
            HAVING MIN(e.salary) > 1000'
        );

        return $rows;
    }

    /**
     * @return mixed
     */
    public function getDataTask3_1($type_processing)
    {
        if($type_processing == 'eloquent') {
            $data = $this->getDataTask3_1_eloquent();
        } else {
            $data = $this->getDataTask3_1_native();
        }

        return Datatables::of($data)
            ->make(true);
    }

    /**
     * @return mixed
     */
    private function getDataTask3_1_eloquent()
    {
        $sub_query = Employee::crossJoin(\DB::raw('(SELECT @rownum:=0) r'))
            ->whereNotNull('employees.salary')
            ->orderBy('employees.salary')
            ->select([
                'employees.salary',
                \DB::raw('@rownum:=@rownum+1 as row_number'),
                \DB::raw('@total_rows:=@rownum')
            ]);

        $query = \DB::table(\DB::raw('(' . getFullSql($sub_query) . ') as e'))
            ->whereIn('e.row_number', [\DB::raw('FLOOR((@total_rows+1)/2)'), \DB::raw('FLOOR((@total_rows+2)/2)')])
            ->select(\DB::raw('AVG(e.salary) as median'));

        return $query;
    }

    /**
     * @return mixed
     */
    private function getDataTask3_1_native()
    {
        $rows = \DB::select('
            SELECT AVG(ee.salary) as median
            FROM (
            SELECT e.salary, @rownum:=@rownum+1 as \'row_number\', @total_rows:=@rownum
              FROM employees e, (SELECT @rownum:=0) r
              WHERE e.salary is NOT NULL
              ORDER BY e.salary
            ) as ee
            WHERE ee.row_number IN (FLOOR((@total_rows+1)/2), FLOOR((@total_rows+2)/2))'
        );

        return $rows;
    }

    /**
     * @return mixed
     */
    public function getDataTask3_2($type_processing)
    {
        if($type_processing == 'eloquent') {
            $data = $this->getDataTask3_2_eloquent();
        } else {
            $data = $this->getDataTask3_2_native();
        }

        return Datatables::of($data)
            ->make(true);
    }

    /**
     * @return mixed
     */
    private function getDataTask3_2_eloquent()
    {
        $sub_query = Employee::whereNotNull('employees.salary')
            ->orderBy('employees.dep_id')
            ->orderBy('employees.salary');

        $sub_query2 = \DB::table(\DB::raw('(' . getFullSql($sub_query) . ') as e'))
            ->crossJoin(\DB::raw('(SELECT @i:=0, @n:=0) AS z'))
            ->select([
                \DB::raw('IF(e.dep_id<>@n, @i:=1, @i := @i+1) AS row_num'),
                \DB::raw('@n:=e.dep_id AS tmp_dep_id'),
                \DB::raw('e.*'),
            ]);

        $sub_query3 = Employee::where('dep_id', '=', \DB::raw('e_num.dep_id'))
            ->select(\DB::raw('COUNT(salary)'));

        $sub_query4 = \DB::table(\DB::raw('(' . getFullSql($sub_query2) . ') as e_num'))
            ->whereIn('e_num.row_num', [\DB::raw('FLOOR((('.getFullSql($sub_query3).')+1)/2)'), \DB::raw('FLOOR((('.getFullSql($sub_query3).')+2)/2)')])
            ->groupBy('e_num.dep_id')
            ->select([
                'e_num.dep_id',
                \DB::raw('AVG(e_num.salary) AS median_salary')
            ]);

        $query = \DB::table(\DB::raw('(' . getFullSql($sub_query4) . ') as e_median'))
            ->join('departaments', 'departaments.id', '=', 'e_median.dep_id')
            ->join('employees', 'employees.dep_id', '=', 'departaments.id')
            ->groupBy('departaments.id', 'departaments.name')
            ->select([
                'departaments.id as dep_id',
                'departaments.name as dep_name',
                'e_median.median_salary',
                \DB::raw('AVG(employees.salary) as avg_salary'),
                \DB::raw('SUM(employees.salary) as sum_salary')
            ]);

        return $query;
    }

    /**
     * @return mixed
     */
    private function getDataTask3_2_native()
    {
        $rows = \DB::select('
            SELECT d.id as dep_id,
                   d.name as dep_name,
                   e_median.median_val as median_salary,
                   AVG(e.salary) as avg_salary,
                   SUM(e.salary) as sum_salary
            FROM
              (SELECT e_num.dep_id,
                      AVG(e_num.salary) AS median_val
               FROM
                 (SELECT IF(e.dep_id<>@n, @i:=1, @i := @i+1) AS row_num, @n:=e.dep_id AS tmp_dep_id, e.*
                  FROM
                    (SELECT *
                     FROM employees
                     WHERE salary IS NOT NULL
                     ORDER BY dep_id, salary) e 
                    CROSS JOIN
                    (SELECT @i:=0,@n:=0) AS z) AS e_num
               WHERE e_num.row_num IN (FLOOR((
                                                (SELECT COUNT(salary)
                                                 FROM employees
                                                 WHERE dep_id = e_num.dep_id)+1)/2),
                                       FLOOR((
                                                (SELECT COUNT(salary)
                                                 FROM employees
                                                 WHERE dep_id = e_num.dep_id)+2)/2))
               GROUP BY e_num.dep_id) e_median
            JOIN departaments d ON d.id = e_median.dep_id
            JOIN employees e ON e.dep_id = d.id
            GROUP BY d.id,
                     d.name'
        );

        return $rows;
    }

}