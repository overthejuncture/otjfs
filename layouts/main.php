<?php
/** @var \Core\View $this */
$this->extend('outer');
$this->section('checkOuter');
echo '<div>before mainBody</div>';
$this->yield('mainBody');
echo '<div>after mainBody</div>';
$this->yield('mainCheck');

$this->endSection();
