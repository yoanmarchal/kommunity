<?php

function get_the_date_event()
{
    global $post;
    $debdateTime = get_post_meta($post->ID, '_debut_date', true); //english format
    $debut_heure = get_post_meta($post->ID, '_debut_heure', true);
    $enddateTime = get_post_meta($post->ID, '_fin_date', true); //english format
    $fin_heure = get_post_meta($post->ID, '_fin_heure', true);
/*
    $debut_date =  isodate2fr($debdateTime); //format francais litteraire
    $fin_date	=  isodate2fr($enddateTime); //format francais litteraire
*/

    if ($debdateTime && $enddateTime) {
        echo '<h2>Date</h2>';
        echo '<ul class="no-style">';
        echo '<li><i class="icon-calendar"></i> <span class="date-time">Du <time itemprop="startDate" datetime="'.$debdateTime.'">'.$debdateTime.'</time><time datetime="'.$debut_heure.'"> à '.$debut_heure.' </time><br> ';
        echo 'au <time datetime="'.$enddateTime.'">'.$enddateTime.'</time><time itemprop="endDate" datetime="'.$enddateTime.'"> à '.$fin_heure.' </time></span></li>';
    } else {
        // pas de date saisie
    }
}
