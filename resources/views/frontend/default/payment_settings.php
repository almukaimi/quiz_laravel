<?php
    $user_data   = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
    $paypal_keys = json_decode($user_data['paypal_keys'], true);
    $stripe_keys = json_decode($user_data['stripe_keys'], true);
 ?>
<section class="user-dashboard-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="user-dashboard-box">
                    <div class="user-dashboard-content" style="width: 100%;">
                        <div class="content-title-box">
                            <div class="title"><?php echo $this->lang->line('payment_settings'); ?></div>
                            <div class="subtitle"><?php echo $this->lang->line('update_your_payment_settings'); ?>.</div>
                        </div>
                        <?= form_open(site_url('home/update_profile/update_payment_settings')) ?>
                        <!--<form action="<?php //echo site_url('home/update_profile/update_payment_settings'); ?>" method="post">-->
                            <div class="content-box">
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName"><?php echo $this->lang->line('paypal_client_id'); ?>:</label>
                                        <input type="text" class="form-control" name = "paypal_client_id" id="paypal_client_id" placeholder="<?php echo $this->lang->line('paypal_client_id'); ?>" value="<?php echo $paypal_keys[0]['production_client_id']; ?>">
                                    </div>
                                </div>
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName"><?php echo $this->lang->line('stripe_public_key'); ?>:</label>
                                        <input type="text" class="form-control" name = "stripe_public_key" id="stripe_public_key" placeholder="<?php echo $this->lang->line('stripe_public_key'); ?>" value="<?php echo $stripe_keys[0]['public_live_key']; ?>">
                                    </div>
                                </div>
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName"><?php echo $this->lang->line('stripe_secret_key'); ?>:</label>
                                        <input type="text" class="form-control" name = "stripe_secret_key" id="stripe_secret_key" placeholder="<?php echo $this->lang->line('stripe_secret_key'); ?>" value="<?php echo $stripe_keys[0]['secret_live_key']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="content-update-box">
                                <button type="submit" class="btn"><?php echo $this->lang->line('update'); ?></button>
                            </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
