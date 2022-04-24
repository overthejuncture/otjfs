<?php
/** @var $this \Core\Routing\View */
/** @var array $data */

use Core\Models\Todo;

$this->extend('main');
$this->section('mainBody');
?>
<h1>TODOS</h1>
<?php
foreach ($data as $todo) {
    /** @var Todo $todo */
    echo "<div>" . $todo['body'] . "</div>";
}
$this->endSection();
$this->push('head_css', "<link rel=\"stylesheet\" href=\"mystyle.css\">");
$this->section('title', 'TODOS');

