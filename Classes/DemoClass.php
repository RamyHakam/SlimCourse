<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 5/4/19
 * Time: 3:42 PM
 */

namespace Classes;


class DemoClass
{


    private  $testClass;
public function __construct(UsedClass $class)
{
    $this->testClass=$class;

}


    public  function  Addation($x,$y){

        return $x+$y;

    }

    public  function  devison($x,$y){

        if ($y==0){
            return "devision by zero not allowed";
        }
        return $x/$y;
    }

    public  function   substract($x,$y){
        return $x-$y;
    }

    public  function  multiplay($x,$y){
        return $x*$y;
    }

    public  function  testy(){
        if(!$this->testClass->runMe()){
            return "mock code";
        }
        return "default code";
    }



}