<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>

</head>

    <body>
    <section class="icons-table">
        <h1 class="icons-table-title">Easy copy-past Font Awesome Icons</h1>
        <h2>Add into your "HEAD" tag this line:</h2>
        <div>Click to copy:</div>
        <a href="#copy" title="Copy to clipboard" id="fa-link" onclick=copyToClipboard(this,false)>
            &lt;link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"&gt;
        </a>

<?php 
    $json = file_get_contents("fonts/awesome.json");
    $icons = json_decode($json,true)['icons'];
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
        $n_rows = round(count($column) / 3, 0, PHP_ROUND_HALF_UP);
?>    
        <h2>Choose tag:</h2>
        <div id="tag-select">
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
                    <label for="input-radio-3">just class name</label>
                </div>
            </form>
        </div>

        <h2>Choose icon you need</h2>
        <div style='margin-bottom:-0.5em; margin-top:0.5em;'>Click on name or HEX to copy:</div>
        <div class="icons-table-row" style="grid-template-rows: repeat(<?php echo $n_rows; ?>, 1fr);">
<?php
        foreach( $column as $item ) :
?>
            <p class="icons-table-item">
                <i class="fa <?php echo $item['class'];?>"></i>
                <a href="#copy" title="Copy to clipboard" class="icon-name" onclick="copyToClipboard(this)"><?php echo $item['class'];?></a>
                <a href="#copy" title="Copy to clipboard" class="icon-value" onclick="copyToClipboard(this)">"\f<?php echo $item['utf'];?>"</a>
            </p>
<?php
        endforeach;
        echo "\n</div>\n";
    endforeach;
?>

    
</section>


</body>
</html>