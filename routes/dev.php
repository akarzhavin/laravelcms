<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 17.08.2017
 * Time: 14:17
 */

Route::get('/test', function () {

    $testData = App::make('TestDataClass');
    $a = new \App\Http\Models\FeatureValueShell();
    $a->find(35);
    $a->value = '123.123';
    $a->getModel();
    $b = null;
});

Route::post('/test', function (Request $request) {
    return view('welcome', $request->all());
//    return json_encode($request->all());
});

Route::get('/seeder/{class}', function ($class) {
    $exitCode = Artisan::call('db:seed', array('--class' => $class));
    var_dump($exitCode);
});

Route::get('/seeder', function () {
    $exitCode = Artisan::call('db:seed');
    var_dump($exitCode);
});
Route::get('/artisan/{command}/key={key}/value={value}', function ($command, $key, $value) {
    $exitCode = Artisan::call($command, array($key => $value));
    var_dump($exitCode);
});
Route::get('/artisan/{command}/key={key}', function ($command, $key) {
    $exitCode = Artisan::call($command, array($key => true));
    var_dump($exitCode);
});
Route::get('/artisan/{command}', function ($command) {
    $exitCode = Artisan::call($command);
    var_dump($exitCode);
});