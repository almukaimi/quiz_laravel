<section class="category-header-area" style="background-color: #505763;">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">
                            <a href="#">
                                <?php echo $page_title;; ?>
                            </a>
                        </li>
                    </ol>
                </nav>
                <h1 class="category-name">
                    <?php echo $page_title; ?>
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="category-course-list-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" style="padding: 35px;">
                <div class="content-box">
                    <div class="basic-group">
                        <?= form_open_multipart(site_url('home/course_action/create')) ?>
                        <!--<form action="<?php //echo site_url('home/course_action/create'); ?>" method="post" enctype="multipart/form-data">-->
                            <div class="form-group">
                                <label for="title"><?php echo $this->lang->line('basics'); ?>:</label>
                                <input type="text" class="form-control" name = "title" id="title" placeholder="<?php echo $this->lang->line('title'); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="short_description"><?php echo $this->lang->line('short_description'); ?>:</label>
                                <textarea class="form-control" name = "short_description" id="short_description" required rows="6"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description"><?php echo $this->lang->line('description'); ?>:</label>
                                <textarea class="form-control" name = "description" id="description" required rows="6"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo $this->lang->line('category'); ?></label>
                                <div class="controls">
                                    <select class="form-control" id="category_id" name="category_id" onchange="ajax_get_sub_category(this.value)" required>
                                        <option value=""><?php echo $this->lang->line('select_a_category'); ?></option>
                                        <?php
                                        $categories = $this->crud_model->get_categories();
                                        foreach ($categories->result_array() as $category):?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo $this->lang->line('sub_category'); ?></label>
                            <div class="controls">
                                <select class="form-control" id="sub_category_id" name="sub_category_id" required>
                                    <option value=""><?php echo $this->lang->line('select_a_category_first'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description"><?php echo $this->lang->line('level'); ?>:</label>
                            <select class="form-control" name="level">
                                <option value="beginner"><?php echo $this->lang->line('beginner'); ?></option>
                                <option value="advanced"><?php echo $this->lang->line('advanced'); ?></option>
                                <option value="intermediate"><?php echo $this->lang->line('intermediate'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description"><?php echo $this->lang->line('language_made_in'); ?>:</label>
                            <select class="form-control" id="language_made_in" name="language_made_in" required>
                                <?php
                                $fields = $this->db->list_fields('language');
                                foreach ($fields as $field):
                                    $current_default_language	=	$this->db->get_where('settings' , array('key'=>'language'))->row()->value;?>
                                    <?php if ($field == 'phrase_id' || $field == 'phrase') continue;?>
                                    <option value="<?php echo $field;?>"
                                        <?php if ($current_default_language == $field)echo 'selected';?>> <?php echo ucfirst($field);?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="checkbox check-success">
                                <input id="isTopCourseCheckbox" type="checkbox" value="1" name = "is_top_course" onclick="topCourseChecked(this)">
                                <label for="isTopCourseCheckbox" onclick="topCourseChecked(this)"><?php echo $this->lang->line('is_top_course'); ?></label>
                            </div>
                        </div>

                        <div id = "outcomes_area" style="padding: 0; margin : 0;">
                            <div class="form-group">
                                <label class="form-label"><?php echo $this->lang->line('outcomes'); ?></label>
                                <div class="controls">
                                    <input type="text" name = "outcomes[]" class="form-control">
                                    <button type="button" class = "btn btn-xs" name="button" onclick="appendOutcome()" style="float: right;margin-right: -52px;margin-top: -37px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>

                            <div id = "blank_outcome_field">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" name = "outcomes[]" class="form-control">
                                        <button type="button" class = "btn btn-default" name="button" onclick="removeOutcome(this)" style="float: right;margin-right: -52px;margin-top: -37px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id = "requirement_area">
                            <div class="form-group">
                                <label class="form-label"><?php echo $this->lang->line('requirements'); ?></label>
                                <div class="controls">
                                    <input type="text" name = "requirements[]" class="form-control">
                                    <button type="button" class = "btn btn-default" name="button" onclick="appendRequirement()" style="float: right;margin-right: -52px;margin-top: -37px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>

                            <div id = "blank_requirement_field">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" name = "requirements[]" class="form-control">
                                        <button type="button" class = "btn btn-default" name="button" onclick="removeRequirement(this)" style="float: right;margin-right: -52px;margin-top: -37px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basic-group">

                        <div class="row-fluid">
                            <div class="checkbox check-success">
                                <input id="freeCourseCheckbox" type="checkbox" value="1" name = "is_free_course" onclick="isFreeCourseChecked()">
                                <label for="freeCourseCheckbox" onclick="isFreeCourseChecked()"><?php echo $this->lang->line('free_course'); ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo $this->lang->line('price').'<strong> ('.get_settings('system_currency').')</strong>'; ?></label>
                            <div class="controls">
                                <input type="number" id = "price" name = "price" class="form-control" required onkeyup="calculateDiscountPercentage($('#discounted_price').val())" min="0">
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="checkbox check-success">
                                <input id="discountCheckbox" type="checkbox" value="1" name = "discount_flag" onclick="priceChecked(this)">
                                <label for="discountCheckbox" onclick="priceChecked(this)"><?php echo $this->lang->line('has_discount'); ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><?php echo $this->lang->line('discounted_price').'<strong> ('.get_settings('system_currency').')</strong>'; ?></label>
                            <div class="controls">
                                <input type="number" name = "discounted_price" id ="discounted_price" class="form-control" onkeyup="calculateDiscountPercentage(this.value)" min="0">
                            </div>
                            <input type="text" class="form-control" name = "discounted_percentage" id = "discounted_percentage" style="float: right; margin-right: -81px; width: 80px; text-align: center; margin-top: -37px;" readonly value="0%">
                        </div>
                        <div class="content-box">
                            <div class="email-group">
                                <div class="form-group">
                                    <label for="user_image"><?php echo $this->lang->line('upload_image'); ?>:</label>
                                    <input type="file" class="form-control" name="course_thumbnail" accept="image/*">
                                    <label class="form-label" style="color: red; font-weight: bold;"><?php echo $this->lang->line('note').': '.$this->lang->line('thumbnail_size_should_be_600_X_600');?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description"><?php echo $this->lang->line('course_overview_provider'); ?>:</label>
                            <select class="form-control" name="course_overview_provider">
                                <option value="youtube"><?php echo $this->lang->line('youtube'); ?></option>
                                <option value="vimeo"><?php echo $this->lang->line('vimeo'); ?></option>
                                <option value="html5"><?php echo $this->lang->line('HTML5'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for = "course_overview_url"><?php echo $this->lang->line('course_overview_url'); ?></label>
                            <div class="controls">
                                <input type="text" name = "course_overview_url" id = "course_overview_url" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for = "meta_keywords"><?php echo $this->lang->line('meta_keywords'); ?></label>
                            <div class="controls">
                                <input type="text" class="form-control tagsInput" name="meta_keywords" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_description"><?php echo $this->lang->line('meta_description'); ?>:</label>
                            <textarea class="form-control" name = "meta_description" id="meta_description" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="content-update-box">
                        <button type="submit" name = "create_course" class="btn col-4"><?php echo $this->lang->line('create_course'); ?></button>
                        <button type="submit" name = "save_to_draft" class="btn col-4" style="background-color: #2196F3; border-color: #2196F3;"><?php echo $this->lang->line('save_to_draft'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>


<script type="text/javascript">
var blank_outcome = jQuery('#blank_outcome_field').html();
var blank_requirement = jQuery('#blank_requirement_field').html();
jQuery(document).ready(function() {
    jQuery('#blank_outcome_field').hide();
    jQuery('#blank_requirement_field').hide();
});
function appendOutcome() {
    jQuery('#outcomes_area').append(blank_outcome);
}
function removeOutcome(outcomeElem) {
    jQuery(outcomeElem).parent().parent().remove();
}

function appendRequirement() {
    jQuery('#requirement_area').append(blank_requirement);
}
function removeRequirement(requirementElem) {
    jQuery(requirementElem).parent().parent().remove();
}

function ajax_get_sub_category(category_id) {
    console.log(category_id);
    $.ajax({
        url: '<?php echo site_url('admin/ajax_get_sub_category/');?>' + category_id ,
        data: {'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash() ?>'},
        success: function(response)
        {
            jQuery('#sub_category_id').html(response);
        }
    });
}

function priceChecked(elem){
    if (jQuery('#discountCheckbox').is(':checked')) {

        jQuery('#discountCheckbox').prop( "checked", false );
    }else {

        jQuery('#discountCheckbox').prop( "checked", true );
    }
}

function topCourseChecked(elem){
    if (jQuery('#isTopCourseCheckbox').is(':checked')) {

        jQuery('#isTopCourseCheckbox').prop( "checked", false );
    }else {

        jQuery('#isTopCourseCheckbox').prop( "checked", true );
    }
}

function calculateDiscountPercentage(discounted_price) {
    if (discounted_price > 0) {
        var actualPrice = jQuery('#price').val();
        if ( actualPrice > 0) {
            var reducedPrice = actualPrice - discounted_price;
            var discountedPercentage = (reducedPrice / actualPrice) * 100;
            if (discountedPercentage > 0) {
                jQuery('#discounted_percentage').val(discountedPercentage.toFixed(2) + "%");

            }else {
                jQuery('#discounted_percentage').val('<?php echo '0%'; ?>');
            }
        }
    }
}


// function checkFormValidity(event) {
//     var input_ids = ['title', 'short_description', 'description', 'category_id', 'sub_category_id', 'price', 'course_overview_url'];
//     for(i = 0; i < input_ids.length; i++){
//         if($('#'+input_ids[i]).val() === "") {
//             event.preventDefault();
//         }
//     }
// }

function isFreeCourseChecked() {

    if (jQuery('#freeCourseCheckbox').is(':checked')) {
        $('#price').prop('required',false);
    }else {
      $('#price').prop('required',true);
    }
}

</script>
