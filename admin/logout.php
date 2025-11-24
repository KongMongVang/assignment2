<?php
  include('reusable/auth.php');
  session_destroy();
  header('Location: ../index.php');
?>