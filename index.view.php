<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $current_lang ?>"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php echo $msg['page_title'] ?></title>
    <meta name="viewport" content="width=device-width">

    <style>article,aside,details,figcaption,figure,footer,header,hgroup,main,nav,section,summary{display:block}audio,canvas,video{display:inline-block;*display:inline;*zoom:1}audio:not([controls]){display:none;height:0}[hidden]{display:none}html{background:#fff;color:#000;font-size:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}html,button,input,select,textarea{font-family:sans-serif}body{margin:0}a:focus{outline:thin dotted}a:active,a:hover{outline:0}h1{font-size:2em;margin:.67em 0}h2{font-size:1.5em;margin:.83em 0}h3{font-size:1.17em;margin:1em 0}h4{font-size:1em;margin:1.33em 0}h5{font-size:.83em;margin:1.67em 0}h6{font-size:.67em;margin:2.33em 0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:bold}blockquote{margin:1em 40px}dfn{font-style:italic}hr{-moz-box-sizing:content-box;box-sizing:content-box;height:0}mark{background:#ff0;color:#000}p,pre{margin:1em 0}code,kbd,pre,samp{font-family:monospace,serif;_font-family:'courier new',monospace;font-size:1em}pre{white-space:pre;white-space:pre-wrap;word-wrap:break-word}q{quotes:none}q:before,q:after{content:'';content:none}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-0.5em}sub{bottom:-0.25em}dl,menu,ol,ul{margin:1em 0}dd{margin:0 0 0 40px}menu,ol,ul{padding:0 0 0 40px}nav ul,nav ol{list-style:none;list-style-image:none}img{border:0;-ms-interpolation-mode:bicubic}svg:not(:root){overflow:hidden}figure{margin:0}form{margin:0}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{border:0;padding:0;white-space:normal;*margin-left:-7px}button,input,select,textarea{font-size:100%;margin:0;vertical-align:baseline;*vertical-align:middle}button,input{line-height:normal}button,select{text-transform:none}button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer;*overflow:visible}button[disabled],html input[disabled]{cursor:default}input[type="checkbox"],input[type="radio"]{box-sizing:border-box;padding:0;*height:13px;*width:13px}input[type="search"]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}textarea{overflow:auto;vertical-align:top}table{border-collapse:collapse;border-spacing:0}html,button,input,select,textarea{color:#222}body{font-size:1em;line-height:1.4}::-moz-selection{background:#b3d4fc;text-shadow:none}::selection{background:#b3d4fc;text-shadow:none}hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}img{vertical-align:middle}fieldset{border:0;margin:0;padding:0}textarea{resize:vertical}.chromeframe{margin:.2em 0;background:#ccc;color:#000;padding:.2em 0}.ir{background-color:transparent;border:0;overflow:hidden;*text-indent:-9999px}.ir:before{content:"";display:block;width:0;height:150%}.hidden{display:none !important;visibility:hidden}.visuallyhidden{border:0;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.visuallyhidden.focusable:active,.visuallyhidden.focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}.invisible{visibility:hidden}.clearfix:before,.clearfix:after{content:" ";display:table}.clearfix:after{clear:both}.clearfix{*zoom:1}@media print{*{background:transparent !important;color:#000 !important;box-shadow:none !important;text-shadow:none !important}a,a:visited{text-decoration:underline}a[href]:after{content:" (" attr(href) ")"}abbr[title]:after{content:" (" attr(title) ")"}.ir a:after,a[href^="javascript:"]:after,a[href^="#"]:after{content:""}pre,blockquote{border:1px solid #999;page-break-inside:avoid}thead{display:table-header-group}tr,img{page-break-inside:avoid}img{max-width:100% !important}@page{margin:.5cm}p,h2,h3{orphans:3;widows:3}h2,h3{page-break-after:avoid}}</style>

    <link rel="stylesheet" media="(min-width: 55em)" href="<?php echo ROOT ?>/css/fonts.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/css/streaming.css">

    <meta name="description" content="<?php echo $msg['meta_content'] ?>" />
    <link rel="canonical" href="http://<?php echo DOMAIN . $languages[$current_lang]['url'] ?>" />
    <meta property="og:locale" content="<?php echo $languages[$current_lang]['code'] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $msg['page_title'] ?>" />
    <meta property="og:description" content="<?php echo $msg['meta_content'] ?>" />
    <meta property="og:url" content="<?php echo URL_SELF ?>" />
    <meta property="og:site_name" content="<?php echo $msg['meta_site_name'] ?>" />
    <meta property="fb:admins" content="<?php echo FB_ADMINS ?>" />
    <meta property="og:image" content="<?php echo FB_IMAGE ?>" />
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe"><?php echo $msg['chrome_frame'] ?></p>
    <![endif]-->

    <nav class="languages">
    <?php foreach ($languages as $code=>$l) : ?>
        <?php if ($current_lang != $code) : ?>
        <a href="<?php echo $l['url'] ?>" class="<?php echo $code ?>"><?php echo $l['name'] ?></a>
        <?php endif ?>
    <?php endforeach ?>
    </nav>

    <div class="main" itemscope itemtype="http://data-vocabulary.org/Event">

        <header>
            <h1 class="title">
                <a href="<?php echo URL_SELF ?>" itemprop="url" >
                    <span itemprop="summary"><?php echo $msg['title'] ?></span>
                </a>
            </h1>
            <h2 class="subtitle">
                <time class="start" itemprop="startDate" datetime="2014-06-01T17:00+01:00"><?php echo $msg['subtitle_start'] ?></time>
                <time class="end" itemprop="endDate" datetime="2014-06-01T19:30+01:00">Jun 01, 19:30PM</time>
                ·
                <span class="location" itemprop="location" itemscope itemtype="http://data-vocabulary.org/​Organization">
                    <span itemprop="name">Estadio de Mestalla, Valencia</span>
                    ​<span class="address" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
                        <span itemprop="street-address">Avenida de Suecia s/n</span>, 
                        <span itemprop="locality">Valencia</span>, 
                        <span itemprop="region">Comunitat Valenciana</span>
                    </span>
                    <span class="geo" itemprop="geo" itemscope itemtype="http://data-vocabulary.org/​Geo">
                        <meta itemprop="latitude" content="39.4745508" />
                        <meta itemprop="longitude" content="-0.3584336" />
                    </span>
                </span>
            </h2>
        </header>

        <p class="intro-text" itemprop="description"><?php echo $msg['intro_text'] ?></p>

        <section class="video-area">

            <?php if ($show['player']) : ?>
                <div class="player">

                <?php if ('livestream' == $config['player']) : ?>
                    <div class="livestream-player" id="livestream-player">
                        <iframe src="http://new.livestream.com/accounts/4698529/events/<?php echo $config['livestream_event'] ?>/player?width=640&height=360&autoPlay=false&mute=false" width="640" height="360" frameborder="0" scrolling="no"></iframe>
                    </div>
                <?php elseif ('mediterraneo' == $config['player']) : ?>
                    <iframe width="800" height="450" frameborder="0" marginheight="0px" marginwidth="0px" src="http://core.enetres.net/CoreV1/Share/489DDF7FE98241D19D8970314BC9D3EF021?ignoreCommentsBox=true&amp;rnd=0.38213229505345225"></iframe>
                <?php endif ?>

                </div>
            <?php endif ?>

            <?php if ($show['not_yet'] && !$config['general_disable']) : ?>
            <div class="warning" id="not-yet">
                <?php echo $msg['not_yet_title'] ?> (GMT <?php echo $time_offset_friendly ?>).
                <p id="local-time"></p>
            </div>
            <?php endif ?>

            <?php if ($show['finished']) : ?>
            <div class="warning finished" id="finished">
                <?php echo $msg['finished'] ?>
                <p class="diferido"><a href="<?php echo $config['external_url'] ?>"><?php echo $msg['watch_dvr'] ?></a></p>
            </div>
            <?php endif ?>

            <?php if ($config['general_disable']) : ?>
            <div class="warning error">
                <?php echo $msg['unavailable'] ?>
            </div>
            <?php endif ?>

        </section>

        <div class="down">
            <section class="other-channels">
                <h3><?php echo $msg['other_media'] ?></h3>

                <ul class="channels">
                    <li><a target="_blank" rel="nofollow" class="tvmediterraneo" title="TV Mediterráneo" href="http://webtv.tvmediterraneo.es/"><span>TV Mediterráneo</span></a></li>
                    <li><a target="_blank" rel="nofollow" class="populartv" title="Popular TV Murcia" href="http://www.populartvrm.com/"><span>Popular TV Murcia</span></a></li>
                </ul>
            </section>

            <footer class="bottom-links">
                <a class="cnc" target="_blank" href="http://www.camminoneocatecumenale.it"><?php echo $msg['link_cnc'] ?></a>
            </footer>
        </div>

    </div>

    <script src="<?php echo ROOT ?>/js/zepto.min.js"></script>

    <script>

    Streaming = {};

    /**
     * Checks for message from the server (yes, it's pull)
     */
    Streaming.checkForMessage = function()
    {
        console.log("Checking for message...");

        $.ajax({
            url: "<?php echo ROOT ?>/message.json",
            cache: false,
            dataType: "json",
            success: function(message)
            {
                if (null != message && message.hasOwnProperty("action"))
                {
                    if (message.action == "reload")
                    {
                        console.log("Received reload message " + message.id + " @ " + new Date().toLocaleTimeString());

                        // Don't run twice the same message
                        if (window.location.hash != "#" + message.id)
                        {
                            console.log("Reloading...");
                            window.location = window.location.pathname + "#" + message.id;
                            location.reload();
                        }
                        else
                        {
                            console.log("Skipping reload");
                        }
                    }
                }
                else
                {
                    console.log("Received no message ID @ " + new Date().toLocaleTimeString());
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log("Error XHR: " + errorThrown + " @ " + new Date().toLocaleTimeString());
            }
        });
    }

    /**
     * Writes the event start time in the user's timezone
     */
    Streaming.writeLocalStartTime = function()
    {
        var htmlLocalTime,
            eventTimeUtc = new Date(),
            minutes;

        eventTimeUtc.setUTCFullYear(<?php echo gmdate('Y', MEETING_START) ?>);
        eventTimeUtc.setUTCMonth(<?php echo gmdate('m', MEETING_START) - 1 ?>);
        eventTimeUtc.setUTCDate(<?php echo gmdate('d', MEETING_START) ?>);
        eventTimeUtc.setUTCHours(<?php echo gmdate('H', MEETING_START) ?>);
        eventTimeUtc.setUTCMinutes(<?php echo gmdate('i', MEETING_START) ?>);

        if (new Date(<?php $config['event_start'] ?>).getTimezoneOffset() != <?php echo TIME_OFFSET ?>)
        {
            if (htmlLocalTime = document.getElementById("local-time"))
            {
                minutes = (eventTimeUtc.getMinutes() < 10) ? "0" + eventTimeUtc.getMinutes() : eventTimeUtc.getMinutes();
                htmlLocalTime.innerHTML = "<?php echo $msg['local_time'] ?>" + eventTimeUtc.getHours() + ":" + minutes + ".";
            }
        }
    }

    /**
     * Tracks an Analytics event if the page loaded because of a message
     */
    Streaming.eventTracking = function()
    {
        if (window.location.hash)
        {
            ga('send', 'event', 'messages', 'reload', window.location.hash);
        }
    }


    $(function() {
        Streaming.writeLocalStartTime();

<?php if ($config['enable_messages']) : ?>
        Streaming.eventTracking();
        setInterval(Streaming.checkForMessage, 30*1000);
<?php endif ?>

    });
    </script>

    <?php //if (!DO_NOT_TRACK) : ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-42284163-2', 'neocatechumenaleiter.org');
      ga('require', 'displayfeatures');
      ga('send', 'pageview');
    </script>
    <?php //endif ?>
</body>
</html>
