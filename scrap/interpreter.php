<?php

interface Command {
  public function execute(Context $context);
}

class JobCommand implements Command {
  public function execute(Context $context) {
    if($context->getCurrentCommand() !== 'begin') {
      throw new RuntimeException('illegal command' . $context->getCurrnetCommand());
    }
    $command_list = new CommandListCommand();
    $command_list->execute($context->next());
  }
}

class CommandListCommand implements Command {
  public function execute(Context $context) {
    while (true) {
      $current_command = $context->getCurrentCommand();
      if(is_null($current_command)) {
        throw new RuntimeException('"end" not found');
      } elseif ($current_command === 'end') {
        break;
      } else {
        $command = new CommandCommand();
        $command->execute($context);
      }
      $context->next();
    }
  }
}

class CommandCommand implements Command {
  public function execute(Context $context) {
    $current_command = $context->getCurrentCommand();
    if($current_command = 'diskspace') {
      $path = './';
      $free_size = disk_free_space('./');
      $max_size = disk_total_space('./');
      $ratio = $free_size / $max_size * 100;
      echo sprintf('Disk Free : %5.1dMB (%3d%%)<br>', $free_size / 1024 / 1024, $ratio);
    } elseif ($current_command === 'date') {
      echo date('Y/m/d H:i:s'). '<br>';
    } elseif ($current_commnd === 'line') {
      echo '------------------------<br>';
    } else {
      throw new RuntimeException('invalid command[' . $current_command . ']');
    }
  }
}

class Context {
  private $commands;
  private $current_index = 0;
  private $max_index = 0;

  public function __construct($command) {
    $this->commands = split(' +', trim($command));
    $this->max_index = count($this->commands);
  }

  public function next() {
    $this->current_index++;
    return $this;
  }

  public function getCurrentCommand() {
    if(!array_key_exists($this->current_index, $this->command)) {
      return null;
    }
    return trim($this->commands[$this->current_index]);
  }
}

//clientCode
function execute($command) {
  $job = new JobCommand();
  try {
    $job->execute(new Context($command));
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(), ENT_QUOTES, mb_internal_encoding());
  }
  echo '<hr>';
}

$command = (isset($_POST['commad'])? $_POST['command'] : '');
if ($command !== '') {
  execute($command);
}
?>
<form action="" method="post">
input command:<input type="text" name="command" size="80" value="begin date line deskspace end">
<input type="submit">
</form>
