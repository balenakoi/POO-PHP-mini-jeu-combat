<?php
include("template/header.php")
?>

<!-- dont showing the form if after entering a user -->
<?php if (!isset($_GET['view'])) { ?>
 <form class="form" action="index.php?add=true" method="post">

<p>

  Name : <input type="text" name="names" maxlength="50" />

  <input type="submit" value="Create this person" name="create" />

</p>
</form>
<?php 
} ?>


<?php if (isset($_GET['view'])) { ?>
<a  href="index.php">Déconnexion</a>
<p class='paragarphe'>C'EST TOI</p>
<div class="user">
<?php foreach ($lastUser as $user) { ?>
  <p>Name : <?php echo $user->getNames(); ?></p>
  <p>Damages :  <?php echo $user->getDamages(); ?></p>
<?php 
} ?>
</div>
<p class="paragarphe">C'EST LUI</p>
<div class="fighters">
<?php foreach ($users as $user) { ?>
  <div style="border-top: 1px solid black;">
    <p><a href="index.php?id=<?php echo $user->getId(); ?>">Name : <?php echo $user->getNames(); ?></a></p>
    <p>Damages : <?php echo $user->getDamages(); ?></p>
  </div> 
<?php 
} ?>
<?php 
} ?>
</div>
 <?php

include("template/footer.php")
?>
