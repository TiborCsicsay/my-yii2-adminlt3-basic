<?php

use yii\helpers\Html;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="../../index3.html" class="navbar-brand">
            <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?= Html::a(Yii::t('front','Home'),['index'],['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a(Yii::t('front','About'),['about'],['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a(Yii::t('front','Contact'),['contact'],['class' => 'nav-link']) ?>
                </li>
            </ul>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
<!--                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">-->
<!--                    <i class="fas fa-cog"></i>-->
<!--                </a>-->
                <?= Html::a(Yii::t('front','Admin'),['/admin'],['class' => 'nav-link']) ?>
            </li>
        </ul>
    </div>
</nav>
<!-- /.navbar -->