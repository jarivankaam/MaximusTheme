<?php if( have_rows('files') ): ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled">
                    <?php
                    // Loop through each row of the 'files' repeater
                    while( have_rows('files') ): the_row();

                        // Get the sub-field (File field set to return Array)
                        $file = get_sub_field('file');

                        // Make sure we have a valid file array
                        if(
                            is_array($file) &&
                            ! empty($file['url']) &&
                            ! empty($file['filename'])
                        ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $file['url'] ); ?>" download>
                                    <?php echo esc_html( $file['filename'] ); ?>
                                </a>
                            </li>
                        <?php endif;

                    endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>No files found.</p>
<?php endif; ?>
