<?php
//RAPID-1540_2 Second Change
//This comment is for Git Branch Test RAPID-1540->RAPID-1541->RAPID-1542
/* $addAuditLogMessage = array() ; 
$addAuditLogMessage2 = array() ; 
$addAuditLogMessage["FloorPlans"] = array("NEW"=>"NEW VALUE1");
$addAuditLogMessage["FloorPlans1"] = array("NEW"=>"NEW VALUE1");
$addAuditLogMessage["FloorPlans2"] = array("NEW"=>"NEW VALUE1");
$addAuditLogMessage2["FloorPlans"] = array("OLD"=>"OLD VALUE","NEW"=>"NEW VALUE2");
$addAuditLogMessage2["FloorPlans1"] = array("OLD"=>"OLD VALUE");
$addAuditLogMessage2["FloorPlans2"] = array("OLD"=>"OLD VALUE","NEW"=>"NEW VALUE2");


print_r($addAuditLogMessage) ; echo "<br />"; echo "<br />";

print_r($addAuditLogMessage2) ; echo "<br />"; echo "<br />";

$addAuditLogMessage3 = array_merge_recursive($addAuditLogMessage,$addAuditLogMessage2);
print_r($addAuditLogMessage3) ; echo "<br />"; echo "<br />";

$addAuditLogMessage3 = array_merge($addAuditLogMessage,$addAuditLogMessage2);
print_r($addAuditLogMessage3) ; echo "<br />"; echo "<br />";

$addAuditLogMessage3 = array_replace_recursive($addAuditLogMessage,$addAuditLogMessage2);
print_r($addAuditLogMessage3) ; echo "<br />"; echo "<br />";
 */

echo serialize(null);
echo var_export(null);
echo printf("This is a null value %s",null);
