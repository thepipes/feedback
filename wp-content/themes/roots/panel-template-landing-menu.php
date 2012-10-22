<?php
global $marketo_form_mb;
$title = $marketo_form_mb->get_the_value('form-title');
$subtitle = $marketo_form_mb->get_the_value('form-subtitle');
$firstname = $marketo_form_mb->get_the_value('form-first-name');
$lastname = $marketo_form_mb->get_the_value('form-last-name');
$email = $marketo_form_mb->get_the_value('form-email');
$emailPlaceholder = $marketo_form_mb->get_the_value('form-email-placeholder');
$company = $marketo_form_mb->get_the_value('form-company');
$companyPlaceholder = $marketo_form_mb->get_the_value('form-company-placeholder');
$country = $marketo_form_mb->get_the_value('form-country');
$countryPlaceholder = $marketo_form_mb->get_the_value('form-country-placeholder');
$phone = $marketo_form_mb->get_the_value('form-phone');
$phonePlaceholder = $marketo_form_mb->get_the_value('form-phone-placeholder');
$requiredFields = $marketo_form_mb->get_the_value('form-required-fields');
$button = $marketo_form_mb->get_the_value('form-submit-button');
$buttonWait = $marketo_form_mb->get_the_value('form-submit-wait');
$error1 = $marketo_form_mb->get_the_value('form-error-single');
$errorMany = $marketo_form_mb->get_the_value('form-error');
$thankyou = $marketo_form_mb->get_the_value('form-thankyou-title');
$thankyouDescription = $marketo_form_mb->get_the_value('form-thankyou-description');
$teaser = $marketo_form_mb->get_the_value('form-footer-teaser');
$signup = $marketo_form_mb->get_the_value('form-footer-signup-text');

if($title == "")
  $title = __('GET THE REPORT NOW', 'roots');
if($subtitle == "")
  $subtitle =__("Fill out the form below to download the report", "roots");
if($firstname =="")
  $firstname = __("First Name", "roots");
if($lastname =="")
  $lastname = __("Last Name", "roots");
if($email =="")
  $email = __("Email Address", "roots");
if($emailPlaceholder =="")
  $emailPlaceholder = __("user@email.com", "roots");
if($company =="")
  $company = __("Company Name", "roots");
if($companyPlaceholder =="")
  $companyPlaceholder = __("XYZ Company", "roots");
if($country =="")
  $country = __("Country", "roots");
if($countryPlaceholder =="")
  $countryPlaceholder = __("United States", "roots");
if($phone =="")
  $phone = __("Phone Number", "roots");
if($phonePlaceholder =="")
  $phonePlaceholder = __("444-222-1111", "roots");
if($requiredFields =="")
  $requiredFields = __("Required Fields", "roots");
if($button =="")
  $button = __("Download Free Report", "roots");
if($buttonWait =="")
  $buttonWait = __("Please Wait...", "roots");
if($error1 =="")
  $error1 = __("You missed 1 field. It has been highlighted.", "roots");
if($errorMany =="")
  $errorMany = __("You missed %n fields. They have been highlighted.", "roots");
if($thankyou =="")
  $thankyou = __("Thank You", "roots");
if($thankyouDescription =="")
  $thankyouDescription = __("We have received your information. Your copy of the Forrester Wave report is now downloading. %a Click here %b if the download has not started.", "roots");
if($teaser =="")
  $teaser = __("Not on Yammer yet?", "roots");
if($signup =="")
  $signup = __("Sign up today.", "roots");




