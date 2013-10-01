/**
 * Created with JetBrains PhpStorm.
 * Date: 9/9/13
 * Time: 12:04 PM
 */

jQuery(document).ready(function () {
  jQuery(".gm-type select").change(function (event) {
    console.log(jQuery(this).parents('p').find('.hidden'));
    if (this.value == 'leaderboard') {
      jQuery(this).parents('.widget-content').find('.hidden').removeClass('hidden');
    } else {
      jQuery(this).parents('.widget-content').find('.gm-period,.gm-count').not('hidden').addClass('hidden');
    }
  });
  jQuery('.gm-type select').each(function () {
    var val = jQuery(this).find(':selected').val();
    if (val == 'leaderboard') {
      jQuery(this).parents('.widget-content').find('.hidden').removeClass('hidden');
    }
  });
  jQuery('.gigya-settings .closed').each(function () {
    jQuery(this).find('.span3').addClass('toggle-label').wrap('<a class="toggle-link" href="#" />').preApp;
    jQuery(this).find('.span6').addClass('hidden');
  });
  jQuery('.toggle-link').click(function (ev) {
    ev.preventDefault();
    jQuery(this).next('.span6').slideToggle();
  });
});