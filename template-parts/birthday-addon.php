<?php
// Example: current month
$birthdays = evx_get_um_birthdays_by_month();

// Or for a specific month, e.g. December:
// $birthdays = evx_get_um_birthdays_by_month(12);

if ( ! empty( $birthdays ) ) : ?>
    <section class="section-birthdays">
       <div class="container">
            <ul class="um-birthdays-list">
                <p>Verjaardagen:</p>
                <?php foreach ( $birthdays as $item ) : 
                    $user = $item['user'];
                ?>
                    <li class="um-birthday-item">
                        <a href="<?php echo esc_url( $item['profile_url'] ); ?>">
                            <?php echo esc_html( $user->display_name ); ?>
                        </a>
                        <?php if ( ! empty( $item['formatted_date'] ) ) : ?>
                            <span class="um-birthday-date">
                                – <?php echo esc_html( $item['formatted_date'] ); ?>
                            </span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
<?php else : ?>
    <p>No birthdays this month.</p>
<?php endif; ?>
