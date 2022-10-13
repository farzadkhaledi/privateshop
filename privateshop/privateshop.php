<?php
if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use Illuminate\Database\Capsule\Manager as Capsule;

function privateshop_config()
{
    $configarray = array(
        "name" => "Private Shop",
        "description" => "Private Shop module allows you to make WHMCS private store and accessible just after client login.",
        "version" => "1.0.0",
        "author" => "Farzad Khaledi",
        "language" => "english",
        "fields" => array(
            "hidestore" => array("FriendlyName" => "Hide Store Menu", "Type" => "yesno", "Size" => "25", "Description" => "Tick this box to hide store menu while client not logged in.",),
            "disableregistrer" => array("FriendlyName" => "Disable Client Registrations", "Type" => "yesno", "Size" => "25", "Description" => "Tick this box to disable client registrations in client area, you still able to add clients as admin.",),
        )
    );
    return $configarray;
}

function privateshop_activate()
{

    return array("status" => "success", "description" => "Private Shop has been activated.");
}

function privateshop_deactivate()
{
    return array("status" => "success", "description" => "Private Shop has been deactivated, and table(s) has been removed from your database.");
}

function privateshop_output($vars)
{

}
