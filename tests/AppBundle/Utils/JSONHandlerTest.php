<?php
namespace AppBundle\Tests\Utils;
use AppBundle\Utils\JSONHandler;

class JSONHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testPrepareJSON()
    {
        $currTime = new \DateTime();

        $data = array(
            0 => array(
                'id'=>1,
                'name'=>'test',
                'date'=> $currTime
            )
        );

        $dataSuccess = array(
            0 => array(
                1,
                'test',
                $currTime->format('Y-m-d H:i')
            )
        );

        $dataTest = JSONHandler::prepareJSON($data);
        $this->assertEquals($dataSuccess, $dataTest);

    }
}