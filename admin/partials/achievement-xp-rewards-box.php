<?php

/**
 * Job xp rewards box for custom job post type
 *
 * @link       http://mycompassconsulting.com
 * @since      1.0.0
 *
 * @package    Xophz_Compass_Xp
 * @subpackage Xophz_Compass_Xp/admin/partials
 */
  wp_nonce_field( 'xophz-compass-xp-job-xp','job_xp_box_content_nonce' );

  $post_id = get_the_ID();

  $job_xp = get_post_meta($post_id,'_xp_achievement_xp',true);
  $job_ap = get_post_meta($post_id,'_xp_achievement_ap',true);
  $job_gp = get_post_meta($post_id,'_xp_achievement_gp',true);
  $max_redo_limit = get_post_meta($post_id,'_xp_achievement_max_redo_limit',true);
?>
<label for="job_ap">Ability Points (Reward for Good Deeds)</label>
<input 
  type='text' 
  id='job_ap' 
  name='_xp_achievement_ap' 
  placeholder='1AP = 1 Brownie Point' 
  value='<?= $job_ap?>'
/><br/>
<label for="job_gp">Gold Points (Reward for Value)</label>
<input 
  type='text' 
  id='job_gp' 
  name='_xp_achievement_gp' 
  placeholder='10GP = $0.01' 
  value='<?= $job_gp?>'
/><br/>
<label for="job_xp">Experience Points (Reward for Time)</label>
<input 
  type='text' 
  id='job_xp' 
  name='_xp_achievement_xp' 
  placeholder='10XP = 1min' 
  value='<?= $job_xp?>'
/><br/>

<label for="job_xp">Max Redo Limit</label>
<input 
  type='number' 
  value='<?= $max_redo_limit?>'
  name='_xp_achievement_max_redo_limit'
>
