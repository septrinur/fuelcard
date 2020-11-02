<?php
class MY_Loader extends CI_Loader {
    public function Admin($content, $vars = array(),$return = FALSE) {
		$data['main_content'] = $this->view($content,$vars, TRUE);
		$content_view  = $this->view('theme/admin',$data);
        if ($return)
        {
            return $content_view;
        }
	}

    public function Landing($content, $vars = array(),$return = FALSE) {
        $data['main_content'] = $this->view($content,$vars, TRUE);
        $content_view  = $this->view('theme/landing',$data);
        if ($return)
        {
            return $content_view;
        }
    }

	public function Excel($content, $vars = array(),$return = FALSE) {
		$data['main_content'] = $this->view($content,$vars, TRUE);
		$content_view  = $this->view('theme/excel',$data);
        if ($return)
        {
            return $content_view;
        }
	}
    // public function Print($content, $vars = array(),$return = FALSE) {
    //     $data['main_content'] = $this->view($content,$vars, TRUE);
    //     $content_view  = $this->view('theme/print',$data);
    //     if ($return)
    //     {
    //         return $content_view;
    //     }
    // }
}
?>