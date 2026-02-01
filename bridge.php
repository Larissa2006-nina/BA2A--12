<?php

// ===== Implementor =====
interface MessageSender {
    public function send(string $message);
}

// ===== Concrete Implementors =====
class EmailSender implements MessageSender {
    public function send(string $message) {
        echo "Sending EMAIL: $message\n";
    }
}

class SmsSender implements MessageSender {
    public function send(string $message) {
        echo "Sending SMS: $message\n";
    }
}

// ===== Abstraction =====
abstract class Message {
    protected MessageSender $sender;

    public function __construct(MessageSender $sender) {
        $this->sender = $sender;
    }

    abstract public function send(string $content);
}

// ===== Refined Abstractions =====
class UserMessage extends Message {
    public function send(string $content) {
        $this->sender->send("User Message: $content");
    }
}

class SystemAlertMessage extends Message {
    public function send(string $content) {
        $this->sender->send("System Alert: $content");
    }
}

// ===== Usage =====
$email = new EmailSender();
$sms   = new SmsSender();

$msg1 = new UserMessage($email);
$msg1->send("Welcome aboard!");

$msg2 = new SystemAlertMessage($sms);
$msg2->send("CPU temperature high!");

