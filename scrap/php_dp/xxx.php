<?php

ini_set('display_errors', "On");

class File {
  private $name;

  public function __construct($name) {
    $this->name = $name;
  }

  public function __getName() {
    return $this->name;
  }

  public function decompress() {
    echo $this->name. 'を展開しました<br>';
  }

  public function compress() {
    echo $this->name. 'を圧縮しました<br>';
  }

  public function create() {
    echo $this->name. 'を作成しました';
  }
}

interface Command {
  public function execute();
}

class TouchCommand implements Command {
  private $file;

  public function __construct(File $file) {
    $this->file = $file;
  }

  public function execute() {
    $this->file->create();
  }
}

class CompressCommand implements Command {
  private $file;

  public function __construct(File $file) {
    $this->file = $file;
  }

  public function execute() {
    $this->file->compress();
  }
}

class CopyCommand implements Command {
  private $file;

  public function __construct(File $file) {
    $this->file = $file;
  }

  public function execute() {
    $file = new File('copy_of'. $this->file->getName());
    $file->create();
  }
}

class Queue {
  private $commands;
  private $current_index;

  public function __construct() {
    $this->commands = array();
    $this->current_index = 0;
  }

  public function addCommand(Command $command) {
    $this->command[] = $command;
  }

  public function run() {
    while(!is_null($commnad = $this->next())) {
      $command->execute();
    }
  }

  private function next() {
    if(count($this->commands) === 0 || count($this->commands) <= $this->current_index) {
      return null;
    } else {
      return $this->commands[$this->current_index++];
    }
  }
}

$queue = new Queue();
$file = new File('Sample.txt');
$queue->addCommand(new TouchCommand($file));
$queue->addCommand(new CompressCommand($file));
$queue->addCommand(new CopyCommand($file));

$queue->run();
