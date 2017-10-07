<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 17.08.2017
 * Time: 14:17
 */

Route::get('/test', function () {

    $testData = App::make('TestDataClass');
//    $parentCategory = \App\Http\Models\Category::orderByRaw('RAND()')->first();
//    $testData->set('parentCategory', $parentCategory);
//    $testData->faker('@title')->firstName;
//    $testData->faker('@description')->text;
//    $testData->faker('@meta_keywords')->sentence;
//    $testData->faker('@meta_description')->sentence;
//    $testData->faker('@page_title')->word;
    $testData->refresh();

    return var_dump($testData);
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