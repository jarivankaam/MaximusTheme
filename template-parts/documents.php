<?php
// Fetch all files from an ACF File field (set to return “Array” and allow multiple files)
$files = get_field('your_file_field');

if ( $files && is_array( $files ) ) : ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled">
                    <?php foreach ( $files as $file ) :
                        // Safety check in case some entries aren’t full arrays
                        if ( empty( $file['url'] ) || empty( $file['filename'] ) ) {
                            continue;
                        }
                        ?>
                        <li>
                            <a href="<?php echo esc_url( $file['url'] ); ?>" download>
                                <?php echo esc_html( $file['filename'] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php
else :
    // No files found
    echo '<p>No files available for download.</p>';
endif;
?>
