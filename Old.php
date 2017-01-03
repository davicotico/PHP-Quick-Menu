<?php


if( ! function_exists('create_list')){
    function create_list(array $arrayItem, $id_parent = 0, $level = 0)
    {
        echo str_repeat("\t" , $level ),'<ul style="list-style: none" class="list-group">',PHP_EOL;
        foreach ( $arrayItem[$id_parent] as $id_item => $item)
        {
            if ($item['link']=="#"){
                echo str_repeat("\t" , $level + 1 ),'<li class="list-group-item">'.'<a href="'.BASE_URL.'menus/editItem/',$item['id'],'" title="Edit" class="link"><strong><span class="'.$item['icon'].'"></span> ',
                    $item['text'],'</strong></a>',PHP_EOL;
            } else{
            echo str_repeat("\t" , $level + 1 ),'<li >'
                    . '<a href="',BASE_URL.'menus/editItem/',$item['id'],'" title="Edit" class="link list-group-item"><span class="'.$item['icon'].'"></span> ',
                    $item['text'],'</a>',PHP_EOL;
            }
            if (isset( $arrayItem[$id_item] ) ){
                create_list($arrayItem , $id_item , $level + 2);
            }
            echo str_repeat("\t" , $level + 1 ),'</li>',PHP_EOL;
        }
        echo str_repeat("\t" , $level ),'</ul>',PHP_EOL;
    }
}

if( ! function_exists('ml_fillcombo')){
    function ml_fillcombo(array $arrayItem, $id_parent = 0, $level = 0)
    {
        foreach( $arrayItem[$id_parent] as $id_item => $item)
        {
            echo '<option value="'.$item['id'].'">'. str_repeat(" - " , $level ).$item['text'].'</option>';
            if(isset( $arrayItem[$id_item] ) )
            {
                ml_fillcombo($arrayItem , $id_item , $level + 1);
            }
        }
    }
}
if( ! function_exists('ml_json')){
    function ml_json(array $arrayItem, $id_parent = 0)
    {
        if(count($arrayItem)<=0){ 
            echo '[]';
        }else{
            $delimiter = '';
            echo '[';
            foreach($arrayItem[$id_parent] as $id_item => $item)
            {
                echo $delimiter.'{"id": "'.$item['id'].'", "text": "'.$item['text'],'" ';
                if(isset( $arrayItem[$id_item] ) )
                {
                    echo ', "children": ';
                    ml_json($arrayItem , $id_item);
                }
                echo '}';
                $delimiter=',';
            }
            echo ']';
        }
    }
}


 function ml_menubs(array $arrayItem, $id_parent = 0, $level = 0){
    if($id_parent==0)
	{
        echo '<ul class="nav navbar-nav">';
    }
	else
	{
        echo '<ul class="dropdown-menu">';
    }
    foreach( $arrayItem[$id_parent] as $id_item => $item)
    {
        if($id_parent==0){
            echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button">',$item['text'],' <span class="caret"></span></a>';
        }else{
            if($item['link']=='#'){
                echo '<li  class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown" role="button">',$item['text'],'</a>';
            }else{
                echo '<li><a href="',$item['link'],'">',$item['text'],'</a>';
            }
        }
        if( isset( $arrayItem[$id_item] ) ){
            create_menu($arrayItem , $id_item , $level + 1);
        }
        echo '</li>';
    }
    echo '</ul>';
}