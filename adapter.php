<?php

/**
 * Adapter Design Pattern Example in PHP
 * 
 * The Adapter pattern allows incompatible interfaces to work together.
 * It acts as a bridge between two incompatible interfaces.
 */

// Target interface that the client expects
interface Target {
    public function request();
}

// Adaptee class with an incompatible interface
class Adaptee {
    public function specificRequest() {
        return "Adaptee's specific request: " . date('Y-m-d H:i:s');
    }
}

// Adapter class that implements the Target interface and wraps the Adaptee
class Adapter implements Target {
    private $adaptee;

    public function __construct(Adaptee $adaptee) {
        $this->adaptee = $adaptee;
    }

    public function request() {
        // Adapt the call to the adaptee's method
        return "Adapter: " . $this->adaptee->specificRequest();
    }
}

// Client code that uses the Target interface
function clientCode(Target $target) {
    echo $target->request() . "\n";
}

// Usage example
echo "Using Adapter pattern:\n";
$adaptee = new Adaptee();
$adapter = new Adapter($adaptee);
clientCode($adapter);

?>