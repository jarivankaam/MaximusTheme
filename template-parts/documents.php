<?php if( have_rows('files') ): ?>
    <div class="container">
        <?php $title = get_sub_field('title'); ?>
        <?php if ($title): ?>
            <div class="section-heading">
                <h2><?= esc_html($title) ?></h2>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled">
                    <?php
                    // Loop through each row of the 'files' repeater
                    while( have_rows('files') ): the_row();

                        // Check the true/false 'location' sub-field
                        $is_file = get_sub_field('location');

                        if( $is_file ):
                            // If location is true, treat 'file' as an ACF File (Array)
                            $file = get_sub_field('file');
                            if( is_array($file) && ! empty($file['url']) && ! empty($file['filename']) ): ?>
                                <li>
                                    <a href="<?php echo esc_url( $file['url'] ); ?>" download>
                                        <?php echo esc_html( $file['filename'] ); ?>
                                    </a>
                                </li>
                            <?php
                            endif;

                        else:
                            // If location is false, treat 'link' as a simple URL text field
                            $link = get_sub_field('link');
                            if( ! empty($link) ): ?>
                                <li>
                                    <a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener">
                                        <?php echo esc_html( $link ); ?>
                                    </a>
                                </li>
                            <?php
                            endif;

                        endif;

                    endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>No items found.</p>
<?php endif; ?>
