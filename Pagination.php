<?php
function get_current_page_name() {




    $current_page_name = substr( $_SERVER["SCRIPT_NAME"], strrpos( $_SERVER["SCRIPT_NAME"],"/" ) + 1 );




    return $current_page_name;




}

function set_pagination( $total_num_of_records_we_are_going_to_fetch, $num_of_results_per_page = 50 ) {




    # $pagination() array is necessary for ( Pagination Bar )




    $pagination['current_page_name']       = get_current_page_name(); # get_current_page_name() is a user-defined function




    $pagination['first_page']              = 1;




    $pagination['current_page']            = empty( $_GET['page'] ) ? 1 : $_GET['page']; # If current page is empty (have no value) then make it equals to 1




    $pagination['next_page']               = $pagination['current_page'] + 1;




    $pagination['previous_page']           = $pagination['current_page'] - 1;




    $pagination['num_of_results_per_page'] = $num_of_results_per_page;




    $pagination['start_record']            = ( $pagination['current_page'] - 1 ) * $pagination['num_of_results_per_page'];









    # Determine last page number




    $pagination['last_page'] = ceil( $total_num_of_records_we_are_going_to_fetch / $pagination['num_of_results_per_page'] );









    # If there was no result then make the last page equals to 1




    if ( $pagination['last_page'] == 0 ) { $pagination['last_page'] = 1; }









    return $pagination;




}



?>