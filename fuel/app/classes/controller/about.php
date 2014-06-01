<?php

class Controller_Psihologu extends Controller_Public{
    
    
    public function action_index()
	{
		$this->template->title = "Psihologu pakalpojumi";
		$this->template->content = View::forge('psihologu/index');
	}
    
}
