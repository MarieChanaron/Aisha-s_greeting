<?php

require_once '_header.php';
require_once '_utilities.php';

function makeGreetingCard($sender, $recipient, $template) {

  $file_name = "";
  $file_path = "cards/";

  // $message is set to the result of reading the template file
  if (file_exists($template)) {
    $message = file_get_contents($template);
    $file_name = sanitizeFileName("$sender-$recipient.txt");
    $file_path .= $file_name;
  } else {
    return $file_name;
  }

  // Create the card
  $card = fopen($file_path, "w");
  $content = "Dear $recipient,\n\n$message\n\nSincerely,\n$sender";
  fwrite($card, $content);
  fclose($card);

  return $file_name;
}

// After submitting the form (POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sender = $_POST['sender'];
  $recipient = $_POST['recipient'];
  $template = $_POST['template'];
  $file_name = makeGreetingCard($sender, $recipient, $template);
  $file_path = "cards/$file_name";
  if (file_exists($file_path) && 
      strlen(file_get_contents($file_path)) !== 0) {
      # redirect to card.php
      header("Location: /card.php?name=$file_name");
      exit;
  }
}

?>

<h1 class="my-4">Create a Greeting Card</h1>
<form method="post">
    <div class="my-3">
        <label for="sender" class="form-label">Sender Name</label>
        <input type="text" name="sender" class="form-control" required>
    </div>

    <div class="my-3">
        <label for="sender" class="form-label">Recipient Name</label>
        <input type="text" name="recipient" class="form-control" required>
    </div>

    <div class="my-3">
        <label for="template" class="form-label">Template</label>
        <select name="template" class="form-select" required>
            <option value="">Choose a Template</option>
            <option value="birthday.txt">Birthday</option>
            <option value="thank_you.txt">Thank You</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-1">Create Card</button>
</form>

<?php

require_once '_footer.php';
