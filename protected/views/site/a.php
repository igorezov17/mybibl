<?php namespace DoingThings;

class ThingDoer{
    private $secret;

public function doThings($somevar=''){
    if ($somevar==''){
	$somevar='not the other var';
    }

    return $somevar;
}}