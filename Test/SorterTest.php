<?php
use PHPUnit\Framework\TestCase;
error_reporting(1);
define( 'ROOT', dirname(dirname(__FILE__)) );
require  ROOT . "\Sorter.php";

class SorterTest extends TestCase {
 
    private $input = array();
    private $sorter;
 
    public function setUp()
    {
        $this->_sorter = new Sorter();
        $this->input = $this->testData();
        // $this->_sorter->setData($this->input);
    }
    
    /**
     * [tearDown description]
     * @return [type] [description]
     */
    public function tearDown()
    {
        $this->_sorter = null;
    }
    

    /**
     * Test exception handling for empty input
     * @expectedException InvalidArgumentException
     * @return [type] [description]
     */
    public function testExceptionThrownForEmptyInput()
    {
        $this->_sorter->setData('');
    }

    /**
     * Test if the input being set is of type array
     * @expectedException InvalidArgumentException
     * @return [type] [description]
     */
    public function testExceptionThrownForInputTypeNotArray()
    {
        $this->_sorter->setData(12);
        // $this->assertInternalType('array', $this->_sorter->setData($this->input));
    }


    /**
     * [testReturnedDataIsArray description]
     * @return [type] [description]
     */
    public function testReturnedDataIsArray()
    {
        $this->_sorter->setData($this->input);
        $this->_sorter->qsort();
        $this->assertInternalType('array', $this->_sorter->getData());
    }


    /**
     * [testReturnedDataIsArray description]
     * @return [type] [description]
     */
    public function testReturnedDataIsNotEmpty()
    {
        $this->_sorter->setData($this->input);
        $this->_sorter->qsort();
        $this->assertNotEmpty($this->_sorter->getData());
    }


    /**
     *  Testing sort function by passing invalid parameters to it, so it throws exception which is expected
     * @expectedException InvalidArgumentException
     * @return [type] [description]
     */
    public function testSortForInvalidArguments()
    {
        $this->_sorter->setData($this->input);
        $this->_sorter->qsort(1,2);
        $this->_sorter->getData();
        $this->expectException();
    }

    /**
     * [testExpectedIternary description]
     * @return [type] [description]
     */
    public function testExpectedIternary()
    {
        $this->_sorter->setData($this->input);
        $this->_sorter->qsort();
        $this->assertEquals($this->mockIternary(), $this->_sorter->getIternary());
    }


    /**
     * @dataProvider
     * @doesNotPerformAssertions
     */
    public function mockIternary()
    {
        return  array(
            "Take train#  from mardrid to barcelona boarding at platform  you will be seated at seat# 122",
            "Take bus#  from barcelona to gerona you will be seated at seat# 3",
            "Take flight#  from gerona to stockholm boarding at gate 45A you will be seated at seat# 12E",
            "Take flight#  from stockholm to newyork boarding at gate 12 you will be seated at seat# 3A",
            "Take flight#  from newyork to singapore boarding at gate 1 you will be seated at seat# 45A",
            "Take flight#  from singapore to qatar boarding at gate 6 you will be seated at seat# 37A",
            "Take train#  from qatar to dubai boarding at platform  you will be seated at seat# 3A",
            "Take flight#  from dubai to mumbai boarding at gate 12 you will be seated at seat# 3A" 
        );

    }


    /**
     * @dataProvider
     * @doesNotPerformAssertions
     */
    public function testData()
    {
        return array(
            [
                'source' => 'mardrid',
                'destination' => 'barcelona',
                'mode_of_transport' => 'train',
                'transport_details' => [
                    'seat_no'   => '122'
                ]
            ],
            [
                'source' => 'gerona',
                'destination' =>  'stockholm',
                'mode_of_transport' => 'flight',
                'transport_details' => [
                    'seat_no' => '12E',
                    'gate' => '45A'
                ]
            ],
            [
                'source' => 'barcelona',
                'destination' => 'gerona',
                'mode_of_transport' => 'bus',
                'transport_details' => [
                    'seat_no' => '3'
                ]

            ],  
            [
                'source' => 'stockholm',
                'destination' => 'newyork',
                'mode_of_transport' => 'flight',
                'transport_details' => [
                    'seat_no' => '3A',
                    'gate' => '12'
                ]
            ],
            [
                'source' => 'dubai',
                'destination' => 'mumbai',
                'mode_of_transport' => 'flight',
                'transport_details' => [
                    'seat_no' => '3A',
                    'gate' => '12'
                ]
            ],
            [
                'source' => 'newyork',
                'destination' => 'singapore',
                'mode_of_transport' => 'flight',
                'transport_details' => [
                    'seat_no' => '45A',
                    'gate' => '1'
                ]
            ],
            [
                'source' => 'singapore',
                'destination' => 'qatar',
                'mode_of_transport' => 'flight',
                'transport_details' => [
                    'seat_no' => '37A',
                    'gate' => '6'
                ]
            ],
            [
                'source' => 'qatar',
                'destination' => 'dubai',
                'mode_of_transport' => 'train',
                'transport_details' => [
                    'seat_no' => '3A'
                ]
            ]
        );
    }
 }