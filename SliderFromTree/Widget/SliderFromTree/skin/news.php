<section class="section-primary actuality-list-section">
    <div class="container">
        <div class="row">
            <?php foreach ($pages as $page): ?>
                <div class="col-lg-4 col-md-6">
                    <a class="news-box" href="<?= $page['link'] ?>">
                        <div class="image background-settings"  <?php if (!empty($page['image'])): ?>style="background-image: url(<?= $page['image'] ?>);" <?php endif; ?>></div>
                        <div class="apla">
                            <div class="apla-inner">
                                <p class="date"><?= $page['subtitle'] ?></p>
                                <h3 class="sub-heading-small"><?= $page['title'] ?></h3>
                            </div>
                        </div>
                        <div class="desc">
                            <p class="paragraph-small"><?= $page['description'] ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($showButton)): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-position-center">
                        <button type="button" class="btn-primary load-more"><?= __('Load more', 'SliderFromTree') ?></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>