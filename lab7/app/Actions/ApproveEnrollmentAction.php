<?php

namespace App\Actions;

use App\Models\Enrollment;

class ApproveEnrollmentAction
{
    public function execute(Enrollment $enrollment): void
    {
        abort_if($enrollment->status !== 'pending', 400, 'Can only approve pending enrollments.');

        $course = $enrollment->course;

        abort_if($course->seats < $enrollment->seats_requested, 400, 'Not enough seats available.');

        $course->decrement('seats', $enrollment->seats_requested);

        $enrollment->update(['status' => 'approved']);
    }
}
