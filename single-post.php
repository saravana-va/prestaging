<?php
/** 
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
$contentBoxType = get_post_custom();
$displayed = 0;
global $categoryColors, $singlePostCategoryBackgroundColor;
$detect = new Mobile_Detect;
?>

<?php  if ( $detect->isMobile() ) {  ?>

<!-- /89562919/Hellou-New-Mobile-Interstial -->
<div id='div-gpt-ad-1449145648981-0' style='height:1px; width:1px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1449145648981-0'); });
</script>
</div>
<?php  }  ?>

<?php  if ( $detect->isTablet() ) {  ?>

<!-- /89562919/Hellou-New-Tablet-Interstial -->
<div id='div-gpt-ad-1449152157451-0' style='height:1px; width:1px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1449152157451-0'); });
</script>
</div>

<?php  }  ?>


<div class="main-content">
<!-- <div class="ad-border">-->

<!-- Just premium-->
<?php //if ( !$detect->isMobile() && !$detect->isTablet()) { ?>

<!--<div  class="float-center ad-space-bottom">

<script type="text/javascript" src="http://uk.ads.justpremium.com/adserve/js.php?zone=10701"></script>


<script type="text/javascript" src="http://us.ads.justpremium.com/adserve/js.php?zone=15365"></script>
</div>-->

<?php// } ?>



    <div class="article__container">
 <?php if ($detect->isMobile()) { ?>	
 <!-- /89562919/Mobile-Masthead -->
<!--<div id='div-gpt-ad-1448625259207-0' style='height:250px; width:300px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1448625259207-0'); });
</script>
</div>-->

 <?php } ?>

<?php if (!$detect->isMobile() && !$detect->isTablet()) { ?>
<!-- Desktop Article Page Top Masthead STag -->
<!-- /89562919/Desktop-Top-Masthead -->
<!--<div id='div-gpt-ad-1450200294756-0' class="float-center ad-space-bottom">
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1450200294756-0'); });
</script>
</div>-->

<script type="text/javascript" src="http://us.ads.justpremium.com/adserve/js.php?zone=15365"></script>
 <?php } ?>
        <?php
//start the loop 
        while (have_posts()) : the_post();

            $displayed = $post->ID; // Get displayed Post, so that the same is not listed in recent posts list.
            // call the comments form
            //comments_template( '', true );

            $shareCount = getShareCount(array($post->ID)); // Share count from DB for the current Post
            // Get category color
            $categoryBackgroundColor = $categoryColors[$contentBoxType['primary_category'][0]];
            $singlePostCategoryBackgroundColor = $categoryColors[$contentBoxType['primary_category'][0]];
            // Get category name
            $primary_cat = $contentBoxType['primary_category'][0];
            $taxonomies = array('category');
            $args = array(
                'fields' => 'all',
                'orderby' => 'name',
                'order' => 'ASC'
            );
            $terms = get_terms($taxonomies, $args);

            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $term->term_id == $primary_cat && ( $cat_name = $term->name );
                }
            }
            ?>
            <!-- NOTE: change '.main-column--discover' depending on category -->
            <div class="main-column main-column--<?php echo get_nav_class($cat_name); ?>" 
                 style="border-top: 7px solid <?php echo $singlePostCategoryBackgroundColor; ?>;">

                <div class="article" data-ix="display-article-next-link">

                    <div class="article__meta-data">
                        <!-- NOTE: change '.article__category--discover' depending on category -->
			 <a href="<?php echo get_category_link( $primary_cat ); ?>">
                          <span class="article__category article__category--<?php echo get_nav_class($cat_name); ?>">
                            <?php echo $cat_name; ?>
                        </span>
                        </a>

                        <time class="article__post-date">
                            <?php echo time_elapsed_string(strtotime($post->post_date)); ?>
                        </time>
                    </div>
			 <?php if($detect->isMobile()) { ?>
                        <div>
                                <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?> 
                        </div>
                        <?php } ?>

                    <h1 class="article__title"><?php the_title(); ?></h1>

                         <?php if (!$detect->isMobile() && !$detect->isTablet()) { ?>
                        <div>
                                <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
                        </div>
                        <?php } ?>

		    <div class="article__author">
		by		
		<span class="article__author-name"><?php the_author(); ?></span>
		<a href="https://twitter.com/<?php the_author_meta('twitter'); ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php the_author(); ?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>


<!--New postion by Andy-->

 <?php if ($detect->isMobile()) { ?>
    <!-- ads placed inside this container will be centered in the LEFT column not the full page width -->
<!-- Top MPU ATF Mobile All geos Off Stag -->
<!--<div id='div-gpt-ad-1448625259207-0' style='height:250px; width:300px;' class="float-center ad-space-bottom">
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1448625259207-0'); });
</script>
</div>-->
 

<?php } ?>
<!--End position by Andy-->

                    <div class="article__share-bar" data-ix="display-nav">
                        <span class="article__share-count"><?php echo $shareCount[$post->ID]; ?> Shares</span>
                        <ul class="article__share-btns">
                            <li>
                                <a href="javascript:void(0);" 
                                   class="article__share-btn article__share-btn--facebook"
                                   onclick="return pop_it_up('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>');">

                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" 
                                   class="article__share-btn article__share-btn--twitter"
                                   onclick="return pop_it_up('https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>');">
                                    Twitter
                                </a>
                            </li>
                            <li>
				<?php echo do_shortcode('[whatsapp]'); ?>
                            </li>
                            <li>
                                <a href="javascript:void(0);" 
                                   class="article__share-btn article__share-btn--reddit"
                                   onclick="return pop_it_up('http://www.reddit.com/submit?url=<?php the_permalink(); ?>/&newwindow=1');">

                                </a>
                            </li>
                        </ul>

                    </div>


                    <?php the_content(); ?>

                    <div class="article__share-bar">
                        <span class="article__share-count"><?php echo $shareCount[$post->ID]; ?> Shares</span>
                        <ul class="article__share-btns">
                            <li>
                                <a href="javascript:void(0);" 
                                   class="article__share-btn article__share-btn--facebook"
                                   onclick="return pop_it_up('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>');">

                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" 
                                   class="article__share-btn article__share-btn--twitter"
                                   onclick="return pop_it_up('https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>');">
                                    Twitter
                                </a>
                            </li>
                            <li>
				<?php echo do_shortcode('[whatsapp]'); ?>
                            </li>
                            <li>
                                <a href="javascript:void(0);" 
                                   class="article__share-btn article__share-btn--reddit"
                                   onclick="return pop_it_up('http://www.reddit.com/submit?url=<?php the_permalink(); ?>/&newwindow=1');">

                                </a>
                            </li>
                        </ul>
                    </div>

		    <!-- Next article link starts -->
                    <!--<div class="article__next-link">
                        <?php //next_post_link( '%link', 'Next', TRUE ); ?>
                     </div>		-->
<!-- Addded on Nov23-2015-->
<!--<div id="prizelDiv">
<script type="text/javascript">
Prizel_Embed.cmd.push(function(){
//Partner Name is HelloU
var prizel_settings = {
minHeight: 600,
minWidth: 150,
maxHeight: 600,
partnerID: "563bef7d-3d88-4d2b-bce4-3a886ee8708e",
driver:true,
driverLayout: "horizontal",
iframeID: "prizel_embed_widget"
};
Prizel_Embed.load_prizel(prizel_settings , "prizelDiv");
});
</script>
</div>-->

<!-- /89562919/sharethrough -->

<!-- /89562919/sharethrough -->
<div id='div-gpt-ad-1450193824055-0' style='height:1px; width:1px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1450193824055-0'); });
</script>
</div>  


<!-- Rev content-->

<div id="rcjsload_ced8b8"></div>
<script type="text/javascript">
(function() {
var rcel = document.createElement("script");
rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
rcel.type = 'text/javascript';
rcel.src = "http://trends.revcontent.com/serve.js.php?w=14969&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
rcel.async = true;
var rcds = document.getElementById("rcjsload_ced8b8"); rcds.appendChild(rcel);
})();
</script>


            <script>
                /* Starts - Taboola Integration */
                window._taboola = window._taboola || [];
                _taboola.push({article: 'auto'});
                !function (e, f, u) {
                    e.async = 1;
                    e.src = u;
                    f.parentNode.insertBefore(e, f);
                }(document.createElement('script'), document.getElementsByTagName('script')[0], 'http://cdn.taboola.com/libtrc/hellou/loader.js');
                /* Ends - Taboola Integration */
            </script>
            <!-- Taboola Starts here -->
            <div class="taboola">
                <div id='taboola-below-main-column'></div>
                <script type="text/javascript">
                    window._taboola = window._taboola || [];
                    _taboola.push({mode: 'thumbs-2r', container: 'taboola-below-main-column', placement: 'below-main-column'});
                </script>
                <script type="text/javascript">
                    window._taboola = window._taboola || [];
                    _taboola.push({flush: true});
                </script>
            </div>
            <!-- Taboola Ends here -->
