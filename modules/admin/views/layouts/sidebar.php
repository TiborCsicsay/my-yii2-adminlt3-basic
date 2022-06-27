<?php

use app\modules\usermanagement\models\User;

?>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'th', 'url' => ['/admin/default/index']],
                    ['label' => 'Order', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Product', 'icon' => 'th'],
                    ['label' => 'Other','header' => true],
                    [
                        'label' => Yii::t('back', 'User manager'),
                        'icon' => 'user-shield',
                        'items' => [
                            ['icon' => 'users', 'label' => Yii::t('back', 'Users'), 'url' => ['/user-management/user/index']],
                            ['icon' => 'traffic-light', 'label' => Yii::t('back', 'Roles'), 'url' => ['/user-management/role/index']],
                            ['icon' => 'map-signs', 'label' => Yii::t('back', 'Permission groups'), 'url' => ['/user-management/auth-item-group/index']],
                            ['icon' => 'cogs', 'label' => Yii::t('back', 'Permissions'), 'url' => ['/user-management/permission/index']],
                            ['icon' => 'list', 'label' => Yii::t('back', 'Visit log'), 'url' => ['/user-management/user-visit-log/index']],
                        ],
                        'visible' => \Yii::$app->user->isSuperAdmin
                    ],
                    [
                        'label' => Yii::t('back', 'Language manager'),
                        'icon' => 'language',
                        'items' => [
                            ['icon' => 'list','label' => Yii::t('back', 'Language list'), 'url' => ['/translatemanager/language/list']],
                            ['icon' => 'edit', 'label' => Yii::t('back', 'Translate language'), 'url' => ['/translatemanager/language/translate']]
                        ],
                    ],
                    ['label' => 'Yii2 PROVIDED','header' => true],
                    [
                        'label' => 'Yii2 PROVIDED',
                        'icon' => 'language',
                        'items' => [
                            ['label' => 'Login', 'url' => ['/site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                            ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                            ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                        ],
//                        'visible' => User::hasRole('Admin')
                    ],

                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>