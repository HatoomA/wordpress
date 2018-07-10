<?php
/*
 Template Name: register
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); 
  $hawaiiURL =get_field("register_hawaii_page");
  $seattleURL = get_field("register_seattle_page");
?>

<div id="content" class="programs register">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3>Register</h3>
  </div>

  <div id="inner-content" class="wrap cf">

      <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <div class="contentSection courseLocations">

          <ul class="imageList listView courseLocations">
            <li class="hawaii">
              <h2 class="listViewTitle">Hawaii</h2>
              <a class="" href="<?php echo $hawaiiURL; ?>">
                <img src="<?php echo bloginfo('template_directory').'/library/images/hawaiiPixels.png' ?>">
              </a>
            </li>
            <li class="dummy">
            </li>
            <li class="seattle">
              <h2 class="listViewTitle">Seattle</h2>
              <a class="" href="<?php echo $seattleURL; ?>">
                <img src="<?php echo bloginfo('template_directory').'/library/images/seattlePixels.png' ?>">
              </a>
            </li>

          </ul>
        </div>

      </main>

  </div>

</div>

<script>
  jQuery(document).ready(function(){
    var $ = jQuery;
    var $list = $(".coursePrograms");
    var $listItems = $(".coursePrograms li");
    $listItems.each(function(){
      $(this).one("click", function(){
        $listItems.removeClass("active");
        $(this).addClass("active");
        $list.removeClass("listView");
        $listItems.off( "click", "**" );
        $('.jumpTos a').each(function(){
          this.addEventListener("click", function(){
            var target = $(this).data('program');
            $listItems.removeClass("active");
            $('.'+target).addClass("active");
          });
        });
      });
    });
  });

</script>


<?php get_footer(); ?>
