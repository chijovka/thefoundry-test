@extends('layouts.blank')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                2. Вывести те департаменты, в которых минимальная зарплата превышает 1000 у.е. В них отразить максимальную зарплату среди всех работников
                                и сумму зарплат всех работников. Сделать выборку без подзапросов.
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div id="table_task_2_1_options">
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_2_1_processing" value="eloquent" id="table_task_2_1_processing_eloquent" checked>
                                        <label class="form-check-label" for="table_task_2_1_processing_eloquent">Eloquent</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_2_1_processing" value="native_sql" id="table_task_2_1_processing_native_sql">
                                        <label class="form-check-label" for="table_task_2_1_processing_native_sql">Native SQL</label>
                                    </div>
                                </div>
                            </div>
                            <table id="table_task_2_1" class="table table-striped table-hover" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>id отдела</th>
                                    <th>Название отдела</th>
                                    <th>Максимальная зарплата</th>
                                    <th>Сумма зарплат</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>id отдела</th>
                                    <th>Название отдела</th>
                                    <th>Максимальная зарплата</th>
                                    <th>Сумма зарплат</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                2*. Переделайте запрос так, чтобы появилась колонка с именем работника, получающего максимальную зарплату в департаменте.
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div id="table_task_2_2_options">
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_2_2_processing" value="eloquent" id="table_task_2_2_processing_eloquent" checked>
                                        <label class="form-check-label" for="table_task_2_2_processing_eloquent">Eloquent</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_2_2_processing" value="native_sql" id="table_task_2_2_processing_native_sql">
                                        <label class="form-check-label" for="table_task_2_2_processing_native_sql">Native SQL</label>
                                    </div>
                                </div>
                            </div>
                            <table id="table_task_2_2" class="table table-striped table-hover" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>id отдела</th>
                                    <th>Название отдела</th>
                                    <th>Самый богатый в отделе</th>
                                    <th>Максимальная зарплата</th>
                                    <th>Сумма зарплат</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>id отдела</th>
                                    <th>Название отдела</th>
                                    <th>Самый богатый в отделе</th>
                                    <th>Максимальная зарплата</th>
                                    <th>Сумма зарплат</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                3. Вывести медиану зарплаты среди всех работников. Не использовать процедуры.
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div id="table_task_3_1_options">
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_3_1_processing" value="eloquent" id="table_task_3_1_processing_eloquent" checked>
                                        <label class="form-check-label" for="table_task_3_1_processing_eloquent">Eloquent</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_3_1_processing" value="native_sql" id="table_task_3_1_processing_native_sql">
                                        <label class="form-check-label" for="table_task_3_1_processing_native_sql">Native SQL</label>
                                    </div>
                                </div>
                            </div>
                            <table id="table_task_3_1" class="table table-striped table-hover" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Медиана</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>Медиана</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                3*. Вывести среднюю зарплату, сумму зарплат и медиану зарплат в каждом департаменте.
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <div id="table_task_3_2_options">
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_3_2_processing" value="eloquent" id="table_task_3_2_processing_eloquent" checked>
                                        <label class="form-check-label" for="table_task_3_2_processing_eloquent">Eloquent</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="table_task_3_2_processing" value="native_sql" id="table_task_3_2_processing_native_sql">
                                        <label class="form-check-label" for="table_task_3_2_processing_native_sql">Native SQL</label>
                                    </div>
                                </div>
                            </div>
                            <table id="table_task_3_2" class="table table-striped table-hover" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>id отдела</th>
                                    <th>Название отдела</th>
                                    <th>Медиана зарплат в отделе</th>
                                    <th>Средняя зарплата</th>
                                    <th>Сумма зарплат</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>id отдела</th>
                                    <th>Название отдела</th>
                                    <th>Медиана зарплат в отделе</th>
                                    <th>Средняя зарплата</th>
                                    <th>Сумма зарплат</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop