<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="header" id="header">
    <div class="container">
      <div class="logo">
        <?php  ?>
      </div>
      <nav>
        <div class="primary">
          <?php primary_nav() ?>
        </div>
      </nav>
    </div>
  </header>