<!--            </noscript>
        </div>-->


<!--commented and added in header.php-->
<?php// if ( !$detect->isMobile() && $detect->isTablet()) { ?>
<!-- Tablet Interstitial -->

<!-- Tablet Interstitial Stag (live)  -->
<!--<div id="VX-900119660" data-tagid="900119660">
<noscript>


</noscript>
</div>-->
                <?php // }  ?>


                    <!-- Facebook Comments Starts -->
<!--		<div id="fb-root"></div>
                <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                <fb:comments href="<?php // echo the_permalink(); ?>" numposts="5"></fb:comments>                  
                    <!-- Facebook Comments Ends  -->
                </div>-->
                <?php
//end of loop
            endwhile;
            ?>
            <div class="article--content-leads">
                <a href="<?php echo get_category_link($primary_cat); ?>" 
                   class="btn btn--block btn--arrow btn--icon  btn--<?php echo get_nav_class($cat_name); ?>" id='trending_pagination_next' data-page=2 data-post-id=<?= $displayed; ?>>
                    Latest Posts in <?php echo $cat_name; ?>
                </a>

                <div class="popular-cards" id='popular-trend-block' >
                    <?php
                    $counts = 1;
                    $shareCount = array();
                    $r_post_ids = array();
                    $posts = array();
                    $q_arg = array('cat' => $primary_cat,
                        'post__not_in' => array($displayed),
			'category__not_in'=>'-1',
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC');
                    query_posts($q_arg);
                    while (have_posts()):
                        the_post();
                        $post = get_post();
                        $posts[] = $post;
                    endwhile;

// Display Posts
                    if (count($posts)) {
                        // Start the loop.
                        foreach ($posts as $singlePost) {

                            $shareCount = getShareCount($singlePost->ID); // Get FB share count
                            if ($counts > 4) {
                                break;
                            }
                            $counts++;

                            require("content.php");
                            $content_file && require( $content_file );
                            $singlePost = null;
                        }
                    } else {
                        get_template_part('content', 'none');
                    }
                    ?>
                                    
                                     
                    <?php  if ( $detect->isMobile() ) {  ?>
                    <div id="VX-400630388" data-tagid="400630388" class="float-center">
                    <noscript>

                    <script class="mobfoxConfig" src="http://my.mobfox.com/ad_sdk.js?cb=CACHEBUSTER&referrer=REFERRER_URL&width=300&height=250&invh=7c5654bd366c7929e0a6d6944307c924&type=banner&passback=%3Cscript%20src%3D%22http%3A%2F%2Fuk.cdn.viewex.co.uk%2Finserver.min.js%22%3E%3C%2Fscript%3E%0D%0A%3Ciframe%20style%3D%22display%3Anone%22%20onload%3D%22window.top.Viewex.passback(this)%22%3E%3C%2Fiframe%3E"></script>
                    </noscript>
                    </div>
                <?php  }  ?>


            </div>

            <a href="<?php echo get_site_url(); ?>" class="btn btn--block btn--icon btn--arrow btn--top-stories">See All Top Stories</a>
        </div>             
           
    </div>
         <div class="secondary-column">   
                <?php require( 'article-ad.php' ); ?>
            </div>
</div>
    </div>


<?php get_footer(); ?>

