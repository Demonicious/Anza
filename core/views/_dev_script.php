<?php $log = array_slice($GLOBALS['load_log'], 3) ?>
<script type="text/javascript" id="Anza-dev-log">
    console.group('<?php echo NAME ?> Development Information & Log Script');
    console.log("%c<?php echo NAME . ' ' . VERSION ?> - Development Mode", "color: rgb(34, 215, 232); font-family: sans-serif; font-size: 4.5em; font-weight: bolder; text-shadow: #000 1px 1px;");
    console.log('This script is only enabled in the Development Environment of the Framework.');
    console.log('It shows useful statistics, loading and request related data. Development Tools are not the current focus and will improve in the future.');
    console.info('%cApplications usually run slower in Development mode because of overhead. Your app will run faster in Production mode.', 'color: red;')
    console.warn('If this is not properly formatted for you, Please refresh the page while keeping the Console Open.')
    console.groupEnd();
    console.group('Page Load Info');
    console.log('%c[STATS]: The page finished rendering in: <?php echo $time_taken ?> Sec.', 'color:#4ca960');
    console.log('[ROUTE]:', JSON.parse('<?php echo $route_info ?>'))
    console.groupEnd();
    console.group('Loader Log - Core Elements are Not Shown');
    <?php foreach($log as $item) { ?>
        console.group('<?php echo $item['type'] ?>');
        console.log('<?php echo addslashes($item['name']) ?>');
        console.log('Backtrace: ', JSON.parse('<?php echo addslashes($item['complete']) ?>'));
        console.groupEnd();
    <?php } ?>
    console.groupEnd();
</script>