<?php

namespace App\Http\Controllers;

use App\Actions\ApproveEnrollmentAction;
use App\Http\Requests\CreateEnrollmentRequest;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(CreateEnrollmentRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'pending';

        $enrollment = Enrollment::create($data);

        return response()->json($enrollment, 201);
    }

    public function approve(Enrollment $enrollment, ApproveEnrollmentAction $action)
    {
        $action->execute($enrollment);

        return response()->json($enrollment);
    }

    public function drop(Enrollment $enrollment)
    {
        abort_if($enrollment->status !== 'approved', 400, 'Can only drop approved enrollments.');

        $enrollment->update(['status' => 'dropped']);

        return response()->json($enrollment);
    }
}
