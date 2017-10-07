<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 23.09.2017
 * Time: 22:44
 */

namespace App\Http\Controllers\TestDataManager;
use Faker;
use Illuminate\Support\Facades\App;

class FakerShall
{
    private $testDataObject;
    private $propName;
    private $faker;

    public function __construct()
    {
        $this->faker = App::make(Faker\Generator::class)->unique($reset = true);
    }

    public function init(TestDataClass $object, string $prop)
    {
        $this->testDataObject = $object;
        $this->propName = $prop;

        return $this;
    }

    public function __call($name, $arguments)
    {
        $value = self::function($name, $arguments);

        $fakerData = array(
            'action' => 'function',
            'actionName' => $name,
            'arguments' => $arguments
        );

        return $this->setValue($value, $fakerData);

    }

    public function __get($propName)
    {
        $value = self::property($propName);

        $fakerData = array(
            'action' => 'property',
            'actionName' => $propName,
        );

        return $this->setValue($value, $fakerData);

    }

    /**
     * Set value and fakerData array to TestDataClass object
     *
     * @param $value
     * @param array $fakerData
     * @return $this
     */
    private function setValue($value, array $fakerData)
    {
        $this->testDataObject->setFakerData($this->propName, $fakerData);
        return $this->testDataObject->set($this->propName, $value);
    }

    /**
     * Return Faker/Generate value by array fakerData
     * Method used for TestDataClass refresh method.
     *
     * @param $data
     * @return $this
     */
    public function generateByFakerData($data)
    {
        if(isset($data['action'])){
            if(
                $data['action'] == 'function' &&
                !empty($data['actionName']) &&
                isset($data['arguments'])
            ){
                return self::function($data['actionName'], $data['arguments']);
            } elseif (
                $data['action'] == 'property' &&
                !empty($data['actionName'])
            ){
               return self::property($data['actionName']);
            }
        }
       return null;
    }

    /**
     * Call Faker/Generate function
     *
     * @param string $name
     * @param array|null $arguments
     * @return FakerShall
     */
    private function function(string $name, array $arguments = null)
    {
        if(is_array($arguments)){
            $value = call_user_func_array(array($this->faker, $name), $arguments);
        } elseif(empty($arguments)){
            $value = call_user_func(array($this->faker, $name));
        } else {
            $value = null;
        }

        return $value;
    }

    /**
     * Call Faker/Generate property
     *
     * @param string $propName
     * @return FakerShall
     */
    private function property(string $propName)
    {
        return $this->faker->$propName;
    }
}