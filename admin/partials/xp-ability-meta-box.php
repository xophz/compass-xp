<?php

/**
 * Job repeat box for custom job post type
 *
 * @link       http://mycompassconsulting.com
 * @since      1.0.0
 *
 * @package    Xophz_Compass_Xp
 * @subpackage Xophz_Compass_Xp/admin/partials
 *
 */
  wp_nonce_field( 'xophz-compass-xp-job-xp','job_xp_box_content_nonce' );

  $id = get_the_ID();
  $key = "_xp_ability";

  $ap_to_unlock = get_post_meta($id, "{$key}_ap_to_unlock", true);
  $repeat = get_post_meta($id, "{$key}_repeat", true);

?>
Minimum AP
<input 
  type="number" 
  name="_xp_ability_ap_to_unlock" 
  id="job-repeat-every"
  defaultValue="<?= $ap_to_unlock?>"
  value="<?= $ap_to_unlock?>"
  style="vertical-align: middle; width: 60px"
>
&infin;
<select 
  onChange="toggleRepeatOn(this)"
  value="<?= $repeat?>"
  name="_xp_ability_repeat"
>
  <option value="day"
    <?= $repeat == 'day' ? 'selected' : false ?>
  >
    Day
  </option>
  <option value="week"
    <?= $repeat == 'week' ? 'selected' : false ?>
  >
    Week
  </option>
  <option value="month"
    <?= $repeat == 'month' ? 'selected' : false ?>
  >
    Month 
  </option>
  <option value="year"
    <?= $repeat == 'year' ? 'selected' : false ?>
  >
    Year
  </option>
  <option value="all"
    <?= $repeat == 'all' ? 'selected' : false ?>
  >
    All Time
  </option>
</select>
