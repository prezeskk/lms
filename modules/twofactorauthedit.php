<?php

use PragmaRX\Google2FA\Google2FA;

/*
 * LMS version 1.11-git
 *
 *  (C) Copyright 2001-2019 LMS Developers
 *
 *  Please, see the doc/AUTHORS for more information about authors!
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License Version 2 as
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 *  USA.
 *
 *  $Id$
 */

$userid = Auth::GetCurrentUser();
$userinfo = $LMS->GetUserInfo($userid);

if (!$userinfo || $userinfo['deleted']) {
    $SESSION->redirect('?m=userlist');
}

$layout['pagetitle'] = trans('Authentication Modification: $a', $userinfo['login']);

if (isset($_POST['userinfo'])) {
    $userinfo = $_POST['userinfo'];

    if ($userinfo['twofactorauth'] == 1 && strlen($userinfo['twofactorauthsecretkey']) != 16) {
        $error['twofactorauthsecretkey'] = trans('Incorrect secret key format!');
    }

    if (!$error) {
        if ($userinfo['twofactorauth'] == -1) {
            $userinfo['twofactorauth'] = 1;
            $google2fa = new Google2FA();
            $userinfo['twofactorauthsecretkey'] = $google2fa->generateSecretKey();
        }

        $LMS->SetUserAuthentication($userid, $userinfo['twofactorauth'], $userinfo['twofactorauthsecretkey']);

        $SESSION->redirect('?m=twofactorauthinfo');
    }
}

$SMARTY->assign('error', $error);
$SMARTY->assign('userinfo', $userinfo);

$SMARTY->display('twofactorauth/twofactorauthedit.html');
