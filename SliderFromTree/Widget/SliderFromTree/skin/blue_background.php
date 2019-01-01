<section class="section-primary background-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-primary-box">
                    <h2 class="ipsContainer heading-section tHead">
                        <?php
                            if (!empty($text['header'])) {
                                echo $text['header'];
                            }
                        ?>
                    </h2>
                    <h3 class="ipsContainer sub-heading-section tDesc">
                        <?php
                            if (!empty($text['description'])) {
                                echo $text['description'];
                            }
                        ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-skew-full-width-image">
        <?php foreach ($pages as $page): ?>
            <div>
                <a href="<?= $page['link'] ?>" class="skew-box-image-slider">
                    <div class="background-settings" <?php if (!empty($page['image'])): ?>style="background-image: url(<?= $page['image'] ?>);" <?php endif; ?>></div>
                    <div class="desc">
                        <h3 class="sub-heading-section"><?= $page['title'] ?></h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section> 