<?php
$current_lang = Session::get('lang');
Config::set('language', $current_lang);
Lang::load('main');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title ?></title>
        <meta charset="utf-8">
            <?php
            // CSS assets
            //echo Asset::css('bootstrap.css');
            echo Asset::css('style.css');
            // JS assets
           
            echo Asset::js('jquery.min.js');
            echo Asset::js('bootstrap.min.js');
            ?>
        </meta>
    </head>
    <body>
        <!--The start of header-->
        <div id="header">
            <?php
            echo Html::anchor('public/lang/en', Asset::img('/flags/enflag.png'), array('class' => 'flag'));
            echo Html::anchor('public/lang/lv', Asset::img('/flags/lvflag.png'), array('class' => 'flag'));
            ?>
            <?php echo Asset::img('logo.png', array('id' => 'logo')); ?>
            </br> <p class="intro"><?php echo __('INTRO'); ?></p>
        </div>
        <!--Navigation bar horizontally-->
        <div id="navigation-background">
            <div class="navbar-header">
                <ul class="drop">
                    <li>
                        <?php echo Html::anchor('welcome', __('NAV_WELCOME'), array(
                                    'class' => 'hor-nav-btn nav-btn',
                                    ));?> 
                    </li> 
                    <li class="dropdown">
                        <?php echo Html::anchor('psychology', __('NAV_PSYCHOLOGY'), array(
                                'class' => 'hor-nav-btn nav-btn dropdown-toggle',
                        'data-toggle' => 'dropdown'
                                )); ?>
                             <ul class="dropdown-menu">
                                <li>
                                    <?php echo Html::anchor('psychology/consultations', __('NAV_CONSULTATIONS'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                )); ?> 
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology/diagnostics', __('NAV_DIAGNOSTICS'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                )); ?>
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology/familytherapy', __('NAV_FAMILY_THERAPY'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                )); ?>
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology/psychology', __('NAV_PSYCHOLOGY'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                )); ?>
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology', __('NAV_SUPERVISIONS'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                )); ?>
                                </li>
                            </ul>
                    </li> 
                    <li> <?php
                        echo Html::anchor('sand', __('NAV_SAND'), array(
                            'class' => 'hor-nav-btn nav-btn',
                            ));
                        ?></li> 
                    <li> <?php
                            echo Html::anchor('montesori', __('NAV_MONTESORI'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                ));
                        ?></li> 
                    <li> <?php
                            echo Html::anchor('speechtherapy', __('NAV_SPEECHTHERAPY'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                ));
                        ?></li> 
                    <li><?php
                            echo Html::anchor('physiotherapy', __('NAV_PHYSIOTHERAPY'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                ));
                        ?></li> 
                    <li> <?php
                            echo Html::anchor('additional', __('NAV_ADDITIONAL'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                'id' => 'additional-btn'));
                        ?></li> 
                    <li> <?php
                            echo Html::anchor('price', __('NAV_PRICE'), array(
                                'class' => 'hor-nav-btn nav-btn',
                                ));
                        ?>
                            <ul>
                                <li>
                                    <?php echo Html::anchor('psychology/consultations', __('NAV_CONSULTATIONS')); ?> 
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology/diagnostics', __('NAV_DIAGNOSTICS')); ?>
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology/familytherapy', __('NAV_FAMILY_THERAPY')); ?>
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology/psychology', __('NAV_PSYCHOLOGY')); ?>
                                </li>
                                <li>
                                    <?php echo Html::anchor('psychology', __('NAV_SUPERVISIONS')); ?>
                                </li>
                            </ul>
                        
                    </li>
                </ul>
            </div>
        </div>
        <div id="content-background">
            <div class="content">

                <div id="sidebar">
                    <!--Navigation bar vertically-->
                    <div class="navbar-left">
                        <ul class="vertical-navigation">
                            <li> <?php echo Html::anchor('aboutus', __('NAV_ABOUT_US'), array('class' => 'ver-nav-btn nav-btn')); ?> </li>
                            <li> <?php echo Html::anchor('contact', __('NAV_CONTACT'), array('class' => 'ver-nav-btn nav-btn')); ?> </li>
                            <li> <?php echo Html::anchor('gallery', __('NAV_GALLERY'), array('class' => 'ver-nav-btn nav-btn')); ?> </li>
                            <li> <?php echo Html::anchor('employee', __('NAV_EMPLOYEE'), array('class' => 'ver-nav-btn nav-btn')); ?> </li>
                            <li> <?php echo Html::anchor('#', __('NAV_METHODICAL_MATERIALS'), array('class' => 'ver-nav-btn nav-btn')); ?> </li>
                        </ul>
                    </div>
                </div>
                <!--Main content -->
                <div class="view">
<?php echo $content; ?>
                    <br class="clear" />
                </div>

                </di</div>
            <div class="footer">
                Autortiesības www.laimas.lv © 2014 | 

                <!-- Autentification panel-->

<?php if ($current_user): ?>
                    Pierakstījies kā <?php echo Html::anchor('users/view/' . $current_user->id, $current_user->username) ?>
                    (<?php echo Html::anchor('users/logout', 'Izrakstīties') ?>)
<?php else: ?>
    <?php echo Html::anchor('users/login', 'Pierakstīties') ?> 
<?php endif ?>
                <!-- End of autentification panel --> |

            </div>
        </div>
        </div>
    </body>
</html>

