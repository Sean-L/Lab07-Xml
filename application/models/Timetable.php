<?php

class Timetable extends CI_Model {
    
    protected $xml = null;
    protected $courses = array();
    protected $days = array();
    protected $timeslots = array();
    
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'timetables.xml',"SimpleXMLElement", LIBXML_NOENT);
        
        //Add data to courses array
        foreach($this->xml->timeslots->courses as $course)
        {
           $classes = array();
           foreach($course->booking as $booking)
            {
                $data = new Booking($booking);
                array_push($classes, $data);
            } 
            $this->courses[$data->time] = $classes;
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
                $this->days[$data->time] = $classes;
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
            $this->timeslots[$data->time] = $classes;
        }
    }
    

    //Gets bookings based on Courseno
    public function getCourses()
    {
        return $this->courses;
    }
    
    //Gets bookings based on Day of week
    public function getDays()
    {
        return $this->days;
    }
    
    //Gets bookings based on Time Slot
    public function getTimeslots()
    {
        return $this->timeslots;
    }
    
    

    
}
class Booking extends CI_Model
{
    public $day = null;
    public $courseno = null;
    public $coursename = null;
    public $instructor = null;
    public $room = null;
    public $time = null;
    public $type = null;
    
    function __construct($class)
    {
        $this->day = (string) $class['day'];
        $this->courseno = (string) $class['courseno'];
        $this->couresname = (string) $class['coursename'];
        $this->instructor = (string) $class['instructor'];
        $this->room = (string) $class['room'];
        $this->time = (string) $class['time'];
        $this->type = (string) $class['type'];
        
    }
}