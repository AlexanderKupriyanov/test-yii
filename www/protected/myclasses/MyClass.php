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

    static function dump($var) {
        $highlighter = new CTextHighlighter;
        $highlighter->language = 'PHP';
        //echo $highlighter->highlight(print_r($var, true));

        CVarDumper::dump($var,10,true);

        //echo print_r($var, true);

        //echo '<pre>' . $output . '</pre>';
        /*
        echo '<pre>'; print_r($var); echo '</pre>';
        echo "<br>================================</br>";
        echo '<pre>'; var_dump($var); echo '</pre>';
        */
    }


}