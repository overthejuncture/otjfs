<?php
/** @var \Core\Routing\View $this */
$this->extend('outer');
$this->section('body');
$this->yield('mainBody');
$this->yield('mainCheck');

$this->endSection();
