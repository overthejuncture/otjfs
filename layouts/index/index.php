<?php
/** @var $this Core\View */
/** @var string $viewDataKey */

$this->extend('main');
$this->section('mainBody');
?>
<h1>TITLE</h1>
<?php
echo "body<br>";
echo $viewDataKey;
$this->endSection();

$this->section('mainCheck');
?>
    <h1>Second Section</h1>
<?php
echo "body of the second section<br/>";
$this->endSection();
