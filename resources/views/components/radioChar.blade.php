<?php
    foreach($values as $value){

        if($checked == $value){
            $check = 'checked';
        } else {
            $check = '';
        }

        printf('<br><input type="radio" name="%1$s" value="%2$s" %3$s>%2$s', $name, $value, $check);
    }
?>