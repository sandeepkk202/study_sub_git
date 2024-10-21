<?php

# The steps mentioned below should help in enabling query log in Laravel:
    // DB::connection()->enableQueryLog();
    // Post query, place it
    // $querieslog = DB::getQueryLog();
    // Then, place it
    // dd($querieslog);