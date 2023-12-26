<?php

require_once '_header.php';
require_once '_utilities.php';

$file_name = sanitizeFileName($_GET['name']);
$card_content = "";
if ($file_name) {
  $card_content = htmlspecialchars(file_get_contents("cards/$file_name"));
}

?>

<h1 class="my-4">Card Preview</h1>
<pre class="bg-light p-3"><?=!empty($card_content) ? $card_content : "Oops! Something went wrong" ?></pre>

<?php

require_once '_footer.php';
