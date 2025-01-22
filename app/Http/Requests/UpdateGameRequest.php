<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    public function authorize()
    {
        // Authorize all users, or customize as needed
        return true;
    }

    public function rules()
    {
        return [
            'team_a_id' => 'required|exists:teams,id|different:team_b_id',
            'team_b_id' => 'required|exists:teams,id',
            'winner_team_id' => [
                'nullable',
                'exists:teams,id',
                function ($attribute, $value, $fail) {
                    if ($value && $value !== $this->input('team_a_id') && $value !== $this->input('team_b_id')) {
                        $fail('The winner team must be either Team A or Team B.');
                    }
                },
            ],
            'team_a_goals' => 'required|integer|min:0',
            'team_b_goals' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'status' => 'required|in:Scheduled,In Progress,Finished',
        ];
    }

    public function messages()
    {
        return [
            'team_a_id.required' => 'Team A is required.',
            'team_a_id.exists' => 'Selected Team A does not exist.',
            'team_b_id.required' => 'Team B is required.',
            'team_b_id.exists' => 'Selected Team B does not exist.',
            'team_a_id.different' => 'Team A and Team B must be different.',
            'team_a_goals.required' => 'Goals for Team A are required.',
            'team_a_goals.integer' => 'Goals for Team A must be an integer.',
            'team_a_goals.min' => 'Goals for Team A must be at least 0.',
            'team_b_goals.required' => 'Goals for Team B are required.',
            'team_b_goals.integer' => 'Goals for Team B must be an integer.',
            'team_b_goals.min' => 'Goals for Team B must be at least 0.',
            'location.required' => 'The location is required.',
            'location.string' => 'The location must be a string.',
            'location.max' => 'The location may not be greater than 255 characters.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be one of Scheduled, In Progress, or Finished.',
        ];
    }
}
