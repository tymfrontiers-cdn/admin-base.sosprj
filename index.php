<?php
namespace TymFrontiers;
use \Michelf\Markdown;
require_once "base.init.php";
$gen = new Generic;
$data = new Data;
$params = $gen->requestParam([
  "rdt" => ["rdt","url"]
],'get',[]);
if ($session->isLoggedIn()) {
  $rdt = empty($params["rdt"])
    ? WHOST . "/admin"
    : $params["rdt"];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" manifest="./site.webmanifest">
  <head>
    <meta>
    <title>Welcome | <?php echo PRJ_TITLE; ?></title>
    <?php include PRJ_INC_ICONSET; ?>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
    <meta name="keywords" content="<?php echo PRJ_KEYWORDS; ?>">
    <meta name="description" content="<?php echo PRJ_DESCRIPTION; ?>">
    <meta name="author" content="<?php echo PRJ_AUTHOR; ?>">
    <meta name="creator" content="<?php echo PRJ_CREATOR; ?>">
    <meta name="publisher" content="<?php echo PRJ_PUBLISHER; ?>">
    <meta name="robots" content='index'>
    <!-- Theming styles -->
    <link rel="stylesheet" href="./7os/font-awesome-soswapp/css/font-awesome.min.css">
    <link rel="stylesheet" href="./7os/theme-soswapp/css/theme.css">
    <link rel="stylesheet" href="./7os/theme-soswapp/css/theme-<?php echo PRJ_THEME; ?>.css">
    <!-- optional plugin -->
    <link rel="stylesheet" href="./7os/plugin-soswapp/css/plugin.css">
    <link rel="stylesheet" href="./7os/dnav-soswapp/css/dnav.min.css">
    <link rel="stylesheet" href="./7os/faderbox-soswapp/css/faderbox.css">
    <!-- Project styling -->
    <link rel="stylesheet" href="<?php echo \html_style("base.css"); ?>">
  </head>
  <body>
    <?php \setup_page("base", "base", 200, false); ?>
    <?php include PRJ_INC_HEADER; ?>
    <div id="main-content">
      <div class="view-space">
        <div class="grid-7-laptop">
          <div class="sec-div padding -p20 color face-primary">
            <?php if (\file_exists(PRJ_ROOT . "/src/inc-welcome-note.md")): ?>
              <?php echo Markdown::defaultTransform(\file_get_contents(PRJ_ROOT . "/src/inc-welcome-note.md")); ?>
            <?php endif; ?>
          </div>
        </div>
        <div class="grid-7-tablet grid-5-laptop push-right">
          <!-- <div class="padding -p20">&nbsp;</div> -->
          <div class="sec-div color face-secondary border -bthin">
            <header class="color-text padding -p20 border -bthin -bbottom">
              <span class="fa-stack fa-2x push-right color-text">
                <i class="far fa-stack-2x fa-circle"></i>
                <i class="fas fa-stack-1x fa-lock fa-sm"></i>
              </span>
              <h2>Sign in</h2>
              <br class="c-f">
            </header>
            <form
              id="long-form"
              class="block-ui padding -p20"
              method="post"
              action="/SignIn.php"
              data-path="/admin/src"
              data-domain="<?php echo WHOST;?>"
              data-validate="false"
              onsubmit="sos.form.submit(this, doLogin); return false;"
            >
              <input type="hidden" name="rdt" value="<?php echo !empty($params['rdt']) ? $params['rdt'] : ''; ?>">
              <input type="hidden" name="CSRF_token" value="<?php echo $session->createCSRFtoken('long-form'); ?>">
              <input type="hidden" name="form" value="long-form">
              <div class="grid-12-phone">
                <label for="email"> <i class="fas fa-asterisk fa-sm fa-border"></i> Email</label>
                <input type="email" placeholder="email@omain.ext" name="email" id="email" autocomplete="email" required>
              </div>
              <div class="grid-8-phone">
                <label for="password"> <i class="fas fa-asterisk fa-sm fa-border"></i> Password</label>
                <input type="password" placeholder="Login Password" name="password" id="password" autocomplete="off" required>
              </div>
              <div class="grid-4-phone">
                <br>
                <button type="submit" class="sos-btn face-primary"> <i class="fas fa-angle-double-right"></i> Login</button>
              </div>
              <br class="c-f">
            </form>
          </div>
        </div>

        <br class="c-f">
      </div>
    </div>

    <!-- page footer -->
    <?php include PRJ_INC_FOOTER; ?>

    <!-- Required scripts -->
    <script src="./7os/jquery-soswapp/js/jquery.min.js">  </script>
    <script src="./7os/js-generic-soswapp/js/js-generic.min.js">  </script>
    <script src="./7os/theme-soswapp/js/theme.min.js"></script>
    <!-- optional plugins -->
    <script src="/7os/plugin-soswapp/js/plugin.min.js"></script>
    <script src="/7os/dnav-soswapp/js/dnav.js"></script>
    <script src="/7os/faderbox-soswapp/js/faderbox.min.js"></script>
    <!-- project scripts -->
    <script src="<?php echo \html_script ("base.min.js"); ?>"></script>
    <script type="text/javascript">
      function doLogin(resp) {
        if( resp && ( resp.errors.length <= 0 || resp.status == "0.0") ){
          if ( resp.rdt.length > 0 ) {
            setTimeout(function(){ window.location = resp.rdt; },3200);
          } else {
            setTimeout(function(){ removeAlert(); },3200);
          }
        }
      }
    </script>
  </body>
</html>