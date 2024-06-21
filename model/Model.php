<?php

namespace model;

use core\DatabaseConnection;
use core\Request;
use core\Session;
use Exception;

class Model
{
    private $database;
    private $user_model;


    public function __construct()
    {
        $this->get_database_connection();
        $this->user_model = new User();
    }

    private function get_database_connection()
    {
        $database_connection = new DatabaseConnection(getenv('DB_HOST'), getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $this->database = $database_connection->get_connection();
    }


    public function get_all_users()
    {
        $query = "SELECT up.*, au.id AS user_id, au.username, au.approved, au.email, au.role
                  FROM app_users au JOIN user_profile up
                  ON au.id = up.user_id";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $users];
    }

    public function create_participant()
    {
        $request = Request::capture();

        $name = $request->input('name');
        $gender = $request->input('gendar');
        $district = $request->input('district');
        $county = $request->input('county');
        $sub_county = $request->input('sub-county');
        $village = $request->input('village');
        $dob = $request->input('dob');
        $age_group = $request->input('age-group');
        $hiv_status = $request->input('hiv-status');
        $schooling_status = $request->input('schooling-status');


        $query = "INSERT INTO paticipant(name, gender, district, county, subcounty, village, dob, age_group, hiv_status, schooling_status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssssssss", $name, $gender, $district, $county, $sub_county, $village, $dob, $age_group, $hiv_status, $schooling_status);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Participant saved successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function update_participant($id)
    {
        $request = Request::capture();

        $name = $request->input('name');
        $gender = $request->input('gendar');
        $district = $request->input('district');
        $county = $request->input('county');
        $sub_county = $request->input('sub-county');
        $village = $request->input('village');
        $dob = $request->input('dob');
        $age_group = $request->input('age-group');
        $hiv_status = $request->input('hiv-status');
        $schooling_status = $request->input('schooling-status');


        $query = "UPDATE paticipant SET name = ?, gender = ?, district = ?, county = ?, subcounty = ?, village = ?, dob = ?, age_group = ?, hiv_status = ?, schooling_status = ? WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssssssssi", $name, $gender, $district, $county, $sub_county, $village, $dob, $age_group, $hiv_status, $schooling_status, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Participant details updated successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else if ($stmt->affected_rows ==  0) {

            $response = ['message' => 'You did not change anything!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        }
        else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function get_participants()
    {
        $query = "SELECT * FROM paticipant WHERE enrolled = 'enrolled'";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }
    
    public function get_participant_details($id)
    {
        $query = "SELECT * FROM paticipant WHERE enrolled = 'enrolled' AND id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_assoc();

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function create_lesson()
    {
        $request = Request::capture();

        $name = $request->input('lesson-name');
        $description = $request->input('lesson-description');

        $query = "INSERT INTO lessons(lesson_name, description) VALUES(?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Lesson saved successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function update_lesson($id)
    {
        $request = Request::capture();

        $name = $request->input('lesson-name');
        $description = $request->input('lesson-description');
        

        $query = "UPDATE lessons SET lesson_name = ?, description = ? WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("sss", $name, $description, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Lesson updated successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);

        } else if ($stmt->affected_rows == 0) {

            $response = ['message' => 'You did not change anything!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function get_lessons()
    {
        $query = "SELECT * FROM lessons";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function get_lesson_details($id)
    {
        $query = "SELECT * FROM lessons WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_assoc();

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function create_event()
    {
        $request = Request::capture();

        $event_type = $request->input('event-type');
        $event_title = $request->input('event-title');
        $event_description = $request->input('event-description');
        $event_learning_outcomes = $request->input('event-learning-outcomes');
        $start_date = $request->input('start-date');
        $end_date = $request->input('end-date');

        $query = "INSERT INTO events(type, title, description, learning_outcomes, start_date, end_date) VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssss", $event_type, $event_title, $event_description, $event_learning_outcomes, $start_date, $end_date);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Event saved successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function update_event($id)
    {
        $request = Request::capture();

        $event_type = $request->input('event-type');
        $event_title = $request->input('event-title');
        $event_description = $request->input('event-description');
        $event_learning_outcomes = $request->input('event-learning-outcomes');
        $start_date = $request->input('start-date');
        $end_date = $request->input('end-date');

        $query = "UPDATE events SET type = ? , title = ?, description = ?, learning_outcomes = ?, start_date = ?, end_date = ? WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssssi", $event_type, $event_title, $event_description, $event_learning_outcomes, $start_date, $end_date, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Event updated successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else if ($stmt->affected_rows == 0) {

            $response = ['message' => 'You did not change anything!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function get_events()
    {
        $query = "SELECT * FROM events WHERE events.end_date > CURRENT_DATE";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function get_event_details($id)
    {
        $query = "SELECT * FROM events WHERE events.end_date > CURRENT_DATE AND events.id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_assoc();

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function create_material()
    {
        $request = Request::capture();

        $material_name = $request->input('item');
        $age_group = $request->input('age-group');
        $distribution_date = $request->input('distribution-date');
        $distribution_status = $request->input('distribution-status');
        $return_date = $request->input('return-date');
        $notes = $request->input('notes');

        $query = "INSERT INTO education_materials(material_name, target_age_group, distribution_date, status, return_date, notes) VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssss", $material_name, $age_group, $distribution_date, $distribution_status, $return_date, $notes);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Material saved successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function get_materials()
    {
        $query = "SELECT * FROM education_materials";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function get_encounters($id)
    {
        $query = "SELECT encounters.id, encounters.date, events.title, lessons.lesson_name, education_materials.material_name, encounters.service FROM encounters
        JOIN lessons ON lessons.id = encounters.lessons_attended
        JOIN events ON events.id = encounters.event_id
        JOIN education_materials ON education_materials.id = encounters.material_id
        WHERE participant_id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function update_record_status($table, $column, $value, $id)
    {
        $query = "UPDATE ? SET ? = ? WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('sssi', $table, $column, $value, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Record updated successfully'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } elseif ($stmt->affected_rows == 0) {

            $response = ['message' => 'Record Not Found'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function delete_record($id, $table)
    {
        $query = "DELETE FROM ? WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('si', $table, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Record removed successfully'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } elseif ($stmt->affected_rows == 0) {

            $response = ['message' => 'Record Not Found'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function create_progress_row()
    {
        $request = Request::capture();

        $participant_id = $request->input('participant-id');
        $event_id = $request->input('event');
        $lesson_attended = $request->input('lesson');
        $skills_attained = $request->input('skills');
        $hiv_status_check = $request->input('hiv-status');
        $self_sufficiency_check = $request->input('eligibility');

        $query = "INSERT INTO progress(participant_id, event_id, lesson_attended, skills_attained, hiv_status_check, self_sufficiency_check) VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssss", $participant_id, $event_id, $lesson_attended, $skills_attained, $hiv_status_check, $self_sufficiency_check);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Progress row saved successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function get_individual_progress($id)
    {
        $query = "SELECT progress.id, paticipant.name,paticipant.gender, events.title, lessons.lesson_name, progress.skills_attained, progress.hiv_status_check, progress.self_sufficiency_check, DATE(progress.created_at) AS date_attended FROM progress 
        JOIN paticipant ON paticipant.id = progress.participant_id
        JOIN events ON events.id = progress.event_id
        JOIN lessons ON lessons.id = progress.id
        WHERE paticipant.id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function get_progress()
    {
        $query = "SELECT progress.id, paticipant.name, paticipant.gender, events.title, lessons.lesson_name, progress.skills_attained, progress.hiv_status_check, progress.self_sufficiency_check, DATE(progress.created_at) AS date_attended FROM progress 
        JOIN paticipant ON paticipant.id = progress.participant_id
        JOIN events ON events.id = progress.event_id
        JOIN lessons ON lessons.id = progress.id";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return ['httpStatus' => 200, 'response' => $rows];
    }

    public function create_encounter()
    {
        $request = Request::capture();

        $participant_id = $request->input('participant-id');
        $encounter_date = $request->input('encounter-date');
        $event = $request->input('event');
        $lesson = $request->input('lesson');
        $material = $request->input('material');
        $service_details = $request->input('service-details');

        $query = "INSERT INTO encounters(participant_id, date, event_id, lessons_attended, material_id, service) VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssssss", $participant_id, $encounter_date, $event, $lesson, $material, $service_details);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $response = ['message' => 'Encounter saved successfully!'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => $this->database->error];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function get_participants_count()
    {
        $count = 0;
        $query = "SELECT COUNT(*) FROM paticipant";

        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $stmt->bind_result($count);

        $stmt->fetch();

        $stmt->close();

        return $count;
    }
    public function get_lessons_count()
    {
        $count = 0;
        $query = "SELECT COUNT(*) FROM lessons";

        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $stmt->bind_result($count);

        $stmt->fetch();

        $stmt->close();

        return $count;
    }
    public function get_events_count()
    {
        $count = 0;
        $query = "SELECT COUNT(*) FROM events";

        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $stmt->bind_result($count);

        $stmt->fetch();

        $stmt->close();

        return $count;
    }

}
