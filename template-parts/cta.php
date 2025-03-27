<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$background_image = get_sub_field('background');
$title = get_sub_field('title');
$subtext = get_sub_field('subtext');
$url = get_sub_field('url');
?>

<section id="<?= $section_id ?>" class="section-cta">

    <div class="container">
       <div class="content">
            <div class="content__wrapper">
                <img class="background-image absolute top left"  src="<?= $background_image ?>" alt="image"/>
                <div class="content__inner__wrapper">
                    <h2><?= $title ?></h2>
                    <div class="content__subtext">
                        <p><?= $subtext ?></p>
                    </div>
                    <div class="content__cta">
                        <a class="cta__button" href="<?= $url['url'] ?>"><?= $url['title'] ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
