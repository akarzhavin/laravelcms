<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 29.08.2017
 * Time: 10:03
 */

namespace App\Http\Models;

use App\Exceptions\SystemExceptions;
use Illuminate\Support\Facades\Validator;

/**
 * Class FeatureValueShell
 *
 * @property string $type
 * @property mixed $value
 *
 * @package App\Http\Models
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 *
 */
class FeatureValueShell
{
    private $model;
    private $type;

    public function __construct($model = null, $type = null)
    {
        $this->init($model, $type);
    }

    public function init($model = null, $type = null)
    {
        $this->model = isset($model) ? $model : new FeatureValue();
        $this->type = isset($type) ? $type : null;
        return $this;
    }
    //Set the value in model
    private function setValue($value)
    {
        $type = $this->getType();
        if(empty($type)){
            throw new SystemExceptions('Type of Feature is undefined');
        }

        $model = $this->getModel();
        switch($type){
            case 'CheckMulti':
                $model->value_string = $value;
                break;
            case 'CheckSingle':
                $model->value_bool = $value;
                break;
            case 'SelectNum':
                $model->value_double = $value;
                break;
            case 'SelectText':
                $model->value_string = $value;
                break;
            default:
                throw new SystemExceptions('Type of Feature is undefined');
        }

        return $this;
    }

    //Get value from model
    private function getValue()
    {
        $model = $this->getModel();
        if(!is_null($model->value_bool)){
            return $model->value_bool;
        }

        if(!is_null($model->value_string)){
            return $model->value_string;
        }

        if(!is_null($model->value_double)){
            return $model->value_double;
        }

        return null;
    }

    //Call model function
    public function __call(string $name , array $arguments)
    {
        $model = $this->getModel();

        switch(count($arguments)){
            case 0:
                $model = $model->$name();
                break;
            case 1:
                $model = $model->$name($arguments[0]);
                break;
            case 2:
                $model = $model->$name
                (
                    $arguments[0], $arguments[1]
                );
                break;
            case 3:
                $model = $model->$name
                (
                    $arguments[0], $arguments[1], $arguments[2]
                );
                break;
            case 4:
                $model = $model->$name
                (
                    $arguments[0], $arguments[1], $arguments[2], $arguments[3]
                );
                break;
            case 5:
                $model = $model->$name
                (
                    $arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4]
                );
                break;
            default:
                continue;
        }

        $this->setModel($model);
        return $this;
    }

    public function __get($name)
    {
        if($name == 'value'){
            return $this->getValue();
        }

        if($name == 'type'){
            return $this->getType();
        }

        return $this->getModel()->$name;
    }

    public function __set($name, $value)
    {
        if($name == 'value'){
            $this->setValue($value);
            return $this;
        }

        if($name == 'type'){
            $this->setType($value);
            return $this;
        }

        $model = $this->getModel();
        $model->$name =$value;
        $this->setModel($model);
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    private function setType($type)
    {
        $this->type = $type;
    }

    private function getType()
    {
        //Get type from class props
        if(!empty($this->type)){
            return $this->type;
        }

        //Get type from model relationship
        $model = $this->getModel();
        if(isset($model->feature)){
            if(isset($model->feature->type)){
                $this->setType($model->feature->type);
                return $model->feature->type;
            }
        }

        //Return null if type is undefined.
        return null;
    }

}