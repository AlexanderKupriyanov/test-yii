<?php

class MyClass extends CComponent {

    function run(){
        echo 'myclass runned';
        $event = new CEvent($this);
        $this->onRun($event);
    }

    // описываем событие onNewComment
    public function onRun($event) {
        // Непосредственно вызывать событие принято в его описании.
        // Это позволяет использовать данный метод вместо raiseEvent
        // во всём остальном коде.
        $this->raiseEvent('onRun', $event);
    }

}