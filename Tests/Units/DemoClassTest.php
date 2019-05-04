<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 5/4/19
 * Time: 3:45 PM
 */

class DemoClassTest   extends  \PHPUnit\Framework\TestCase
{

    /**
     * @var \Classes\DemoClass
     */
    private  $testClass;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->testClass=new \Classes\DemoClass();

    }


    public  function testIfAddationRun(){
        $result=$this->testClass->Addation(5,6);
        $this->assertEquals(11,$result);
    }

    public  function  testDevasionByZoro(){
        $result=$this->testClass->devison(5,0);
        $this->assertEquals('devision by zero not allowed',$result);

    }
    public  function  testIfXEqualZero(){

        $result=$this->testClass->devison(0,5);
        $this->assertEquals(0,$result);

    }






}