<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends Application
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        public function index() {
            $result = '';
            $oddrow = true;
            foreach ($this->Categories->all() as $category) {
                $category->direction = ($oddrow ? 'left' : 'right');
                $result .= $this->parser->parse('category-home', $category, true);
                $oddrow = ! $oddrow;
            }
            $this->data['content'] = $result;
            $this->render();
        }
        function render($template = 'template')
        {
            $this->data['navbar'] = $this->parser->parse('navbar', $this->data, true);
            // use layout content if provided
            if (!isset($this->data['content']))
                $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
            $this->parser->parse($template, $this->data);
        }
}