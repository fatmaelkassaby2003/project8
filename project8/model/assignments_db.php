<?php

    function get_assignments_by_course($course_id)
    {
        global $db;
        if($course_id)
        {
            $query ='SELECT A.ID,A.Description,C.courseName from assigments A LEFT JOIN courses C on A.CourseId=C.CourseId WHERE A.CourseId=:course_id order by A.ID';
        }
        else
        {
            $query ='SELECT A.ID,A.Description,C.courseName from assigments A LEFT JOIN courses C on A.CourseId=C.CourseId order by C.CourseId';
        }

        $statement=$db->prepare($query);
        $statement->bindValue(':course_id',$course_id);
        $statement->execute();
        $assignment=$statement->fetchAll();
        $statement-> closeCursor();
        return $assignment;
    }

    function delete_assignment($assignment_id)
    {
        global $db;
        $query='DELETE from assignments WHERE ID =:assign_id';
        $statement=$db->prepare($query);
        $statement->bindValue(':assign_id',$assignment_id);
        $statement->execute();
        $statement-> closeCursor();
    }

    function add_assignment($course_id,$description)
    {
        global $db;
        $query='INSERT into assignments(description,CourseId) values (:descr,:CourseId)';
        $statement=$db->prepare($query);
        $statement->bindValue(':descr',$description);
        $statement->bindValue(':CourseId',$course_id);
        $statement->execute();
        $statement-> closeCursor();
    }