<?php 


require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";


use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase {

    public $Item;
    

    public function setUp(){
        $this->Item = new Item;
    }

    public function tearDown(){
        unset($this->Item);
    }


    /**
     * @dataProvider provideValidate
     */
    public function testValidate($values,$post,$expected,$message){
        $_POST[$post] = $post;
        $output = $this->Item->validate($values);
        $this->assertEquals(
            $output,
            $expected,
            $message
        );
    }

    public function provideValidate(){
        return [
            ["omschrijving","omschrijving",true,"ik verwacht dat het true wordt"],
            ["omschrijving","omschr",false,"ik verwacht dat het false wordt"],
        ];
    }
}







?>