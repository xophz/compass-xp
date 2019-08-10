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
  $key_ = "_xp_achievement_";

  $repeat_count = get_post_meta($id, "{$key_}repeat_count", true);
  $repeat_every = get_post_meta($id, "{$key_}repeat_every", true);
  $repeat_on = get_post_meta($id, "{$key_}repeat_on", true);

  if(empty($repeat_on))
    $repeat_on = [];

?>
Repeat
Every:
<input 
  type="number" 
  name="_xp_achievement_repeat_count" 
  id="job-repeat-every"
  defaultValue="<?= $repeat_count?>"
  value="<?= $repeat_count?>"
  style="vertical-align: middle; width: 40px"
>
<select 
  onChange="toggleRepeatOn(this)"
  value="<?= $repeat_every?>"
  name="_xp_achievement_repeat_every"
>
  <option value="day"
    <?= $repeat_every == 'day' ? 'selected' : false ?>
  >
    Day
  </option>
  <option value="week"
    <?= $repeat_every == 'week' || empty($repeat_every) ? 'selected' : false  ?>
  >
    Week
  </option>
  <option value="month"
    <?= $repeat_every == 'month' ? 'selected' : false ?>
  >
    Month 
  </option>
  <option value="year"
    <?= $repeat_every == 'year' ? 'selected' : false ?>
  >
    Year
  </option>
</select>
<div class="weekDays-selector" id="job-repeat-on">
  <hr/>
  Repeat On:
  <br/>
  <input
    type="checkbox"
    id="weekday-sun"
    class="weekday"
    name="_xp_achievement_repeat_on[]"
    value="sun"
    <?= false !== array_search("sun",$repeat_on) ? 'checked' : false ?>
  />
  <label for="weekday-sun">S</label>
  <input
    type="checkbox"
    id="weekday-mon"
    class="weekday"
    name="_xp_achievement_repeat_on[]"
    value="mon"
    <?= false !== array_search("mon",$repeat_on) ? 'checked' : false ?>
  />
  <label for="weekday-mon">M</label>
  <input
    type="checkbox"
    id="weekday-tue"
    class="weekday"
    name="_xp_achievement_repeat_on[]"
    value="tue"
    <?= false !== array_search("tue",$repeat_on) ? 'checked' : false ?>
  />
  <label for="weekday-tue">T</label>
  <input
    type="checkbox"
    id="weekday-wed"
    class="weekday"
    name="_xp_achievement_repeat_on[]"
    value="wed"
    <?= false !== array_search("wed",$repeat_on) ? 'checked' : false ?>
  />
  <label for="weekday-wed">W</label>
  <input
    type="checkbox"
    id="weekday-thu"
    class="weekday"
    name="_xp_achievement_repeat_on[]"
    value="thu"
    <?= false !== array_search("thu",$repeat_on) ? 'checked' : false ?>
  />
  <label for="weekday-thu">T</label>
  <input
    type="checkbox"
    id="weekday-fri"
    class="weekday"
    name="_xp_achievement_repeat_on[]"
    value="fri"
    <?= false !== array_search("fri",$repeat_on) ? 'checked' : false ?>
  />
  <label for="weekday-fri">F</label>
  <input
    type="checkbox"
    id="weekday-sat"
    class="weekday"
    name="_xp_achievement_repeat_on[]"
    value="sat"
    <?= false !== array_search("sat",$repeat_on) ? 'checked' : false ?>
  />
  <label for="weekday-sat">S</label>
</div>

<style>
  #job-repeat-on{
    display: <?= $repeat_every == 'week' || empty($repeat_every)? 'block': 'none'?>  
  }
  .weekDays-selector input {
    display: none !important;
  }

  .weekDays-selector input[type=checkbox] + label {
    display: inline-block;
    border-radius: 6px;
    background: #dddddd;
    height: 40px;
    width: 30px;
    margin-right: 3px;
    line-height: 40px;
    text-align: center;
    cursor: pointer;
  }

  .weekDays-selector input[type=checkbox]:checked + label {
    background: #2AD705;
    color: #ffffff;
  }
</style>
<script>
  function countPlural(e){
    if(e.value > 1){
      document.getElementById('job-repeat-every').innerHTML =

      document.getElementById('job-repeat-every').innerHTML+'s'

    }
  }
  function toggleRepeatOn(e){
    switch(e.value){
      case('week'):
        document.getElementById('job-repeat-on')
          .style.display = 'block';
      break;
      default:
        document.getElementById('job-repeat-on')
          .style.display = 'none';
      break;
    }
  }
</script>
