<?
session_start();
session_name("RSMWebShop");
if(!session_is_registered("rsm_user"))
	session_register("rsm_user");
?>