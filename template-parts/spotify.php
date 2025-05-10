<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;
?>

<section id="<?= $section_id ?>" class="section-spotify">
    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/7JJo7YCpCBXFAvwGVIpiiN?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
</section>