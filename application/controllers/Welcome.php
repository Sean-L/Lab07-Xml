<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
      function __construct() {
        parent::__construct();
        $this->load->model('timetable');
    }
	public function index()
	{
		        
        $this->data['courses'] = $this->timetable->getCourses();
        $this->data['days'] = $this->timetable->getDays();
        $this->data['timeslots'] = $this->timetable->getTimeslots();    
       
       var_dump($this->data['courses']);
       var_dump($this->data['days']);
       var_dump($this->data['timeslots']);
        
        // Present the list to choose from
        $this->data['pagebody'] = 'homepage';
       // $this->render();

        $this->load->view('welcome_message');
	}
        
        

}
