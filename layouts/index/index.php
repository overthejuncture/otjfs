<?php
/** @var $this \Core\Routing\View */
/** @var string $viewDataKey */

$this->extend('main');
$this->section('mainBody');
?>
<h1>TITLE</h1>
<?php
echo "body<br>";
echo $viewDataKey;
$this->endSection();