$showForm = true;
if(isset($_GET['ym'])){
  if($_GET['ym'] == 'mkt'){
    $pdfs = get_posts(array(
      'numberposts' => 1,
      'post_type' => 'attachment',
      'post_parent' => get_the_ID(),
      'post_mime_type' => 'application/pdf', // get attached PDFs only
      'output' => ARRAY_A));
    if (count($pdfs) > 0) {
      $url = '<a target="_blank" id="form-report-pdf" href="' . $pdfs[0]->guid .  '" >';
      $urlClosing = '</a>';
      $search = array('%a', '%b');
      $replace = array($url, $urlClosing);
      $subtitle = str_replace($search, $replace, $thankyouDescription) ;
    }
    else {
      if($thankyouDescription == ''){
        $subtitle = __("We have received your information. Check your email for your copy of the Forrester Wave Report.", "roots");
      }
      else {
        $subtitle = $thankyouDescription;
      }
    }
    $title = $thankyou;
    $showForm = false;
  }
}
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="row panel-container panel-last landing-menu-template">
  <div class="panel-wrapper-full grid12">
    <div class="panel panel-full panel-top">
      <div class="row">
        <div class="panel-left">
          <?php the_content(); ?>
        </div>

        <div class="panel-form-container">
          <div class="form-container">
            <div class="form-inner-container <?php if(!$showForm){ echo "thankyou"; } ?> clearfix" <?php if(!$showForm){ echo 'style="min-height:0;"'; }?>>

              <h2><?php echo $title; ?></h2>
              <p class="form-subtitle"><?php echo $subtitle; ?></p>
              <?php if($showForm){ ?>
              <div class="error"><span></span></div>
              <form class="lpeRegForm formNotEmpty" method="post" enctype="application/x-www-form-urlencoded" action="https://app-g.marketo.com/index.php/leadCapture/save" id="mktForm_1040" name="mktForm_1040">
                <fieldset>
                  <label for="FirstName">* <?php echo $firstname; ?></label>
                  <input class="required mktFormText mktFormString" name="FirstName" id="FirstName" type='text'  maxlength='255' tabIndex='1'  />
                  <label for="Email">* <?php echo $email; ?></label>
                  <input class="required email mktFormText mktFormEmail" name="Email" id="Email" type='text'  maxlength='255' tabIndex='3'placeholder="<?php echo $emailPlaceholder; ?>"/>
                  <label for="Country">* <?php echo $country; ?></label>
                  <input class="required mktFormText mktFormString" name="Country" id="Country" type='text' maxlength='255' tabIndex='5' placeholder="<?php echo $countryPlaceholder; ?>"/>
                </fieldset>
                <fieldset>
                  <label for="LastName">* <?php echo $lastname; ?></label>
                  <input class="required mktFormText mktFormString" name="LastName" id="LastName" type='text'   maxlength='255' tabIndex='2' />
                  <label for="Company">* <?php echo $company; ?></label>
                  <input class="required mktFormText mktFormString" name="Company" id="Company" type='text'   maxlength='255' tabIndex='4' placeholder="<?php echo $companyPlaceholder; ?>" />
                  <label for="Phone"><?php echo $phone; ?></label>
                  <input class="mktFormText mktFormPhone" name="Phone" id="Phone" type='text' maxlength='255' tabIndex='6' placeholder="<?php echo $phonePlaceholder; ?>"/>
                </fieldset>
                <fieldset>(*) <?php echo $requiredFields; ?></fieldset>
                <div class="form-divider"></div>
                <fieldset class="form-submit-container">
                  <button href='#' id='mktFrmSubmit' class="yj-btn yj-btn-disabled submit"><?php echo $button; ?></button>
                </fieldset>
                <span style="display:none;"><input type="text" name="_marketo_comments" value="" /></span>
                <input type="hidden" name="lpId" value="-1" />
                <input type="hidden" name="subId" value="116" />
                <input type="hidden" name="kw" value="" />
                <input type="hidden" name="cr" value="" />
                <input type="hidden" name="searchstr" value="" />
                <input type="hidden" name="lpurl" value="http://marketing.yammer.com/ForresterWave2012LandingPage.html?cr={creative}&kw={keyword}" />
                <input type="hidden" name="formid" value="1040" />
                <input type="hidden" name="returnURL" value="<?php echo get_permalink();?>?ym=mkt" />
                <input type="hidden" name="retURL" value="<?php echo get_permalink();?>?ym=mkt" />
                <input type="hidden" name="_mkt_disp" value="return" />
                <input type="hidden" name="_mkt_trk" value="" />
              </form>
              <?php }
                else {  ?>
                  <div class="form-divider"></div>
                  <div class="form-signup-container"><?php echo $teaser; ?> <a href="/signup"><?php echo $signup; ?></a></div>
                  <?php
                }
              ?>

            </div>
          </div>
          <div class="curved-bottom-shadow"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="submit-button-str" value="<?php echo $buttonWait; ?>" />
<input type="hidden" id="missing-fields1-str" value="<?php echo $error1; ?>" />
<input type="hidden" id="missing-fields-str" value="<?php echo $errorMany; ?>" />

<input type="hidden" id="missing-fields-str1" value="<?php _e('You missed', 'roots');?>" />
<input type="hidden" id="missing-fields-str2" value="<?php _e('fields. They have been highlighted', 'roots');?>" />
<?php endwhile; ?>
<?php endif; ?>