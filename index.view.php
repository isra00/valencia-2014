<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $current_lang ?>"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php echo $msg['page_title'] ?></title>
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="<?php echo ROOT ?>/css/normalize.main.min.css">
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
<body onload="init()">
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
            <div class="livestream-player <?php if ($show['streaming_now']) echo 'block' ?>" id="livestream-player">
                <iframe src="http://new.livestream.com/accounts/4698529/events/<?php echo $config['livestream_event'] ?>/player?width=640&height=360&autoPlay=false&mute=false" width="640" height="360" frameborder="0" scrolling="no"> </iframe>
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
                    <li><a target="_blank" class="tvmediterraneo" title="TV Mediterráneo" href="http://webtv.tvmediterraneo.es/"><span>TV Mediterráneo</span></a></li>
                    <li><a target="_blank" class="populartv" title="Popular TV Murcia" href=""><span>Popular TV Murcia</span></a></li>
                </ul>
            </section>

            <footer class="bottom-links">
                <a class="cnc" href="http://camminoneocatecumenale.it"><?php echo $msg['link_cnc'] ?></a>
            </footer>
        </div>

    </div>

    <?php if ($show['player']) : ?>
    <script>
    function init() {

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
                /** @todo Si la hora local es la misma, eliminar este mensaje */
                htmlLocalTime.innerHTML = "<?php echo $msg['local_time'] ?>" + eventTimeUtc.getHours() + ":" + minutes + ".";
            }
        }

        var checkDate = function() {
           var now = new Date();

           if (now >= eventTimeUtc)
            {
                document.getElementById("livestream-player").style.display = "block";
                document.getElementById("not-yet").style.display = "none";
            }
        };

        checkDate();

        setInterval(checkDate, 30*1000);
    };
    </script>
    <?php endif ?>

    <?php //if (!DO_NOT_TRACK) : ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-42284163-2', 'neocatechumenaleiter.org');
      ga('send', 'pageview');
    </script>
    <?php //endif ?>
</body>
</html>
