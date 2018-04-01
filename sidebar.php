 <?php
              $taxonomy     = 'product_cat';
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
            
              $args = array(
                     'taxonomy'     => $taxonomy,
                     'orderby'      => $orderby,
                     'show_count'   => $show_count,
                     'pad_counts'   => $pad_counts,
                     'hierarchical' => $hierarchical,
                     'title_li'     => $title,
                     'hide_empty'   => $empty
              );
             $all_categories = get_categories( $args );
             echo '<ul class="list-unstyled components">';
             foreach ($all_categories as $cat) {
                if($cat->category_parent == 0) {
                    $category_id = $cat->term_id;   
                    $args2 = array(
                            'taxonomy'     => $taxonomy,
                            'child_of'     => 0,
                            'parent'       => $category_id,
                            'orderby'      => $orderby,
                            'show_count'   => $show_count,
                            'pad_counts'   => $pad_counts,
                            'hierarchical' => $hierarchical,
                            'title_li'     => $title,
                            'hide_empty'   => $empty
                    );
                    $sub_cats = get_categories( $args2 );
                    if($sub_cats) {
                      echo '<li><a href="#DropDown'. $cat->term_id .'" data-toggle="collapse" aria-expanded="false">'. $cat->name .'</a></li>';
                      echo '<ul class="collapse list-unstyled" id="DropDown'. $cat->term_id .'">';
                        foreach($sub_cats as $sub_category) {
                            echo '<li><a href="'. get_term_link($sub_category->slug, 'product_cat') .'">'. $sub_category->name .'</a></li>';
                        }   
                       echo '</ul>'; 
                    }else{
                         echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>';
                    }
                }       
            }
            echo '</ul>';
        ?>
