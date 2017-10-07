<?php
listCheckout($categoryTree, $selectId);

function listCheckout(array $categories, array $selectId)
{
    foreach($categories as $category){
        if($category['level'] > 0){
            $line = str_repeat('-', $category['level']);
        } else {
            $line = '';
        }
        $title = $line . $category['description']['title'];

        $value = $category['id'];

        if(!empty($selectId) && in_array($category['id'], $selectId)){
            $selected = 'checked';
        } else {
            $selected = '';
        }

        printf(' <input type="checkbox" name="categories[]" value="%2$d" %3$s />%1$s ', $title, $value, $selected);
        if(isset($category['subcategories'])){
            listCheckout($category['subcategories'], $selectId);
        }
    }
}
?>
