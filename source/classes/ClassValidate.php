<?php
namespace Classes;

class ClassValidate{ 

    public function validateFields($par)
    {
        $i=0;
        foreach ($par as $key => $value){
            echo $key. '=>' . $value."<br>";
        }
      
    }
}