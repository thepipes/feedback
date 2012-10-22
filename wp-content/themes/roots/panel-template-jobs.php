<?php
/*
* TEMPLATE PART: panel-template-jobs
* DESCRIPTION: reusable panel section of job listings
*/
?>
<div class="row panel-container">

  <div class="panel-wrapper panel-wrapper-full grid12 raised">
    <div class="panel panel-full">

      <div class="row jobs-content">
        <div class="grid8">
          <?php if (have_posts()) : while (have_posts()) : the_post();?>
          <?php the_content(); ?>
          <?php endwhile; endif; ?>
          <?php 
          // REMOVE JOBVITE AFTER MICROSOFT ACQUISITION 
          /* 
          <div id='jobs-iframe'>
            <!-- BEGIN JOBVITE CODE -->
            <iframe id="jobviteframe" allowtransparency="true" src="https://hire.jobvite.com/CompanyJobs/Jobs.aspx?c=qI19Vfwx&jvresize=<?php echo get_template_directory_uri() ?>/js/jobvite_frameresize.html" width="100%" height="500px" scrolling="no" frameborder="0">Sorry, iframes are not supported.</iframe>
            <script type="text/javascript">
              var l = location.href;
              var args = '';
              var k = '';
              var iStart = l.indexOf('?jvk=');

              if (iStart == -1) iStart = l.indexOf('&jvk=');
              if (iStart != -1) {
                iStart += 5;
                var iEnd = l.indexOf('&', iStart);
                if (iEnd == -1) iEnd = l.length;
                k = l.substring(iStart, iEnd);
              }

              iStart = l.indexOf('?jvi=');
              if (iStart == -1) iStart = l.indexOf('&jvi=');
              if (iStart != -1) {
                iStart += 5;
                var iEnd = l.indexOf('&', iStart);
                if (iEnd == -1) iEnd = l.length;
                args += '&j=' + l.substring(iStart, iEnd);
                if (!k.length) args += '&k=Job';
                var iStart = l.indexOf('?jvs=');
                if (iStart == -1) iStart = l.indexOf('&jvs=');
                if (iStart != -1) {
                  iStart += 5;
                  var iEnd = l.indexOf('&', iStart);
                  if (iEnd == -1) iEnd = l.length;
                  args += '&s=' + l.substring(iStart, iEnd);
                }
              }
              if (k.length) args += '&k=' + k;
              if (args.length) document.getElementById('jobviteframe').src += args;

              function resizeFrame(height, scrollToTop) {
                var scrollToTop = false;
                if (scrollToTop) window.scrollTo(0, 0);
                var oFrame = document.getElementById('jobviteframe');
                if (oFrame) oFrame.height = height;
              }
            </script>
            <!--END JOBVITE CODE -->
          </div>
          */ ?>
        </div>

        <div class="grid4">
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Jobs Sidebar')) : ?>
          no widgets
          <?php endif; ?>
        </div>
      </div>

      <div class="warp"></div>
    </div>
  </div>
</div>