<?php
    require_once "fa_css_to_json.php";

    if( isset($_GET['lang']) ) {
        switch ($_GET['lang']) {
            case 'en':
                $lang = 'en';
            break;
            case 'ru':
                $lang = 'ru';
            break;
            default:
            $lang = 'en';
        break;
    }
} else $lang = 'en';

$text = json_decode( file_get_contents("json/text.json") );
// var_dump_pre( $json );
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <title><?php echo $text->title->$lang; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $text->description->$lang; ?>" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
	
	<meta name="yandex-verification" content="ac7b969ad6029368" />
	<!-- Yandex.Metrika counter -->
		<script type="text/javascript" >
		   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
		   (window, document, "script", "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js", "ym");

		   ym(62278579, "init", {
				clickmap:true,
				trackLinks:true,
				accurateTrackBounce:true,
				webvisor:true
		   });
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/62278579" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</head>

<body>
    <header>
        <h1 class="icons-table-title"><?php echo $text->h1->$lang; ?></h1>
        <div class="language">
            <a href="./"><img class="lang-flag" src="img/en.svg" alt=""></a>
            <a href="./?lang=ru"><img class="lang-flag" src="img/ru.svg" alt=""></a>
        </div>
    </header>

    <section class="section-link">
        <h2><?php echo $text->heading_add_link->$lang; ?>:</h2>
        <div class="notice"><?php echo $text->click_to_copy->$lang; ?>:</div>
        <a href="#" title="<?php echo $text->copy_to_clipboard->$lang; ?>" id="fa-link" onclick=copyToClipboard(this,false)>
            &lt;link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"&gt;
        </a>
    </section>
    <section class="section-tag-select">
        <h2><?php echo $text->heading_choose_tag->$lang; ?>:</h2>
        <div id="tag-select" class="notice">
            <form class="form-tag-select">
                <div class="form-tag-select-item">
                    <input id="input-radio-1" name="tag" type="radio" value="i" onclick="setTag(this)" checked>
                    <label for="input-radio-1">&lt;i&gt;</label>
                </div>
                <div class="form-tag-select-item">
                    <input id="input-radio-2" name="tag" type="radio" value="span" onclick="setTag(this)">
                    <label for="input-radio-2">&lt;span&gt;</label>
                </div>
                <div class="form-tag-select-item">
                    <input id="input-radio-3" name="tag" type="radio" value="class-name" onclick="setTag(this)">
                    <label for="input-radio-3"><?php echo $text->tag_just_name->$lang; ?></label>
                </div>
            </form>
        </div>
    </section>
    <section>
        <h2><?php echo $text->heading_choose_icon->$lang; ?></h2>
        <div class="notice" style='margin-bottom:-0.5em; margin-top:0.5em;'><?php echo $text->click_on_item->$lang; ?>:</div>
    </section>
    <section class="icons-table">
<?php 
    // $json = file_get_contents("fonts/awesome.json");
    // $icons = json_decode($json,true)['icons'];

    $icons = fa_css_to_json();

    $items_number = count($icons);
    $columns_per_row = 3;
    $elements_per_column = round( $items_number / $columns_per_row, 0, PHP_ROUND_HALF_UP );
    // echo $elements_per_column." ";
    // echo count($icons);

    $i = 0;
    for( $column_id = 0; $column_id < $columns_per_row; $column_id++ ) {
        for( $j = 0; $j < $elements_per_column; $j++ )
            $icons_columns[$column_id][$j] = $icons[$i++];
    }


    foreach( $icons_columns as $column ) :
        $n_rows = round(count($column) / $columns_per_row, 0, PHP_ROUND_HALF_UP);
?>    
    
        <div class="icons-table-row" style="grid-template-rows: repeat(<?php echo $n_rows; ?>, 1fr);">
<?php
        foreach( $column as $item ) :
?>
            <div class="icons-table-item">
                <i class="fa <?php echo $item[1]; ?>"></i>
                <div title="<?php echo $text->copy_to_clipboard->$lang; ?>" class="icon-name" onclick="copyToClipboard(this)"><?php echo $item[1];?></div>
                <div title="<?php echo $text->copy_to_clipboard->$lang; ?>" class="icon-value" id="icon-value" onclick="copyToClipboard(this)">"\f<?php echo $item[2];?>"</div>
            </div>
<?php
        endforeach;
        echo "\n</div>\n";
        if( next($icons_columns) ) echo "\n<div class='divider'></div>\n";
    endforeach;
?>

    
    </section>
    <footer>
    &copy; Mansur Mamirov <?php echo date("Y"); ?>
    </footer>


</body>
</html>

<?php
    function var_dump_pre($var) {
        echo "\n<pre>\n";
        var_dump( $var );
        echo "\n</pre>\n";
    }
?>