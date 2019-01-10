<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php echo $this->Html->charset(); ?>
    <meta name="copyright" content="&copy; Hiroki Ito">
    <title><?php echo $title_for_layout; ?></title>
    <?php echo $this->Html->meta('icon');?>
    <?php echo $this->fetch('meta');?>
    <?php echo $this->Html->css('base-style.css'); ?>
    <?php echo $this->fetch('css');?>
    <?php echo $this->fetch('script');?>
  </head>
  <body>
    <div id="container">
      <header>
        <h1><?php echo $this->fetch('title') ?></h1>
      </header>
      <div id="contents">
      	<?php echo $this->fetch('content'); ?>
      </div>
      <div id="footer"></div>
    </div>
  </body>
</html>
