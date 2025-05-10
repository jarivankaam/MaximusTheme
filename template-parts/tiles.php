<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;


$tiles = get_sub_field('tiles');
$section_title = get_sub_field('section_title');
$partners = get_sub_field('partners');
$head_sponsor = get_sub_field("head");

$tileCount = count($tiles);
$col_count = 12 / $tileCount;
$extra_col;

if($partners) {
    $extra_col = 1;
} else {
    $extra_col = 0;
}
?>

<section id="<?= $section_id ?>" class="section-tiles <?php if($partners) : ?> partners <?php endif ?>">
    <div class="container">
        <?php if($section_title) : ?>
            <div class="section-heading">
                <h2>
                    <?= $section_title ?>
                </h2>
            </div>
        <?php endif ?>
        <div class="row">
            <?php foreach($tiles as $tile): ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-<?= round($col_count + $extra_col) ?> ">
                    <?php if($tile['title'] || $tile['icon']) : ?>
                        <<?= $partners ? 'a href="' . (!empty($tile['button']) ? $tile['button'] : '#') . '"' : 'div' ?> class="tile-wrapper <?php if($head_sponsor) : ?>head-sponsor<?php endif ?>flex justify-content-center">
                            <div class="content-wrapper border-radius-10 flex flex-column align-items-center justify-content-center">
                                <?php if ($tile['icon']) : ?>
                                    <div class="image-wrapper">
                                        <img src="<?= $tile['icon'] ?>" alt="icon">
                                    </div>
                                <?php endif ?>
                                <div class="maxtext flex flex-column align-items-center justify-content-center">
                                    <p class="bold"><?= $tile['title'] ?></p>
                                    <?php if ($tile['content']) : ?>
                                        <p><?= $tile['content'] ?></p>
                                    <?php endif ?>

                                </div>

                            </div>
                        </<?= $partners ? "a" : "div" ?>>
                    <?php endif ?>
                </div>
            <?php endforeach; ?>
         </div>
    </div>
</section>


