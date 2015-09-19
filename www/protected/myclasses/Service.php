<?php

class Service extends CComponent {
    function comment($event){
        echo 'on event runned';
        var_dump($event);
    }
}