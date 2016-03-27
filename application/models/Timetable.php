<?php

class Timetable extends CI_Model {
    
    protected $xml = null;
    protected $courses = array();
    protected $days = array();
    protected $timeslots = array();
    
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'timetables.xml');
        
        
        //Add data to courses array
        foreach($this->xml->timeslots->courses as $course)
        {
           $classes = array();
           foreach($course->booking as $booking)
            {
                $data = new Booking($booking);
                array_push($classes, $data);
            } 
            $this->courses[$data->start] = $classes;
        }
        
        //Add data to days array
        foreach($this->xml->days->dow as $dow)
            {
                $classes = array();
                foreach($dow->booking as $booking)
                {
                    $data = new Booking($booking);
                    array_push($classes, $data);
                }
                $this->days[$data->start] = $classes;
            }
        
        
        //Add data to timeslots array.
        foreach($this->xml->timeslots->time as $time)
        {
           $classes = array();
           foreach($time->booking as $booking)
            {
                $data = new Booking($booking);
                array_push($classes, $data);
                
            } 
            $this->timeslots[$data->start] = $classes;
        }
    }
}