<?php
if( have_rows('content_blocks') ) {
    while( have_rows('content_blocks') ) {
        get_template_part('template-parts' . get_row_layout());
    }

}