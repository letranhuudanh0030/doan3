<?php
function showCategories($categories, $category = null, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            if($category) {
                if($category->parent_id) {
                    $cate_id = $category->parent_id;
                } else {
                    $cate_id = $category->product_category_id;
                }

                if($cate_id == $item->id){
                    echo '<option value="'.$item['id'].'" selected>';
                        echo $char . $item['name'];
                    echo '</option>';
                } 
                else {
                    echo '<option value="'.$item['id'].'">';
                    echo $char . $item['name'];
                    echo '</option>';
                }
            } else {
                echo '<option value="'.$item['id'].'">';
                    echo $char . $item['name'];
                echo '</option>';
            }
             
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $category, $item['id'], $char.'|---');
        }
    }
}


function showTable($categories, $url_update = null, $url_remove = null, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            if(strlen($char) == 4){
                echo '<tr class="text-center row-'.$key.' table-success">';
            } else {
                echo '<tr class="text-center row-'.$key.'">';
            }
                echo '<td class="align-middle">'.$item->id.'</td>';
                echo '<td class="text-left align-middle">';
                    echo $char . $item['name'];
                echo '</td>';
                echo '<td>';
                    if($item->parent_id == 0) {
                        echo 'Loại cha';
                    } else {
                        echo $item->where('id', $item->parent_id)->first()->name;
                    }
                echo '</td>';
                echo '<td><img src="'.$_SERVER['SERVER_NAME']."/uploads/".$item->image.'" alt="'.$item->slug .'" width="50px" height="50px"></td>';
                echo '<td class="align-middle"><input type="text" value="'.$item->sort_order.'" class="input-sort sort-order-'.$key.'" data-name="sort_order" data-id="'.$item->id.'" data-url="'.$url_update.'"></td>';
                echo '<td class="align-middle">';
                    echo '<a href="void:javascript(0)" class="publish">';
                        if($item->publish == 1){
                            echo '<i class="fas fa-check text-success fa-lg publish-'.$key.'" data-value="1" data-id="'.$item->id.'" data-url="'.$url_update.'" data-name="publish"></i>';
                        } else {
                            echo '<i class="fas fa-times text-danger fa-lg publish-'.$key.'" data-value="0" data-id="'.$item->id.'" data-url="'.$url_update.'" data-name="publish"></i>';
                        }
                    echo '</a>';
                echo '</td>';
                echo '<td class="align-middle">';
                    echo '<a href="void:javascript(0)" class="highlight">';
                        if($item->highlight == 1){
                            echo '<i class="fas fa-check text-success fa-lg highlight-'.$key.'" data-value="1" data-id="'.$item->id.'" data-url="'.$url_update.'" data-name="highlight"></i>';
                        } else {
                            echo '<i class="fas fa-times text-danger fa-lg highlight-'.$key.'" data-value="0" data-id="'.$item->id.'" data-url="'.$url_update.'" data-name="highlight"></i>';
                        }
                    echo '</a>';
                echo '</td>';
                echo '<td class="align-middle">';
                    echo '<a href="void:javascript(0)" title="Xóa" class="mr-2 remove-'.$key.'" data-url="'.$url_remove.'" data-id="'.$item->id.'"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>';
                    echo '<a href="'.route('product_category.edit', $item->id).'" title="Cập nhật"><i class="fas fa-edit fa-lg text-warning"></i></a>';
                echo '</td>';
            echo '</tr>';
             
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showTable($categories, $url_update, $url_remove, $item['id'], $char.'|---');
        }
    }
}

function showMenu($categories, $parent_id = 0, $char = '', $stt = 0)
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ

    if ($cate_child)
    {
        $ul = '<ul class="navbar-sub-lv2">';
        $li = '<li class="nav-item-sub-lv2 text-left">';
        $a = '<a class="nav-link-sub-lv2"';
        $btn = '';
        if ($stt == 0){
            // là cấp 1
            $ul = '<ul class="navbar-nav recursive">';
            $li = '<li class="nav-item">';
            $a = '<a class="nav-link" style="display:inline-block;"';
            $btn = '<button data-toggle="collapse" data-target="#demo'.$item->id .'" style="display: inline-block;
            outline: none;
            border: none;
            color: white;
            background: transparent;
            float: right;
            font-size: 20px;
            padding-top: 5px;" class="d-block d-lg-none"><i class="fas fa-chevron-down"></i></button>';
        }
        else if ($stt == 1){
            // là cấp 2
            $ul = '<ul class="navbar-sub" id="demo'.$item->id .'" class="collapse">';
            $li = '<li class="nav-item-sub text-left">';
            $a = '<a class="nav-link-sub"';
        }
        else if ($stt == 2){
            // là cấp 3
            // $ul = '<ul class="navbar-sub-lv2">';
            // $li = '<li class="nav-item-sub-lv2 text-left">';
            // $a = '<a class="nav-link-sub-lv2"';
        }
        
        
        echo $ul;
        foreach ($cate_child as $key => $item)
        {
            // Hiển thị tiêu đề chuyên mục
            echo $li;
                echo $a .'href="'.route('shop', ['slug' => $item->slug, 'id' => $item->id]).'">'. $item['name'] . '</a>';
                echo $btn;
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showMenu($categories, $item['id'], $char.'|---', ++$stt);
            echo '</li>';

        }
        echo '</ul>';
    }
}