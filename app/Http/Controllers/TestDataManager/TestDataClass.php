<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 23.09.2017
 * Time: 19:52
 */

namespace App\Http\Controllers\TestDataManager;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class TestDataClass implements TestDataInterface
{
    private $data;
    private $fakerShall;

    /**
     * TestDataClass constructor.
     */
    public function __construct()
    {
        $cache = $this->cacheGet();
        if(!empty($cache)){
            foreach(get_object_vars($this) as $name => $val){
                $this->$name = $cache->$name;
            }
        }

        $this->fakerShall = new FakerShall();
    }

    /**
     * Set new property
     * @param string $name
     * @param $value
     * @return mixed
     */
    public function set(string $name, $value)
    {
        $this->data[$name]['value'] = $value;
        $this->cacheUpdate();
        return $this;
    }

    /**
     * Get name property
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        if(isset($this->data[$name]['value'])){
            return $this->data[$name]['value'];
        } else {
            return null;
        }
    }

    /**
     * Get name property and return FakerShall
     * @param string $name
     * @return mixed
     */
    public function faker(string $name)
    {
        return $this->fakerShall->init($this, $name);
    }

    /**
     * Return array all data
     * @return array
     */
    public function all()
    {
        $return = array();

        if(is_array($this->data))
            foreach($this->data as $name => $data){
                if(isset($data['value']))
                    $return[$name] = $data['value'];
            }

        return $return;
    }

    /**
     * Reset all data
     * @return TestDataClass
     */
    public function fresh()
    {
        $this->data = array();
        $this->fakerShall = null;
        $this->cacheUpdate();
        return $this;
    }

    /**
     * Update data, which wrote by use Faker
     * @return TestDataClass
     */
    public function refresh()
    {
        if(is_array($this->data)){
            foreach($this->data as $name => $item){
                if(isset($item['fakerData'])){
                    $newValue = $this->fakerShall->generateByFakerData($item['fakerData']);
                    $this->set($name, $newValue);
                }
            }
        }
        $this->cacheUpdate();
        return $this;
    }

    /**
     * This method need from FakerShall class.
     * He save Faker data, which be usage for refresh method
     * @param string $name
     * @param array $data
     */
    public function setFakerData(string $name, array $data)
    {
        $this->data[$name]['fakerData'] = $data;
    }

    /**
     * Reset old and new store data to cache
     */
    private function cacheUpdate()
    {
        Cache::store('file')->forget('TestDataClass');

        $expiresAt = Carbon::now()->addMinutes(5);
        Cache::store('file')->put('TestDataClass', $this, $expiresAt);
    }

    /**
     * Get stored data from cache
     * @return TestDataClass
     */
    private function cacheGet()
    {
        return Cache::store('file')->get('TestDataClass');
    }
}