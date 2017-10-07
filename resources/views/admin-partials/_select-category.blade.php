<?php
    if (!function_exists('selectOptions')) {
        function selectOptions(array $categories, $selectId)
        {
            if(is_int($selectId)){
                $selectId = array($selectId);
            } elseif (!is_array($selectId)){
                return;
            }

            foreach($categories as $category){
                if($category['level'] > 0){
                    $line = str_repeat('-', $category['level']);
                } else {
                    $line = '';
                }
                $title = $line . $category['description']['title'];

                $value = $category['id'];

                if(!empty($selectId) && in_array($category['id'], $selectId)){
                    $selected = 'selected';
                } else {
                    $selected = '';
                }

                printf('<option %3$s value="%2$d">%1$s</option>', $title, $value, $selected);
                if(isset($category['subcategories'])){
                    selectOptions($category['subcategories'], $selectId);
                }
            }
        }
    }

    selectOptions($categoryTree, $selectId);
?>
