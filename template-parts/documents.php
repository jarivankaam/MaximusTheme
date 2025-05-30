<?php
// Unique ID per repeater row
$row_index  = get_row_index();
$section_id = 'section-files-' . $row_index;

// Section title (change to get_field('…') if this is not a sub‐field)
$section_title = get_sub_field('title');
?>

<section id="<?= esc_attr( $section_id ) ?>" class="section-files">
    <div class="container">

        <?php if ( $section_title ): ?>
            <div class="section-heading">
                <h2><?= esc_html( $section_title ) ?></h2>
            </div>
        <?php endif; ?>

        <?php if ( have_rows('files') ): ?>
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <?php while ( have_rows('files') ): the_row();

                            // Toggle: file vs. link
                            $is_file = get_sub_field('location');

                            if ( $is_file ):
                                $file = get_sub_field('file');
                                $url  = $file['url']      ?? '';
                                $text = $file['filename'] ?? '';
                                $attr = ' download';
                            else:
                                $url  = get_sub_field('link') ?: '';
                                $text = $url;
                                $attr = ' target="_blank" rel="noopener"';
                            endif;

                            if ( $url && $text ): ?>
                                <li>
                                    <a href="<?= esc_url( $url ) ?>"<?= $attr ?>>
                                        <?= esc_html( $text ) ?>
                                    </a>
                                </li>
                            <?php endif;

                        endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <p>No items found.</p>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
