<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 24.09.2017
 * Time: 11:32
 */

namespace App\Http\Controllers\TestDataManager;


interface TestDataInterface
{
    /**
     * Set new property
     * @param string $name
     * @param $value
     * @return mixed
     */
    public function set(string $name, $value);

    /**
     * Get name property
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

    /**
     * Get name property and return FakerShall
     * @param string $name
     * @return mixed
     */
    public function faker(string $name);

    /**
     * Return array all data
     * @return array
     */
    public function all();

    /**
     * Reset all data
     * @return TestDataClass
     */
    public function fresh();

    /**
     * Update data, which wrote by use Faker
     * @return TestDataClass
     */
    public function refresh();
}