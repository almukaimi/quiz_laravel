<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title print-hidden"><?php echo $page_title; ?></h1>
                <ul class="print-hidden">
                  <li class="<?php if($page_name == 'my_courses') echo 'active'; ?>"><a href="<?php echo site_url('home/my_courses'); ?>"><?php echo $this->lang->line('courses'); ?></a></li>

                  <?php if(addon_status('course_bundle')): ?>
                    <li class="<?php if($page_name == 'my_bundles' || $page_name == 'bundle_invoice') echo 'active'; ?>"><a href="<?php echo site_url('home/my_bundles'); ?>"><?php echo $this->lang->line('bundles'); ?></a></li>
                  <?php endif; ?>

                  <li class="<?php if($page_name == 'my_wishlist') echo 'active'; ?>"><a href="<?php echo site_url('home/my_wishlist'); ?>"><?php echo $this->lang->line('wishlists'); ?></a></li>

                  <li class="<?php if($page_name == 'my_messages') echo 'active'; ?>"><a href="<?php echo site_url('home/my_messages'); ?>"><?php echo $this->lang->line('messages'); ?></a></li>

                  <li class="<?php if($page_name == 'purchase_history' || $page_name == 'invoice') echo 'active'; ?>"><a href="<?php echo site_url('home/purchase_history'); ?>"><?php echo $this->lang->line('purchase_history'); ?></a></li>

                  <li class="<?php if($page_name == 'user_profile') echo 'active'; ?>"><a href="<?php echo site_url('home/profile/user_profile'); ?>"><?php echo $this->lang->line('profile'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>