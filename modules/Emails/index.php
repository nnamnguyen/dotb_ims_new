<?php



$focus = BeanFactory::newBean('Emails');
if (!$focus->ACLAccess('view')) {
      ACLController::displayNoAccess(true);
      dotb_cleanup(true);
  }
$focus->email2init();
$focus->et->preflightUser($current_user);
$out = $focus->et->displayEmailFrame();
echo $out;
echo "<script>var composePackage = null;</script>";

$skipFooters = true;

