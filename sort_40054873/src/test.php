<?php
echo "Test Script Starting\n";
require('functions.inc.php');
require('inputcheck.php');
use PHPUnit\Framework\TestCase;

final class Test extends TestCase{

    public function testvalid(): void
    {
        $t = "MODULE1,100newlineMODULE2,40newlineMODULE3,80";
        $expect = (array(array("module"=>"MODULE1","marks"=>100),array("module"=>"MODULE3","marks"=>"80"),array("module"=>"MODULE2","marks"=>"40")));
        $answer = getSortedModules($t);
        $this->assertEquals(
            $expect,
            $answer
        );
    }

    public function testwithoverboundary(): void {

        $t="Programming,65newlineWeb Dev,101";
        $expect="number must be between 0-100";
        
        $answer=check($t);
        $this->assertEquals(
            $expect,
            $answer
        );
    }

    public function testwithunderboundary(): void {

        $t="Programming,65newlineWeb Dev,-1";
        $expect="number must be between 0-100";
        
        $answer=check($t);
        $this->assertEquals(
            $expect,
            $answer
        );
    }

    public function testwithinvalidnumber(): void {

    $t="Programming,65newlineWeb Dev,bb";
    $expect="number must be between 0-100";
    
    $answer=check($t);
    $this->assertEquals(
        $expect,
        $answer
    );
}

public function testwithemptymark(): void {

    $t="Programming,65newlineWeb Dev,";
    $expect="One of the module marks is empty";
    
    $answer=check($t);
    $this->assertEquals(
        $expect,
        $answer
    );
}

public function testwithemptymodule(): void {

    $t=",65newlineWeb Dev,66";
    $expect="One of the module names is empty";
    
    $answer=check($t);
    $this->assertEquals(
        $expect,
        $answer
    );
}
    
}