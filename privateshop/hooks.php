<?php
if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use Illuminate\Database\Capsule\Manager as Capsule;
use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar) {
    if (isset($_SESSION['uid']) || isset($_SESSION['adminid'])) {
        return;
    }
    $disabled = Capsule::table('tbladdonmodules')->where('module', 'privateshop')->where('setting', 'hidestore')->value('value');
    if ($disabled) {
        $navItem = $primaryNavbar->getChild('Store');
        if (is_null($navItem)) {
            return;
        }
        $primaryNavbar->removeChild('Store');
    }
});

add_hook('ClientAreaSecondaryNavbar', 1, function (MenuItem $secondarySidebar) {
    if (isset($_SESSION['uid']) || isset($_SESSION['adminid'])) {
        return;
    }
    $disabled = Capsule::table('tbladdonmodules')->where('module', 'privateshop')->where('setting', 'disableregistrer')->value('value');
    if ($disabled) {
        if (!is_null($secondarySidebar->getChild('Account'))) {
            $secondarySidebar->getChild('Account')->removeChild('Register');
        }
    }
});

add_hook('ClientAreaPageCart', 1, function ($vars) {
    if (isset($_SESSION['uid']) || isset($_SESSION['adminid'])) {
        return;
    }
    redirSystemURL('', 'clientarea.php');
    exit;
});

add_hook('ClientDetailsValidation', 1, function ($vars) {
    if (isset($_SESSION['uid']) || isset($_SESSION['adminid'])) {
        return;
    }
    $disabled = Capsule::table('tbladdonmodules')->where('module', 'privateshop')->where('setting', 'disableregistrer')->value('value');
    if ($disabled) {
        $lang = \Lang::getName();
        global $CONFIG;
        if (file_exists(ROOTDIR . "/modules/addons/privateshop/lang/" . $lang . ".php")) {
            include(ROOTDIR . "/modules/addons/privateshop/lang/" . $lang . ".php");
        } elseif (file_exists(ROOTDIR . "/modules/addons/privateshop/lang/" . $CONFIG['Language'] . ".php")) {
            include(ROOTDIR . "/modules/addons/privateshop/lang/" . $CONFIG['Language'] . ".php");
        } elseif (file_exists(ROOTDIR . "/modules/addons/privateshop/lang/english.php")) {
            include(ROOTDIR . "/modules/addons/privateshop/lang/english.php");
        }

        return [
            $_ADDONLANG['registerdisabled'],
        ];
    }
});
