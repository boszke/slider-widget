<section class="section-primary background-section similar-products-section d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="ipsContainer heading-xsmall heading-with-apla tHead">
                    <?php
                        if (!empty($text['header'])) {
                            echo $text['header'];
                        }
                    ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="slider-skew-tripple-column">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ($pages as $page): ?>
                                <div class="swiper-slide">
                                    <a class="skew-box-slider" href="<?= $page['link'] ?>">
                                        <div class="skew-box-slider-inner">
                                            <div class="image background-settings" <?php if (!empty($page['image'])): ?>style="background-image: url(<?= $page['image'] ?>);" <?php endif; ?>></div>
                                            <div class="desc">
                                                <p class="plane">
                                                    <strong><?= $page['title'] ?></strong>
                                                    <span><?= $page['subtitle'] ?></span>
                                                </p>
                                                <p class="price"><?= $page['description'] ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination swiper-pagination-rectangle"></div>
                </div>
            </div>
        </div>
        <?php if (!empty($showButton)): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-position-center">
                    <a class="btn-primary" href="<?= $showButton ?>"><?= __('See the full offer', 'SliderFromTree') ?></a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>