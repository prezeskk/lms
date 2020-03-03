<?php

/*
 * LMS version 1.11-git
 *
 *  (C) Copyright 2001-2020 LMS Developers
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

$user_copy_permissions = array(
    0 => array(
        'name' => 'helpdesk-queues',
        'label' => trans("helpdesk queues"),
    ),
    1 => array(
        'name' => 'helpdesk-categories',
        'label' => trans("helpdesk categories"),
    ),
    2 => array(
        'name' => 'documents',
        'label' => trans("documents"),
    ),
    3 => array(
        'name' => 'cash-registries',
        'label' => trans("cash registries"),
    ),
    4 => array(
        'name' => 'promotion-tariffs',
        'label' => trans("promotion tariffs"),
    ),
);

$hook_data = $LMS->executeHook(
    'user_copy_permissions_prepare',
    array(
        'user_copy_permissions' => $user_copy_permissions,
    )
);
$user_copy_permissions = $hook_data['user_copy_permissions'];

$SMARTY->assign('user_copy_permissions', $user_copy_permissions);
