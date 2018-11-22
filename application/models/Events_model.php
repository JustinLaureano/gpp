<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events_model extends CI_Model
{
    public function select_all()
    {
        $query = $this->db->query('SELECT events.*, candidates.name FROM events LEFT JOIN candidates ON events.candidateid = candidates.id WHERE events.cancel = 0 ORDER BY eventstart ASC');
        $data = $query->result();
        return $data;
    }

    public function get_event_by_id($eventid)
    {
        $this->db->select('events.*, 
            eventneeds.all, 
            eventneeds.doorknocking,
            eventneeds.callingfromhost,
            eventneeds.callingfromlocation,
            eventneeds.droppinglit,
            eventneeds.coordinateschedules,
            eventneeds.makingfood,
            eventneeds.waterandsunscreen'
        );
        $this->db->from('events');
        $this->db->join('eventneeds', 'eventneeds.eventid = events.id');
        $this->db->where('events.id', $eventid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_eventneeds_by_id($eventid)
    {
        $this->db->select('*');
        $this->db->from('eventneeds');
        $this->db->where('eventid', $eventid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_events($params)
    {
        if (isset($params['zip'])) {
            $zip_location = $this->get_lat_and_lon($params['zip']);
            // return $zip_location;
        }

        if (isset($params['radius'])) {
            if ($params['radius'] == 'state') {
                $radius = 200;
            }
            else {
                $radius = $this->get_radius($params['radius']);
            }
        }

        $sql = $this->set_select($zip_location, $radius);
        $sql .= $this->set_params($params);
        $sql .= $this->get_current();

        $query = $this->db->query($sql);
        $data = $query->result_array();

        return $data;
    }

    public function set_select($zip_location, $radius)
    {   
        $query_select = 'SELECT
        events.id,
        events.eventstart,
        events.eventend,
        events.address1,
        events.address2,
        events.city,
        events.state,
        events.zip,
        events.eventphone,
        events.eventemail,
        events.about,
        zip_wi.zipcode,
        zip_wi.location_text,
        eventneeds.all,
        eventneeds.doorknocking,
        eventneeds.callingfromhost,
        eventneeds.callingfromlocation,
        eventneeds.droppinglit,
        eventneeds.coordinateschedules,
        eventneeds.makingfood,
        eventneeds.waterandsunscreen,
        candidates.id AS candidate_id,
        candidates.name AS candidate_name,
        candidates.phone,
        candidates.email,
        candidates.hqaddress1,
        candidates.hqcity,
        candidates.hqstate,
        candidates.campaignmanager,
        candidates.politicalparty,
        candidates.racetitle,
        candidates.issueone,
        candidates.issuetwo,
        candidates.issuethree,
        candidates.website,
        candidates.imageurl
        FROM events
        LEFT JOIN zip_wi ON zip_wi.zipcode = events.zip
        LEFT JOIN eventneeds ON eventneeds.eventid = events.id
        LEFT JOIN candidates ON candidates.id = events.candidateid
        WHERE (3958*3.1415926*sqrt((Latitude-(' . $zip_location[0]['latitude'] . '))*(Latitude-(' . $zip_location[0]['latitude'] . ')) + cos(Latitude/57.29578)*cos((' . $zip_location[0]['latitude'] . ')/57.29578)*(Longitude-(' . $zip_location[0]['longitude'] . '))*(Longitude-(' . $zip_location[0]['longitude'] . ')))/180) <=' . $radius;
        return $query_select;
    }

    public function set_params($params)
    {
        $query_params = array();

        if (isset($params['alloptions']) && $params['alloptions'] == 'on') {
            return '';
        }
        else {
            // Go through each param and add to sql if turned on
            if ($params['doorknocking'] == 'on') {
                $doorknocking = 'eventneeds.doorknocking = 1';
                array_push($query_params, $doorknocking);
            }
            if ($params['callingfromhost'] == 'on') {
                $callingfromhost = 'eventneeds.callingfromhost = 1';
                array_push($query_params, $callingfromhost);
            }
            if ($params['callingfromlocation'] == 'on') {
                $callingfromlocation = 'eventneeds.callingfromlocation = 1';
                array_push($query_params, $callingfromlocation);
            }
            if ($params['droppinglit'] == 'on') {
                $droppinglit = 'eventneeds.droppinglit = 1';
                array_push($query_params, $droppinglit);
            }
            if ($params['coordinateschedules'] == 'on') {
                $coordinateschedules = 'eventneeds.coordinateschedules = 1';
                array_push($query_params, $coordinateschedules);
            }
            if ($params['makingfood'] == 'on') {
                $makingfood = 'eventneeds.makingfood = 1';
                array_push($query_params, $makingfood);
            }
            if ($params['waterandsunscreen'] == 'on') {
                $waterandsunscreen = 'eventneeds.waterandsunscreen = 1';
                array_push($query_params, $waterandsunscreen);
            }
        }
         
        $query_string = '';
        if (count($query_params) == 0) {
            return '';
        }
        else if (count($query_params) == 1) {
            $query_string = $query_params[0];
            return ' and ' . $query_string;
        }
        else if (count($query_params) > 1) {
            for ($i = 0; $i < count($query_params); $i++) {
                if ($i == 0) {
                    $query_string .= $query_params[$i];
                }
                else {
                    $query_string .= ' or ' . $query_params[$i];
                }
            }
            return ' and (' . $query_string . ')';
        }
        else { return ''; }
    }

    public function get_current()
    {
        $query_string = ' AND progressive.events.cancel = 0
        AND progressive.candidates.cancel = 0
        GROUP BY progressive.events.zip
        ORDER BY events.eventstart ASC
        ;';

        return $query_string;
    }

    public function get_lat_and_lon($zipcode)
    {
        $query = $this->db->query('SELECT zipcode, latitude, longitude, location_text FROM zip_wi WHERE ' . $zipcode . ' = zip_wi.zipcode');
        $data = $query->result_array();
        return $data;
    }

    public function get_radius($radius)
    {   
        switch($radius) {
            case '0 - 10 miles':
                $range = 10;
                break;
            case '20 miles':
                $range = 20;
                break;
            case '50 miles':
                $range = 50;
                break;
            case 'Entire State':
                $range = 100;
                break;
            default:
                $range = 20;
                break;
        }
        return $range;
    }

    public function create($input)
    {
        $input['eventstart'] = $input['eventstart'] . ' ' . $input['eventstarttime'];
        $input['eventend'] = $input['eventend'] . ' ' . $input['eventendtime'];
        unset($input['eventstarttime']);
        unset($input['eventendtime']);

        if ($input['alloptions'] === 'on') {
            $input['alloptions'] = 1;
            $input['doorknocking'] = 1;
            $input['callingfromhost'] = 1;
            $input['callingfromlocation'] = 1;
            $input['droppinglit'] = 1;
            $input['coordinateschedules'] = 1;
            $input['makingfood'] = 1;
            $input['waterandsunscreen'] = 1;

        }
        else {
            $input['alloptions'] = 0;
            $input['doorknocking'] = $input['doorknocking'] == 'on' ? 1 : 0;
            $input['callingfromhost'] = $input['callingfromhost'] == 'on' ? 1 : 0;
            $input['callingfromlocation'] = $input['callingfromlocation'] == 'on' ? 1 : 0;
            $input['droppinglit'] = $input['droppinglit'] == 'on' ? 1 : 0;
            $input['coordinateschedules'] = $input['coordinateschedules'] == 'on' ? 1 : 0;
            $input['makingfood'] = $input['makingfood'] == 'on' ? 1 : 0;
            $input['waterandsunscreen'] = $input['waterandsunscreen'] == 'on' ? 1 : 0;
        }

        $event_input = array(
            'candidateid' => $input['candidate'],
            'eventname' => $input['eventname'],
            'eventstart' => $input['eventstart'],
            'eventend' => $input['eventend'],
            'address1' => $input['address1'],
            'address2' => $input['address2'],
            'city' => $input['city'],
            'state' => $input['state'],
            'zip' => $input['zip'],
            'eventphone' => $input['eventphone'],
            'eventemail' => $input['eventemail'],
            'about' => $input['about'],
            'createdat' => date('Y-m-d H:i:s'),
            'cancel' => 0
        );
        $query = $this->db->insert('events', $event_input);

        $eventneeds_input = array(
            'eventid' => $this->db->insert_id(),
            'all' => $input['alloptions'],
            'doorknocking' => $input['doorknocking'],
            'callingfromhost' => $input['callingfromhost'],
            'callingfromlocation' => $input['callingfromlocation'],
            'droppinglit' => $input['droppinglit'],
            'coordinateschedules' => $input['coordinateschedules'],
            'makingfood' => $input['makingfood'],
            'waterandsunscreen' => $input['waterandsunscreen']
        );
        $query2 = $this->db->insert('eventneeds', $eventneeds_input);

        if ($query && $query2) {
            $success_msg = 'Event added Successfully.';
            return $success_msg;
        }
        else {
            $errors = ['error' => 'Event not added Successfully.'];
            $this->load->admin_template('admin/add_event', ['errors' => $errors, 'input' => $input]);
        }
    }

    public function update($event)
    {
        $event_input = array();
        $eventneeds_input = array();

        foreach ($event as $key => $value) {
            if ($key == 'eventname' ||
                $key == 'candidateid' ||
                $key == 'eventstart' ||
                $key == 'eventend' ||
                $key == 'address1' ||
                $key == 'address2' ||
                $key == 'city' ||
                $key == 'state' ||
                $key == 'zip' ||
                $key == 'eventphone' ||
                $key == 'eventemail' ||
                $key == 'about') 
            {
                $event_input[$key] = $value;
            }
            else if ($key == 'all' ||
                    $key == 'doorknocking' ||
                    $key == 'callingfromhost' ||
                    $key == 'callingfromlocation' ||
                    $key == 'droppinglit' ||
                    $key == 'coordinateschedules' ||
                    $key == 'makingfood' ||
                    $key == 'waterandsunscreen') 
            {
                $eventneeds_input[$key] = $value;
            }
        }
        $this->db->set($event_input);
        $this->db->where('id', $event['id']);
        $query = $this->db->update('events');

        $this->db->set($eventneeds_input);
        $this->db->where('eventid', $event['id']);
        $query2 = $this->db->update('eventneeds');

        if ($query && $query2) {
            $success_msg = 'Event Updated Successfully.';
            return $success_msg;
        }
        else {
            $errors = ['error' => 'Event not Updated Successfully.'];
            $this->load->admin_template('admin/edit_event/' . $event['id'], ['errors' => $errors, 'input' => $input]);
        }

    }

    public function delete_event($eventid)
    {
        $this->db->set('cancel', 1);
        $this->db->set('canceldate', date('Y-m-d H:i:s'));
        $this->db->set('canceluserid', $_SESSION['userid']);
        $this->db->where('id', $eventid);
        $query = $this->db->update('events');

        if ($query) {
            $success_msg = 'Event Deleted Successfully.';
            return $success_msg;
        }
        else {
            $error = 'Event Not Deleted Successfully.';
            return $error;
        }
    }
}